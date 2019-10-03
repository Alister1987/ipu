<?php
/**
 * Plugin Name: SD AIB Payment
 * Description: This plugin manages the integration between wordpress and AIB AuthyPay
 * Version: 0.1
 * Author: Alessandro Vegna
 * Author URI: http://www.lightbox.ie
 */
/**
 *
 * FROM THIS AREA AHEAD, EVERYTHING BELONGS TO THE BACKEND
 *
 */


$dateTime = date("Y:m:d-H:i:s");
function getDateTime() {
	global $dateTime;
	return $dateTime;
}
function createHash($storename,$sharedSecret, $chargetotal, $currency) {
	$stringToHash = $storename . getDateTime() . $chargetotal . $currency
	                . $sharedSecret;
	$ascii = bin2hex($stringToHash);
	return hash("sha256",$ascii);
}


add_action('admin_menu', 'register_my_custom_menu_page');

include ("cpt/payment.php");
include ("settings.php");




function register_my_custom_menu_page() {
	add_menu_page('AIBPlugin', 'AIB - Integration', 'manage_options', 'aibAdmin', 'adminPage',null, 600);
//	add_submenu_page('stripeAdmin', 'Payments', 'Payments', 'manage_options', 'stripeAdminDonations', 'adminDonationsPage');
//	add_submenu_page('', 'OrdersDownload', 'OrdersDownload', 'manage_options', 'stripeAdminOrdersDownload', 'adminOrdersDownloadPage');
	//add_submenu_page('stripeAdmin', 'How to', 'How to', 'manage_options', 'stripeAdminHowTo', 'adminHowToPage');
}


/**
 *
 * Front End - The following methods are to do with what the front end user will see on the site.
 *
 */
add_shortcode('callCardInfoForm', 'callCardInfoForm');
//add_shortcode('callDonationForm', 'callDonationForm');

//add_shortcode('drawRealexStep3', 'drawRealexStep3');

/*
 * This function is called when the form is submitted.  
 */
function callCardInfoForm($atts) {

	$grandTotal = $atts["total"];

	if(!$grandTotal){
		// Return error
		?>
        Supplied item can not be ordered - No price
		<?php
		return;
	}

	// Get configuration
	$cfg = searchConfigurationInfo();

	// Validate is item is valid
	if(!isset($_GET['item'])) {
		?>
        Supplied item does not exist
		<?php
		return;
	}

	// Check that item exists
	$itemToPurchase = get_post($_GET['item']);

	// If item does not exist return error
	if(!$itemToPurchase) {
		?>
        Supplied item does not exist
		<?php
		return;
	}

	// Calculate the payment amount
	$memberPrice = 0;
	$nonMemberPrice = 0;

	// If item exists
	if ($itemToPurchase) {
		// Get item type
		$itemType = $itemToPurchase->post_type;

		// Check if the item can be purchased
		$enable_order_now = $itemToPurchase->enable_order_now;

		// If the item cannot be purchased now
		if(!$enable_order_now) {
			// Return error
			?>
            Supplied item can not be ordered
			<?php
			return;
		}

		// Get the member and non-member price for course/event
		if($itemType == 'course') {
			$memberPrice = $itemToPurchase->members_price;
			$nonMemberPrice = $itemToPurchase->non_member_price;
		} else {
			$memberPrice = $itemToPurchase->price_member;
			$nonMemberPrice = $itemToPurchase->price_non_member;
		}

		// Calculate the member (m) and non-member (nm) price
		$mTotal = 0;
		$nmTotal = 0;
		$mTotalLabel = '';
		$nmTotalLabel = '';
		$grandTotalLabel = 'Total';
		$trxDescription = '';
		// If the item is an event
		if($itemType == 'event') {
			$trxDescription.='Event: ';
			// Multiply the prices by the number of tickets purchased
			if(isset($_GET['m_qty']) && $memberPrice != '') {
				$mTotal = $_GET['m_qty'] * $memberPrice;
				$mTotalLabel = $_GET['m_qty'].' Member Ticket';
				if ($nmTotal !== 0 && $nmTotal !== '0') {
					$trxDescription.=$_GET['m_qty'].' x Member Ticket: ';
				}
			}

			if(isset($_GET['nm_qty']) && $nonMemberPrice != '') {
				$nmTotal = $_GET['nm_qty'] * $nonMemberPrice;
				$nmTotalLabel = $_GET['nm_qty'].' Non-Member Ticket';
				if ($nmTotal !== 0 && $nmTotal !== '0') {
					$trxDescription.=$_GET['nm_qty'].' x Non-Member Ticket: ';
				}
			}
		} else {
            if ($itemType == 'course') {

                // Item is a course
                $trxDescription .= 'Course: ';

                $query_string = $_SERVER['QUERY_STRING'];
                $parts = parse_url($query_string);

                parse_str($parts['query'], $query);
                $query = $query['member'];

                if (is_string($query) && $query == 'ipu-member') {
                    $mTotal = $memberPrice;
                    $trxDescription .= 'Member: ';
                } else {
                    //if checked === true use member price ELSE

                    if (is_user_logged_in() && $memberPrice != '') {
                        $mTotal = $memberPrice;
                        $trxDescription .= 'Member: ';
                    } else {
                        // else use the non-member price
                        $nmTotal = $nonMemberPrice;
                        $trxDescription .= 'Non-Member: ';
                    }
                }

			// Set grand total label to display Price
			$grandTotalLabel = 'Price';
            }
		}

		// Grand total is the sum of the totals
		// One of the totals will be zero
		$grandTotal = $mTotal + $nmTotal;
	} else {
		// Item is not defined return error
		?>
        Supplied item does not exist
		<?php
		return;
	}


	global $wpdb;


	// If the stripe token is defined
	if (isset($_POST["status"])) {

		// Get the stripe token, item and amount
		$_SESSION["item"]   = $_GET["item"];
		$_SESSION["amount"] = $grandTotal;


		$order_notification_email_address = $itemToPurchase->order_notification_email_address;
		$rfname                           = $_POST['bname'];
		$remail                           = $_POST['email'];
		$raddress1                        = $_POST['baddr1'];
		$raddress2                        = $_POST['baddr2'];
		$rcity                            = $_POST['bcity'];
		$rpost_code                       = $_POST['bzip'];
		$rcountry                         = $_POST['bcountry'];
		$rphone                           = $_POST['phone'];
		$date                             = $_POST['tdate'];
		$email                            = $_POST['email'];
		$event_name                       = $_POST['recurringComments'];
		$pharmacy_name                    = $_POST['pharmacy_name'];
		$attendant_name                   = $_POST['attendant_name'];

		if ( $order_notification_email_address != '' ) {
			// lets send email to the notification email
			$emailString = '<html><head></head><body>';
			$emailString .= 'New order is received for ' . ( $itemType == 'course' ? 'Course' : 'Event' );
			$emailString .= '<br/>';
			$emailString .= 'Product: ' . $itemToPurchase->post_title;
			$emailString .= '<br/>';
			if ( $event_name ) {
				$emailString .= 'Event/Course Name and Date: ' . $event_name;
				$emailString .= '<br/>';
			}
			$emailString .= 'Name: ' . $rfname;
			$emailString .= '<br/>';
			if($pharmacy_name)
            {
	            $emailString .= 'Pharmacy Name: ' . $pharmacy_name;
	            $emailString .= '<br/>';
            }

			if($attendant_name)
			{
				$emailString .= 'Attendant Name: ' . $attendant_name;
				$emailString .= '<br/>';
			}

			$emailString .= 'Name: ' . $rfname;
			$emailString .= '<br/>';
			$emailString .= 'Email: ' . $remail;
			$emailString .= '<br/>';
			$emailString .= 'Address: ' . $raddress1 . ( $raddress2 != '' ? ', ' . $raddress2 : '' );
			$emailString .= '<br/>';
			$emailString .= 'City: ' . $rcity;
			$emailString .= '<br/>';
			$emailString .= 'Post Code: ' . $rpost_code;
			$emailString .= '<br/>';
			$emailString .= 'Country: ' . $rcountry;
			$emailString .= '<br/>';
			$emailString .= 'Phone: ' . $rphone;
			$emailString .= '</body></html>';

			$headers = 'From: IPU Services Limited <no-reply@ipu.ie>' . "\r\n"; // change to what the client wants to recieve emails as
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			wp_mail( $order_notification_email_address, 'New Order', $emailString, $headers );

			// Send the confirmation email
			$emailString = 'Thank you for your order. You have successfully purchased a ' . ( $itemType == 'course' ? 'Course' : 'Event' ) . ' - ' . $itemToPurchase->post_title;
			$headers     = 'From: IPU Services Limited <no-reply@ipu.ie>' . "\r\n";
			wp_mail( $remail, 'New Order', $emailString, $headers );

		}
		//save information in the db
		$args = array(
			"post_type"   => "payment",
			"post_status" => "publish",
			"post_title"  => $itemToPurchase->post_title
		);
		$id   = wp_insert_post( $args );

		if ( ! $id ) {
			var_dump( $id );
			wp_die( "Something went wront $id" );
		}

		update_post_meta( $id, "fullname", $rfname );
		update_post_meta( $id, "user_id", get_current_user_id() );
		update_post_meta( $id, "date_of_purchase", $date );
		update_post_meta( $id, "email", $email );
		update_post_meta( $id, "amount", $grandTotal );
		update_post_meta( $id, "item_id", $itemToPurchase->ID );
		update_post_meta( $id, "approved", strtoupper( $_POST["status"] ) == "APPROVED" );
		update_post_meta( $id, "event_name", $event_name );
		update_post_meta( $id, "pharmacy_name", $pharmacy_name );
		update_post_meta( $id, "attendant_name", $attendant_name );

		?>
        The payment is being processed...
        <script>
			<?php
			$junction = '?';
			if ( strpos( $cfg["thank_you_page_url"], '?' ) !== false ) {
				$junction = '&';
			}
			?>

            window.open("<?php echo $cfg["thank_you_page_url"] . $junction . "item=" . $_GET['item'] . '&fname=' . $_POST['rfname'] . '&lname=' . $_POST['rlname']; ?>", "_self");
        </script>
		<?php

	}else {
		
		$initialFirstName = '';
		$initialLastName = '';
		$initialEmail = '';
		$current_user = wp_get_current_user();


		if($current_user) {
			$initialFirstName = $current_user->user_firstname;
			$initialLastName = $current_user->user_lastname;
			$initialEmail = $current_user->user_email;
		}
		
		?>



        <script type="text/javascript">


            function validateEmail(mail)
            {
                return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail);
            }

            function validateCard(card){
                //only number, size 16
                return /^\d+$/.test(card) && /^\d{10,16}$/.test(card);
            }

            function validateCvc(card){
                //only number, size 3
                return /^\d+$/.test(card) && /^\d{3}$/.test(card);
            }

            function validateFields() {

                var error = true;

                //full name
                if (!$("#rfname").val()) {
                    $('#rfname').addClass("error");
                    error &= false;
                }else
                    $('#rfname').removeClass("error");

                //address
                if (!$("#raddress1").val()) {
                    $('#raddress1').addClass("error");
                    error &= false;
                }else
                    $('#raddress1').removeClass("error");

                //city
                if (!$("#rcity").val()) {
                    $('#rcity').addClass("error");
                    error &= false;
                }else
                    $('#rcity').removeClass("error");

//                //country
//                if (!$("#p_country").val() || $("#p_country").val().length != 2) {
//                    $('#p_country').addClass("error");
//                    error &= false;
//                }else
//                    $('#p_country').removeClass("error");

                //email
                if (!validateEmail($("#remail").val())) {
                    $('#remail').text("Invalid");
                    $('#remail').addClass("error");
                    error &= false;
                }else
                    $('#remail').removeClass("error");

                //card
                if (!validateCard($("#card_num").val())) {
                    $('#card_num').addClass("error");
                    error &= false;
                }else
                    $('#card_num').removeClass("error");

                //cvc
                if (!validateCvc($("#cvc").val())) {
                    $('#cvc').addClass("error");
                    error &= false;
                }else
                    $('#cvc').removeClass("error");

                //terms
                if (!$("#terms").is(":checked")) {
                    $('.error-term').show();
                    error &= false;
                }else
                    $('.error-term').hide();


                if($("#event-selector").length){
                    if($("#event-selector").val() == "-1"){
                        $('.error-course').show();
                        error &= false;
                    }else{
                        $('.error-course').hide();
                    }
                }

                console.log(error);

                return error;
            }

			function setCommentsData() {
                var personName = $("#rfname").val().trim().replace(/,/g , "");
                var pharmacyName = $("#pharmacy").val().trim().replace(/,/g , "");
                var attendeeName = $("#attendant").val().trim().replace(/,/g , "");
                var selectedEvent = '<?php echo str_replace(",", "", $itemToPurchase->post_title); ?>';
                var selectedTickets = $("#event-selector").val().trim().replace(/,/g , "");
                
                var commentData = personName + "," + pharmacyName + "," + attendeeName + "," + selectedEvent + "," + selectedTickets;
                
                $("input[name='comments']").val(commentData);
            }
            
            function setCustomerData(){
                var personName = '<?= $initialFirstName ?> <?= $initialLastName?>';
                $("input[name='customerid']").val(personName.substring(0, 77));
            }
            
            function setInvoiceNumberData(){
                var selectedEvent = '<?php echo str_replace(",", "", $itemToPurchase->post_title); ?>';
                $("input[name='invoicenumber']").val(selectedEvent.substring(0, 47));
            }
            
            function setOrderIdData(){
                var orderId = $("#rfname").val().trim();
                $("input[name='oidX']").val(orderId);
            }
			
            jQuery(function($) {
                $('#payment_form').submit(function(e) {
                    var $form = $(this);

                    console.log("here");

                    var validate = validateFields();
                    if(validate) {
                        // Disable the submit button to prevent repeated clicks
                        $form.find('button').prop('disabled', true);
                        // Stripe.card.createToken($form, stripeResponseHandler);
                        // Prevent the form from submitting with the default action
						setCommentsData();
                        setCustomerData();
                        setInvoiceNumberData();
                        setOrderIdData();
						
                        return true;
                    }else{
                        $('html, body').animate({
                            scrollTop: $("body").offset().top
                        }, 800)
                    }
                    return false;
                });
            });
        </script>

		<?php

		if ($cfg["test_mode"] == "on"){
			$storeID = get_option("store_id_test");
			$sharedSecret = get_option("shared_secret_test");
			$url = get_option("gateway_url_test");
			//$url = "https://test.ipg-online.com/connect/gateway/processing";
        }
		else{
			$storeID = get_option("store_id");
			$sharedSecret = get_option("shared_secret");
			$url = get_option("gateway_url");

		//	$url = "https://ipg-online.com/connect/gateway/processing";

		}



		//get repeater field
		$event_repeater = get_field("events_and_courses_list",$itemToPurchase);
		$select = false;
		if(is_array($event_repeater) && count($event_repeater)){
			$select = "<select id='event-selector' name='recurringComments'><option value='-1'>Select a ".ucfirst($itemType)."</option>";
			foreach ($event_repeater as $event){
				$select .= "<option value='{$event['location']} - {$event['date']}'>{$event['location']} - {$event['date']}</option>";
			}
			$select .= "</select>";
		}

		?>

        <form id="payment_form" method="POST" action="<?php echo $url ?>">
	        <?php if ($cfg["test_mode"] == "on") { ?>
                <h1>AIB: Test Mode</h1>
	        <?php } ?>
            <?php
            if ($itemType == 'course') {
                if (!is_user_logged_in() && $memberPrice != '') {

                    ?>
                    <div class="payment_address">
                        <div class="w_title">
                            <h3>Membership</h3>
                            <h2>Are you an IPU Member?</h2>
                        </div>
                        <div class="payment_fields_wrapper">
                            <div id="p_exp" class="form-row field">
                            <span>
                                <input type="checkbox" id="membership" class="isMember" name="member-check" value="yes"
                                       style="float:left;">
                                <label for="membership" style="float:none">Check this box if you are currently enrolled as an IPU Member</label>
                            </span>
                            </div>
                        </div>
                        <script type="text/javascript">
                            jQuery(function ($) {
                                $(document).ready(function () {
                                    $(function () {
                                        var storage = localStorage.input === 'true' ? true : false;
                                        $('.isMember').prop('checked', storage || false);
                                    });

                                    $('.isMember').on('change', function () {
                                        localStorage.input = $(this).is(':checked');
                                        var status = $(this).is(':checked');

                                        if (status === true) {
                                            window.location.href = window.location.href + "&?member=ipu-member";
                                            $('.isMember').prop('checked', true);
                                        }
                                        else if (status === false) {
                                            $('.isMember').prop('checked', false);
                                            var replaceURL = window.location.href.replace('&?member=ipu-member', '');
                                            window.location.href = replaceURL;
                                        }
                                        else {
                                            window.location.href;
                                        }
                                    });
                                });
                            });
                        </script>
                    </div>
                    <?php
                }
            } ?>
			<?php if($select) {?>
                <div class="payment_address" style='margin-bottom: 100px'>
                    <div class="w_title">
                        <h3>SELECT A <?php echo ucfirst($itemType)?></h3>
                        <h2><?php echo ucfirst($itemType)?> CHOICE</h2>
                        <h3 style="margin-top: 15px;">To avail of the IPU Members rate, please log in <a href="<?= wp_login_url();  ?>" >HERE</a> with your username and password. If you have mislaid your details, please contact us on 01 493 6401 or <a href="mailto:info@ipu.ie">info@ipu.ie</a>.</h3>
                    </div>
                    <div class="payment_fields_wrapper">
                        <p class="error-course">You must select an event or a course</p>
                        <div id="p_exp" class="form-row field">
                            <div class="select_wrapper">
								<?php echo $select; ?>
                            </div>
                        </div>
                    </div>
                </div>
			<?php } ?>

            <div class="payment_address">
                <div class="w_title">
                    <h3>Payment info</h3>

                    <h2>ADDRESS DETAILS</h2>
                </div>
                <div class="payment_fields_wrapper">

                    <div id="dfname" class="field">
                        <label for="rfname">Full Name <i>*</i></label>
                        <input id="rfname" class="field" value="<?= $initialFirstName ?>" type="text" size="30" name="bname" required>
                        <label for='rfname' class='form-error lname'></label>
                    </div>
                    <div id="dfname" class="field">
                        <label for="rfname">Pharmacy Name</label>
                        <input id="pharmacy" class="field" type="text" size="30" name="pharmacy_name">
                    </div>
                    <div id="dfname" class="field">
                        <label for="rfname">Attendant Name</label>
                        <input id="attendant" class="field" type="text" size="30" name="attendant_name">
                    </div>
                    <div id="demail" class="field">
                        <label for="remail">Email <i>*</i></label>
                        <input id="remail"  value="<?= $initialEmail ?>" class="field" type="text" size="45" name="email" required>
                        <label for='rfname' class='form-error email'></label>
                    </div>
                    <div id="daddress1" class="field">
                        <label for="raddress1">Street Address <i>*</i></label>
                        <input id="raddress1" class="field" type="text" size="30" name="baddr1" required>
                        <label for='raddress1' class='form-error address1'></label>
                    </div>
                    <div id="daddress2" class="field">
                        <input id="raddress2" class="field" type="text" size="30" name="baddr2">
                        <label for='raddress2' class='form-error address2'></label>
                    </div>

                    <div id="dcity" class="field">
                        <label for="rcity">City <i>*</i></label>
                        <input id="rcity" type="text" size="30" name="bcity" class="field" required>
                        <label for='rcity' class='form-error city'></label>
                    </div>
                    <div id="dpost_code" class="field">
                        <label for="rpost_code">Postal Code <b>- if applicable</b></label>
                        <input id="rpost_code" type="text" size="30" name="bzip">
                        <label for='rpost_code' class='form-error post_code'></label>
                    </div>
<!--                    <div id="dcountry" class="field">-->
<!--                        <label for="p_country">Country Code (2 Char)<i>*</i></label>-->
<!--                        <input id="p_country" type="text" maxlength="2" name="bcounty" class="field" required>-->
<!--                        <label for='rcountry' class='form-error country'></label>-->
<!--                    </div>-->
                    <div id="dphone" class="field">
                        <label for="p_phone">Phone</label>
                        <input id="p_phone" type="text" size="20" name="phone">
                        <label for='rphone' class='form-error phone'></label>
                    </div>
                </div>
            </div>

            <input type="hidden" name="chargetotal" value="<?php echo $grandTotal?>"/>
            <input type="hidden" name="txntype" value="sale">
            <input type="hidden" name="timezone" value="Europe/Dublin"/>
            <input type="hidden" name="txndatetime" value="<?php echo getDateTime() ?>"/>
            <input type="hidden" name="hash_algorithm" value="SHA256"/>
            <input type="hidden" name="hash" value="<?php echo createHash($storeID,$sharedSecret,$grandTotal,"978" ) ?>"/>
            <input type="hidden" name="storename" value="<?php echo $storeID?>"/>
            <input type="hidden" name="mode" value="payonly"/>
            <input type="hidden" name="currency" value="978"/>
            <input type="hidden" name="responseSuccessURL" value="<?php echo (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>"/>
            <input type="hidden" name="responseFailURL" value="<?php echo get_option("fail_url")?>"/>
            <input type="hidden" name="authenticateTransaction" value="true"/>
			<input type="hidden" name="comments" value=""/>
            
            <input type="hidden" name="customerid" value=""/>
            <input type="hidden" name="invoicenumber" value=""/>
            <input type="hidden" name="oidX" value=""/>

            <div class="payment_details">
                <div class="w_title">
                    <h3>Payment info</h3>
                    <h2>Secure Payment Info</h2>
                </div>
                <div class="payment_fields_wrapper">
                    <div id="p_card_num" class="form-row field">
                        <label for="card_num">Card Number <b>- No spaces or dashes</b> <i>*</i></label>
                        <input id="card_num" type="text" data-stripe="number" maxlength="16" name="cardnumber" class="field" required>
                        <label for='card_num' class='form-error card_num'></label>
                    </div>
                    <div id="p_cvc" class="form-row field">
                        <label for="cvc">CVC Security code <b>- 3 digits at the back of your card</b> <i>*</i></label>
                        <!--                            DO NOT CHANGE THE NAME CVM IS CORRECT-->
                        <input id="cvc" type="text" data-stripe="cvc" maxlength="3" name="cvm" class="field" required>
                        <label for='cvc' class='form-error cvc'></label>
                    </div>
                    <div id="p_exp" class="form-row field double_select">
                        <label for="exp">Expiration <b>- MM/YYYY</b>*</label>
                        <div class="select_wrapper select_wrapper_furst">
                            <select class="half" data-stripe="exp-month" name="expmonth">
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                        <div class="select_wrapper">
                            <select class="half" data-stripe="exp-year" name="expyear">
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            </select>
                        </div>
                    </div>

                    <div style="clear: both"></div>
                    <div class="field terms">
                        <input type="checkbox" id="terms" required/><span> I agree to <a href="/terms-and-conditions/" target="_blank">Terms and Conditions</a> before placing order.</span>
                        <p class="error-term">You need to agree to the Terms and Conditions before placing order</p>
                    </div>

                    <div class="form_submit">
                        <input id="submit_payment" class="button center" type="submit" value="Place Order">
                        <p >Your credit card will be charged</p>
                    </div>
                </div>



            </div>
        </form>

        <!-- END FORM -->
		<?php
	}
}
