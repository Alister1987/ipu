<?php
/**
 * Created by PhpStorm.
 * User: wojciech
 * Date: 22/03/2018
 * Time: 23:36
 */

$dateTime = date("Y:m:d-H:i:s");
//function getDateTime1()
//{
//    global $dateTime;
//    return $dateTime;
//}
//
//function createHash1($storename, $sharedSecret, $chargetotal, $currency)
//{
//    $stringToHash = $storename . getDateTime() . $chargetotal . $currency
//        . $sharedSecret;
//    $ascii = bin2hex($stringToHash);
//    return hash("sha256", $ascii);
//}
//
////backward compatibility
//function searchConfigurationInfo1(){
//    return array(
//        "card_info_page_url" => "/checkout/",
//        "logged_to_donate" =>false,
//        "test_mode" => get_option("test_mode"),
//        "thank_you_page_url" => get_option("thank_url"),
//        "fail_page_url" => get_option("fail_url"),
//    );
//}
////backward compatibility ... no comments
//function verifiesIfUserIsLogged1(){
//    return is_user_logged_in();
//}

add_shortcode('invoicePaymentForm', 'invoicePaymentForm');

function invoicePaymentForm($atts)
{

    $grandTotal       = $atts["total"];
    $invoice_id       = $atts['invoice'];
    $invoice_title    = $atts["invoice_title"];
    $invoiced_product = get_field('product_title', $atts["product"]);
    $staff_email      = get_field('ipu_staff_email', $atts["product"]);
    $vatable          = (isset($atts["vatable"]) && $atts["vatable"] == 'yes') ? true : false;
    $vat_amount       = esc_attr( get_option('sd_payment_link_vat') );

    if (!$grandTotal) {
        // Return error
        ?>
        Supplied item can not be ordered - No price
        <?php
        return;
    }

    // Get configuration
    $cfg = array(
        "card_info_page_url" => "/checkout/",
        "logged_to_donate" =>false,
        "test_mode" => get_option("test_mode"),
        "thank_you_page_url" => get_option("thank_url"),
        "fail_page_url" => get_option("fail_url"),
    );

    global $wpdb;


    // If the stripe token is defined
    if (isset($_POST["status"])) {

        // Get the stripe token, item and amount
        $_SESSION["l"] = $_GET["l"];
        $_SESSION["amount"] = $grandTotal;


        $order_notification_email_address = $staff_email;
        $rfname = $_POST['bname'];
        $remail = $_POST['email'];
        $raddress1 = $_POST['baddr1'];
        $raddress2 = $_POST['baddr2'];
        $rcity = $_POST['bcity'];
        $rpost_code = $_POST['bzip'];
        $rcountry = $_POST['bcountry'];
        $rphone = $_POST['phone'];
        $date = $_POST['tdate'];
        $email = $_POST['email'];
        $pharmacy_name = $_POST['pharmacy_name'];
        $attendant_name = $_POST['attendant_name'];

        if ($order_notification_email_address != '') {
            // lets send email to the notification email
            $emailString = '<html><head></head><body>';
            $emailString .= 'New invoice has been paid.';
            $emailString .= '<br/>';
            $emailString .= 'Invoice name:';
            $emailString .= '<br/>';
            $emailString .= $invoice_title;
            $emailString .= '<br/>';
            $emailString .= 'Product: ' . $invoiced_product;
            $emailString .= '<br/>';
            $emailString .= 'Name: ' . $rfname;
            $emailString .= '<br/>';
            if ($pharmacy_name) {
                $emailString .= 'Pharmacy Name: ' . $pharmacy_name;
                $emailString .= '<br/>';
            }

            if ($attendant_name) {
                $emailString .= 'Attendant Name: ' . $attendant_name;
                $emailString .= '<br/>';
            }

            $emailString .= 'Name: ' . $rfname;
            $emailString .= '<br/>';
            $emailString .= 'Email: ' . $remail;
            $emailString .= '<br/>';
            $emailString .= 'Address: ' . $raddress1 . ($raddress2 != '' ? ', ' . $raddress2 : '');
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
            wp_mail($order_notification_email_address, 'New Order', $emailString, $headers);

            // Send the confirmation email
            $emailString = 'Thank you for your order. You have successfully paid an invoice for a ' . $invoiced_product;
            $headers = 'From: IPU Services Limited <no-reply@ipu.ie>' . "\r\n";
            wp_mail($remail, 'New Order', $emailString, $headers);

        }
        //save information in the db
        $args = array(
            "post_type" => "payment",
            "post_status" => "publish",
            "post_title" => $invoice_title
        );
        $id = wp_insert_post($args);

        if (!$id) {
            var_dump($id);
            wp_die("Something went wront $id");
        }

        update_post_meta($id, "fullname", $rfname);
        update_post_meta($id, "user_id", get_current_user_id());
        update_post_meta($id, "date_of_purchase", $date);
        update_post_meta($id, "email", $email);
        update_post_meta($id, "amount", $grandTotal);
        update_post_meta($id, "approved", strtoupper($_POST["status"]) == "APPROVED");
        update_post_meta($id, "event_name", 'Invoiced Product');
        update_post_meta($id, "pharmacy_name", $pharmacy_name);
        update_post_meta($id, "attendant_name", $attendant_name);

        //update invoice status
        if(strtoupper($_POST["status"]) == "APPROVED"){
            update_post_meta($invoice_id, 'payment_status', 'APPROVED');
            update_post_meta($invoice_id, 'payment_id', $id);
        }

        ?>
        The payment is being processed...
        <script>
            <?php
            $junction = '?';
            if (strpos($cfg["thank_you_page_url"], '?') !== false) {
                $junction = '&';
            }
            ?>

            window.open("<?php echo $cfg["thank_you_page_url"] . $junction . "l=" . $_GET['l'] . '&fname=' . $_POST['rfname'] . '&lname=' . $_POST['rlname']; ?>", "_self");
        </script>
        <?php

    } else {

        $initialFirstName = '';
        $initialLastName = '';
        $initialEmail = '';
        $current_user = wp_get_current_user();


        if ($current_user) {
            $initialFirstName = $current_user->user_firstname;
            $initialLastName = $current_user->user_lastname;
            $initialEmail = $current_user->user_email;
        }

        ?>


        <script type="text/javascript">


            function validateEmail(mail) {
                return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail);
            }

            function validateCard(card) {
                //only number, size 16
                return /^\d+$/.test(card) && /^\d{10,16}$/.test(card);
            }

            function validateCvc(card) {
                //only number, size 3
                return /^\d+$/.test(card) && /^\d{3}$/.test(card);
            }

            function validateFields() {

                var error = true;

                //full name
                if (!$("#rfname").val()) {
                    $('#rfname').addClass("error");
                    error &= false;
                } else
                    $('#rfname').removeClass("error");

                //address
                if (!$("#raddress1").val()) {
                    $('#raddress1').addClass("error");
                    error &= false;
                } else
                    $('#raddress1').removeClass("error");

                //city
                if (!$("#rcity").val()) {
                    $('#rcity').addClass("error");
                    error &= false;
                } else
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
                } else
                    $('#remail').removeClass("error");

                //card
                if (!validateCard($("#card_num").val())) {
                    $('#card_num').addClass("error");
                    error &= false;
                } else
                    $('#card_num').removeClass("error");

                //cvc
                if (!validateCvc($("#cvc").val())) {
                    $('#cvc').addClass("error");
                    error &= false;
                } else
                    $('#cvc').removeClass("error");

                //terms
                if (!$("#terms").is(":checked")) {
                    $('.error-term').show();
                    error &= false;
                } else
                    $('.error-term').hide();

                console.log(error);

                return error;
            }

	    function setCommentsData() {
                var personName = $("#rfname").val().trim().replace(/,/g , "");
                var pharmacyName = $("#pharmacy").val().trim().replace(/,/g , "");
                var attendeeName = $("#attendant").val().trim().replace(/,/g , "");
                var selectedEvent = '<?php echo str_replace(",", "", $invoiced_product); ?>';
                var selectedTickets = '';
                
                var commentData = personName + "," + pharmacyName + "," + attendeeName + "," + selectedEvent + "," + selectedTickets;
                
                $("input[name='comments']").val(commentData);
            }
            
            function setCustomerData(){
                var personName = '<?= $initialFirstName ?> <?= $initialLastName?>';
                $("input[name='customerid']").val(personName.substring(0, 77));
            }
            
            function setInvoiceNumberData(){
                var selectedEvent = '<?php echo str_replace(",", "", $invoiced_product); ?>';
                $("input[name='invoicenumber']").val(selectedEvent.substring(0, 47));
            }
            
            function setOrderIdData(){
                var orderId = $("#rfname").val().trim();
                $("input[name='oidX']").val(orderId);
            }

            jQuery(function ($) {
                $('#payment_form').submit(function (e) {
                    var $form = $(this);

                    //console.log("here");

                    var validate = validateFields();
                    if (validate) {
                        // Disable the submit button to prevent repeated clicks
                        $form.find('button').prop('disabled', true);
                        // Stripe.card.createToken($form, stripeResponseHandler);
                        // Prevent the form from submitting with the default action

			setCommentsData();
                        setCustomerData();
                        setInvoiceNumberData();
                        setOrderIdData();

                        return true;
                    } else {
                        $('html, body').animate({
                            scrollTop: $("body").offset().top
                        }, 800)
                    }
                    return false;
                });
            });
        </script>

        <?php


        if ($cfg["test_mode"] == "on") {
            $storeID = get_option("store_id_test");
            $sharedSecret = get_option("shared_secret_test");
            $url = get_option("gateway_url_test");
            //$url = "https://test.ipg-online.com/connect/gateway/processing";
        } else {
            $storeID = get_option("store_id");
            $sharedSecret = get_option("shared_secret");
            $url = get_option("gateway_url");

            //	$url = "https://ipg-online.com/connect/gateway/processing";

        }

        ?>

        <form id="payment_form" method="POST" action="<?php echo $url ?>">
            <?php if ($cfg["test_mode"] == "on") { ?>
                <h1>AIB: Test Mode</h1>
            <?php } ?>

            <div class="payment_address" style='margin-bottom: 100px'>
                <div class="w_title">
                    <h3>PRODUCT</h3>
                    <h2><?php echo $invoiced_product ?></h2>
                    <?php if($vatable) {?><br><h3><?php echo $vat_amount; ?>% VAT INCLUDED</h3><?php } ?>
                </div>
            </div>

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
                        <input id="remail" value="<?= $initialEmail ?>" class="field" type="text" size="45" name="email" required>
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
                    <div id="dphone" class="field">
                        <label for="p_phone">Phone</label>
                        <input id="p_phone" type="text" size="20" name="phone">
                        <label for='rphone' class='form-error phone'></label>
                    </div>
                </div>
            </div>

            <input type="hidden" name="chargetotal" value="<?php echo $grandTotal ?>"/>
            <input type="hidden" name="txntype" value="sale">
            <input type="hidden" name="timezone" value="Europe/Dublin"/>
            <input type="hidden" name="txndatetime" value="<?php echo getDateTime() ?>"/>
            <input type="hidden" name="hash_algorithm" value="SHA256"/>
            <input type="hidden" name="hash" value="<?php echo createHash($storeID, $sharedSecret, $grandTotal, "978") ?>"/>
            <input type="hidden" name="storename" value="<?php echo $storeID ?>"/>
            <input type="hidden" name="mode" value="payonly"/>
            <input type="hidden" name="currency" value="978"/>
            <input type="hidden" name="responseSuccessURL" value="<?php echo (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>"/>
            <input type="hidden" name="responseFailURL" value="<?php echo get_option("fail_url") ?>"/>
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
                        <input type="checkbox" id="terms" required/><span> I agree to <a href="/terms-and-conditions/"
                                                                                         target="_blank">Terms and Conditions</a> before placing order.</span>
                        <p class="error-term">You need to agree to the Terms and Conditions before placing order</p>
                    </div>

                    <div class="form_submit">
                        <input id="submit_payment" class="button center" type="submit" value="Place Order">
                        <p>Your credit card will be charged</p>
                    </div>
                </div>


            </div>
        </form>

        <!-- END FORM -->
        <?php
    }
}
