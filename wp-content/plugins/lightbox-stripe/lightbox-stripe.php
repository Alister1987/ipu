<?php
/**
 * Plugin Name: Stripe Lightbox 
 * Description: This plugin manages the integration between wordpress and Stripe 
 * Version: 0.1 
 * Author: Eduardo - Lightbox.ie 
 * Author URI: http://www.lightbox.ie 
 */
/**
 *  
 * FROM THIS AREA AHEAD, EVERYTHING BELONGS TO THE BACKEND 
 *  
 */
add_action('admin_menu', 'register_my_custom_menu_page');
add_action('init', 'myStartSession', 1);



function register_my_custom_menu_page() {
	add_menu_page('StripePlugin', 'Stripe', 'manage_options', 'stripeAdmin', 'adminPage', plugins_url('lightbox-stripe/images/logo-stripe.png'), 600);
	add_submenu_page('stripeAdmin', 'Payments', 'Payments', 'manage_options', 'stripeAdminDonations', 'adminDonationsPage');
	add_submenu_page('', 'OrdersDownload', 'OrdersDownload', 'manage_options', 'stripeAdminOrdersDownload', 'adminOrdersDownloadPage');
	add_submenu_page('stripeAdmin', 'How to', 'How to', 'manage_options', 'stripeAdminHowTo', 'adminHowToPage');
}

/*
 * The Admin Donation Page. Showing details of each of the donations made 
 * via Stripe.  
 */

function adminDonationsPage() {
	global $wpdb;
	$prefix = $wpdb->prefix . "stripe_";
	?> 
	<style> 
		th{ 
			font-weight: bold !important; 
		} 
		td{ 
			border-bottom: 1px #eee solid !important ; 
		} 
	</style> 

	<div class="wrap"> 
		<h1> 
			Payments 
		</h1> 

		<table class = "wp-list-table widefat fixed users"> 
			<thead> 
				<tr> 
					<th>Name</th> 
					<th>Email</th> 
					<th>Reference</th> 
					<th>Amount</th> 
					<th>Additional</th> 
					<th>Date</th> 
				</tr> 
			</thead> 
			<tbody> 
				<?php
				$donations = $prefix . "donations";
				$users = $prefix . "users";
				$fields = $prefix . "fields";
				$wp_users = $wpdb->prefix . "users";
				$projects = $wpdb->prefix . "posts";

				$retrievingDonations = "SELECT * FROM $donations  
INNER JOIN $wp_users ON ($donations.user_id = $wp_users.id) 
ORDER BY $donations.id DESC";
				$retrievingDonations = $wpdb->get_results($retrievingDonations);

				$control = 0;
				while (count($retrievingDonations) > $control) {
					$donation_id = stripeGetResultSetColumn($retrievingDonations, $control, "id");
					$name = stripeGetResultSetColumn($retrievingDonations, $control, "display_name");
					$email = stripeGetResultSetColumn($retrievingDonations, $control, "user_email");
					$amount = stripeGetResultSetColumn($retrievingDonations, $control, "amount");
					$reference = stripeGetResultSetColumn($retrievingDonations, $control, "reference_id");
					$date = stripeGetResultSetColumn($retrievingDonations, $control, "date");

					$catchingAdvancedCustomFields = "SELECT * FROM $fields 
WHERE donation_id = '$donation_id'";
					$catchingAdvancedCustomFields = $wpdb->get_results($catchingAdvancedCustomFields);
					?> 
					<tr> 
						<td><?php echo $name; ?></td> 
						<td><?php echo $email; ?></td> 
						<td> 
							<?php
							$searchProjects = "SELECT * FROM $projects 
WHERE ID = '$reference'";
							$searchProjects = $wpdb->get_results($searchProjects);
							if (count($searchProjects) > 0) {
								echo stripeGetResultSetColumn($searchProjects, 0, "post_title");
							}
							?> 
						</td> 
						<td><?php echo $amount; ?></td> 
						<td> 
							<?php
							$control2 = 0;
							while (count($catchingAdvancedCustomFields) > $control2) {
								$customField = stripeGetResultSetColumn($catchingAdvancedCustomFields, $control2, "advanced_custom_field");
								$value = stripeGetResultSetColumn($catchingAdvancedCustomFields, $control2, "value");
								?> 
								<b><?php echo $customField; ?></b> <?php echo $value; ?><br/> 
								<?php
								$control2++;
							}
							?> 
						</td> 
						<td><?php echo $date; ?></td> 
					</tr> 
					<?php
					$control++;
				}
				?> 
			</tbody> 
		</table> 
	</div> 

	<?php
}

/*
 * This is the Administration Help Page. Details of how to use the Stripe Plugin.  
 */

function adminHowToPage() {
	?> 
	<style> 
		ul .list {  
			list-style-type: disc !important; 
			margin-left: 20px; 
		} 
	</style> 

	<div class="wrap"> 
		<h1>How to...</a> 
			<h2> 
				Define a donation page 
			</h2> 
			<p>In whatever pages you want to have the Donation Functionality, just add the shortcode "[callDonationForm]".</p> 
			<p>By doing so, you will be calling the Donation Form which will automatically require the user to be logged in to view it, if the user is not logged, he will be redirected to the login form, that allows him to create an account or recover its password if needed.</p> 
			<p>If you want the plugin to automatically recognise the amount to be donated you must create a field which the label is "Amount to Donate";</p> 
			<p>After normally creating a page and adding the needed shortcode, it is important to go to "Stripe" on the menu and fill the form with the url of your donation page.</p> 
			<h2> 
				Define a card info page 
			</h2> 
			<p>In order to define which of your pages are going to be used as card info page (That is the page where the user fill his card information before donating) you must create a page and use the shortcode "[callCardInfoForm]".</p> 
			<p>By doing so, you will be calling the Stripe Form which will automatically require the user to be logged in to view it, if the user is not logged, he will be redirected to the login form, that allows him to create an account or recover its password if needed.</p> 
			<p>After normally creating a page and adding the needed shortcode, it is important to go to "Stripe" on the menu and fill the form with the url of your card info page.</p> 
			<h2> 
				Define a thank you page 
			</h2> 
			<p>If you want to have a thank you page to be shown after each donation, you just need to create a simple page with whatever content you wish. After, you must go to "Stripe" on the menu and fill the form with the url of your thank you page.</p> 
			<h2> 
				Add extra fields 
			</h2> 
			<p>This functionality highly depends on <b>Advanced Custom Fields</b> Plugin to work!</p> 
			<p>Follow the steps below to make get it working:</p> 
			<ul class = "list"> 
				<li class = "list"> 
					Make sure you have installed Advanced Custom Fields; 
				</li> 
				<li class = "list"> 
					Add new custom field with whatever name you wish, create a rule so it only shows if the page is the same as the page you previously specified as "Donation Page"; 
				</li> 
				<li class = "list"> 
					Add the fields as your wish and the plugin will take care of the rest. 
				</li> 
			</ul> 
			<h2> 
				Allow Anonymity Mode 
			</h2> 
			<p>In order to allow the Anonymity Mode you must create an Advanced Custom Field labeled as "Anonymity Mode" with a Field Type "True/False"</p> 

	</div> 
	<?php
}

/*
 * This is the Main Administation Page which allows the admin to customize 
 * the Stripe Settings for the Plugin.  
 */

function adminPage() {
	?> 
	<div class="wrap"> 
		<h1> 
			Stripe's main configuration 
		</h1> 

		<?php
		global $wpdb;

		if ($_POST) {
			$prefix = $wpdb->prefix . "stripe_";
			$query = "UPDATE " . $prefix . "configuration  
SET  
test_secret_key = '" . $_POST["test_secret_key"] . "', 
test_publishable_key = '" . $_POST["test_publishable_key"] . "',
live_secret_key = '" . $_POST["live_secret_key"] . "',
live_publishable_key = '" . $_POST["live_publishable_key"] . "',
donation_page_url = '" . $_POST["donation_page_url"] . "',
card_info_page_url = '" . $_POST["card_info_page_url"] . "',
thank_you_page_url = '" . $_POST["thank_you_page_url"] . "',
test_mode = '" . (isset($_POST["test_mode"]) ? '1' : '0') . "',
logged_to_donate = '" . $_POST["logged_to_donate"] . "'";
			$query = $wpdb->get_results($query);

			if ($query) {
				echo "Your configuration information has been successfully saved!";
			} else {
				echo "Your configuration information couldn't be saved, please try again";
			}
		}

		$cfg = searchConfigurationInfo();
		?> 
		<form action = "" method = "POST" name = "test"> 
			<table class="form-table"> 
				<tr valign="top"> 
					<th scope="row"> 
						Test Secret Key:  
					</th> 
					<td> 
						<input type = "text" id = "test_secret_key" name = "test_secret_key" value = "<?php echo $cfg["test_secret_key"] ?>"/> 
					</td> 
				</tr> 
				<tr valign="top"> 
					<th scope="row"> 
						Test Publishable Key: 
					</th> 
					<td> 
						<input type = "text" id = "test_publishable_key" name = "test_publishable_key" value = "<?php echo $cfg["test_publishable_key"] ?>"/> 
					</td> 
				</tr>  
				<tr valign="top"> 
					<th scope="row"> 
						Live Secret Key 
					</th> 
					<td> 
						<input type = "text" id = "live_secret_key" name = "live_secret_key" value = "<?php echo $cfg["live_secret_key"] ?>"/> 
					</td> 
				</tr>  
				<tr valign="top"> 
					<th scope="row"> 
						Live Publishable Key 
					</th> 
					<td> 
						<input type = "text" id = "live_publishable_key" name = "live_publishable_key" value = "<?php echo $cfg["live_publishable_key"] ?>"/> 
					</td> 
				</tr>  
				<tr valign="top"> 
					<th scope="row"> 
						Test Mode 
					</th> 
					<td> 
						<input type = "checkbox" id = "test_mode" name = "test_mode" value = "1" <?php if ($cfg["test_mode"]) echo "checked = checked"; ?>/> 

					</td> 
				</tr> 
			</table> 
			<table class="form-table"> 
				<tr valign="top"> 
					<th scope="row"> 
						Donation page url:  
					</th> 
					<td> 
						<input type = "text" id = "donation_page_url" name = "donation_page_url" value = "<?php echo $cfg["donation_page_url"] ?>"/> 
					</td> 
				</tr> 
				<tr valign="top"> 
					<th scope="row"> 
						Card info page url:  
					</th> 
					<td> 
						<input type = "text" id = "card_info_page_url" name = "card_info_page_url" value = "<?php echo $cfg["card_info_page_url"] ?>"/> 
					</td> 
				</tr> 
				<tr valign="top"> 
					<th scope="row"> 
						Thank you page url:  
					</th> 
					<td> 
						<input type = "text" id = "thank_you_page_url" name = "thank_you_page_url" value = "<?php echo $cfg["thank_you_page_url"] ?>"/> 
					</td> 
				</tr>  
			</table>  
			<table class="form-table"> 
				<tr valign="top"> 
					<th scope="row"> 
						Is it needed to be logged in to donate? 
					</th> 
					<td> 
						<input type ="radio" value ="1" id ="logged_to_donate" name ="logged_to_donate" <?php if ($cfg["logged_to_donate"]) echo "checked = checked"; ?> />Yes 
						<input type ="radio" value ="0" id ="logged_to_donate" name ="logged_to_donate" <?php if (!$cfg["logged_to_donate"]) echo "checked = checked"; ?> />No 
					</td> 
				</tr> 
			</table>  
			<p class ="submit"> 
				<input id="submit" class="button button-primary" type="submit" value="Save Changes" name="submit"/> 
			</p> 
		</form> 

	</div> 
	<?php
}

/**
 *  
 * Front End - The following methods are to do with what the front end user will see on the site.  
 *  
 */
add_shortcode('callCardInfoForm', 'callCardInfoForm');
add_shortcode('callDonationForm', 'callDonationForm');

//add_shortcode('drawRealexStep3', 'drawRealexStep3'); 

/*
 * This function is called when the form is submitted.  
 */
function callCardInfoForm() {
	
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
        	$trxDescription.='Course: ';
            // Item is a course
            // If the user is logged in use the member price
            if (is_user_logged_in() && $memberPrice != '') {
                $mTotal = $memberPrice;
                $trxDescription.='Member: ';
            } else {
            	// else use the non-member price
                $nmTotal = $nonMemberPrice;
                $trxDescription.='Non-Member: ';
            }

            // Set grand total label to display Price
            $grandTotalLabel = 'Price';
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
    
    // If the user is not logged in and login is required to make a payment
	if ((!verifiesIfUserIsLogged()) && ($cfg["logged_to_donate"])) {
		// Return login link
		?> 
		To continue you must be logged in. Click <a href = "<?php echo wp_login_url(get_permalink()); ?>">here</a> to log in. 
		<?php
	} else {
		// Else the user is logged in OR non-logged in users can donate

		// Set the corrects publishable and test keys 
		if ($cfg["test_mode"] == 1) { 
			$publishable_key = $cfg["test_publishable_key"];
			$secret_key = $cfg["test_secret_key"];
		} else {
			$publishable_key = $cfg["live_publishable_key"];
			$secret_key = $cfg["live_secret_key"];
		}
		
		global $wpdb;
		
		// If the stripe token is defined
		if (isset($_POST["stripeToken"])) { 
			// Get the stripe token, item and amount
            $stripeToken = $_POST['stripeToken'];
			$_SESSION["item"] = $_GET["item"];
			$_SESSION["amount"] = $grandTotal;
            
			try {
				global $wpdb;
				$prefix = $wpdb->prefix . "stripe_";
				
				// If the user is logged in
				if (verifiesIfUserIsLogged()) {
					// Get the stripe_user_id for the logged in user
					$usr_id = get_current_user_id();
					$searchEntryOnData = "SELECT * FROM " . $prefix . "users WHERE wp_users_id = '$usr_id'";
					$searchEntryOnData = $wpdb->get_results($searchEntryOnData);
					// If a stripe user id is in the database
					if (count($searchEntryOnData) > 0) {
						// Set the stripe user id - customer token
						$stripe_usr_id = stripeGetResultSetColumn($searchEntryOnData, 0, "stripe_users_id");
						// Add the card entered to the existing stripe customer
						if (updateCustomerCard($secret_key, $stripe_usr_id, $_POST["stripeToken"])) {
							// Valid customer
							// Continue
						} else {
							// Invalid customer
							// Create customer
							$createUser = createStripeCustomer($secret_key, $_POST["stripeToken"], $_POST["remail"], $_POST['rfname']." ".$_POST['rlname']);
							// Get the customer id and set stripe user id variable
							$stripe_usr_id = $createUser->id;
							// Add the customer to the database for the current logged in user
							$insert = "INSERT INTO " . $prefix . "users  
								(wp_users_id, stripe_users_id) 
								VALUES 
								('$usr_id', '$stripe_usr_id')";
							$insert = $wpdb->get_results($insert);
						}
					} else {
						// Create a stripe user
						$createUser = createStripeCustomer($secret_key, $_POST["stripeToken"], $_POST["remail"], $_POST['rfname']." ".$_POST['rlname']);
						// Get the customer id and set stripe user id variable
						$stripe_usr_id = $createUser->id;
						// Add the customer to the database for the current logged in user
						$insert = "INSERT INTO " . $prefix . "users  
							(wp_users_id, stripe_users_id) 
							VALUES 
							('$usr_id', '$stripe_usr_id')";
						$insert = $wpdb->get_results($insert);
					}
				} else {
					// The user is not logged in
					// Check for a stripe user in the database with the forms email address
					$searchEntryOnData = "SELECT * FROM " . $wpdb->prefix . "users WHERE user_email = '" . $_POST["remail"] . "'";
					$searchEntryOnData = $wpdb->get_results($searchEntryOnData);
					// If an entry exists get the user id
					if (count($searchEntryOnData) > 0) {
						$usr_id = stripeGetResultSetColumn($searchEntryOnData, 0, "ID");
						// Check if the database contains a stripe customer for that user
						$searchStripeEntryOnData = "SELECT * FROM " . $prefix . "users WHERE wp_users_id = '$usr_id'";
						$searchStripeEntryOnData = $wpdb->get_results($searchStripeEntryOnData);
						if (count($searchStripeEntryOnData) > 0) {
							// Set the stripe user id - customer token
							$stripe_usr_id = stripeGetResultSetColumn($searchStripeEntryOnData, 0, "stripe_users_id");
							// Add the card entered to the existing stripe customer							
							if (updateCustomerCard($secret_key, $stripe_usr_id, $_POST["stripeToken"])) {
								// Valid customer
								// Continue
							} else {
								// Invalid customer
								// Create customer
								$createUser = createStripeCustomer($secret_key, $_POST["stripeToken"], $_POST["remail"], $_POST['rfname']." ".$_POST['rlname']);
								// Get the customer id and set stripe user id variable
								$stripe_usr_id = $createUser->id;
								// Add the customer to the database for the current logged in user
								$insert = "INSERT INTO " . $prefix . "users  
									(wp_users_id, stripe_users_id) 
									VALUES 
									('$usr_id', '$stripe_usr_id')";
								$insert = $wpdb->get_results($insert);
							}
						} else {
							// Create a stripe user for the user of the non logged in user
							$createUser = createStripeCustomer($secret_key, $_POST["stripeToken"], $_POST["remail"], $_POST['rfname']." ".$_POST['rlname']);
							// Get the customer id and set stripe user id variable
							$stripe_usr_id = $createUser->id;
							// Add the customer to the database for the current logged in user
							$insert = "INSERT INTO " . $prefix . "users
								(wp_users_id, stripe_users_id) 
								VALUES 
								('$usr_id', '$stripe_usr_id')";
							$insert = $wpdb->get_results($insert);
						}
					} else {
						// If no entry exists for the email in the form
						// Create a Wordpress User with the email address but do not send a confirmation email...
						$password = wp_generate_password($length = 12, $include_standard_special_chars = false);
                        $hashpass = wp_hash_password($password);
                        $usr_id = wp_create_user($_POST["remail"], $hashpass, $_POST["remail"]);
                        // Manually modifying the password as other plugin is causing conflict
                        $updatePass = "UPDATE " . $wpdb->prefix . "users 
                                       SET user_pass = '$hashpass', display_name = '" . $_POST["rfname"] . " " . $_POST["rlname"] . "' 
                                       WHERE ID = '$usr_id'";
                        $updatePass = $wpdb->get_results($updatePass);
                        // wp_new_user_notification($usr_id, $password);
                        // Create the user
						$createUser = createStripeCustomer($secret_key, $_POST["stripeToken"], $_POST["remail"], $_POST['rfname']." ".$_POST['rlname']);
						// Create the stripe user using the new newly created user's id and stripe token
						$stripe_usr_id = $createUser->id;
						$insert = "INSERT INTO " . $prefix . "users  (wp_users_id, stripe_users_id) VALUES ('$usr_id', '$stripe_usr_id')";
						//Insert into supporters first name, last name and amount... use this to populate the supporters field. 
						$insert = $wpdb->get_results($insert);
					}
				}

				// Get currency code
				$currency_field = 'EUR';
				$currency_stripe = getStripeCurrencyCode($currency_field);
			
				// Get the item purchased
				$id = $_GET['item'];
				// Get the post for the item purchased
				$post = get_post($id);
				// Get the course title / event title
				$courseTitle = $post->post_name;
				$trxDescription.= $courseTitle;
				
				// Charge the stripe token
				// Note: Price in cents
				// User the stripe_user_id to charge the customer
				$charging = chargeWithCustomer($secret_key, $grandTotal * 100, $currency_stripe, $stripe_usr_id, $trxDescription, $_POST["remail"]);
				
				// If the charge was successful
				if ($charging) {
					// Save the transaction in the database
					$amountToSave = $grandTotal;
					$now = date("d/m/Y H:i:s");
					$savesData = "INSERT INTO " . $prefix . "donations 
												(reference_id, stripe_token, amount, anonymous, user_id, date) 
												VALUES 
												('" . $_SESSION["item"] . "', '" . $_POST["stripeToken"] . "', '$amountToSave', '0', '$usr_id', '$now')";
					$wpdb->get_results($savesData);
					$donationId = $wpdb->insert_id;
					$controller = 0;
				}
                
                // Send order confirmation to the item creator
                $order_notification_email_address = $itemToPurchase->order_notification_email_address;
                $rfname = $_POST['rfname'];
                $rlname = $_POST['rlname'];
                $remail = $_POST['remail'];
                $raddress1 = $_POST['raddress1'];
                $raddress2 = $_POST['raddress2'];
                $rcity = $_POST['rcity'];
                $rpost_code = $_POST['rpost_code'];
                $rcountry = $_POST['rcountry'];
                $rphone = $_POST['rphone'];

                if($order_notification_email_address != '') {
                    // lets send email to the notification email
                    $emailString = '<html><head></head><body>';
                    $emailString .= 'New order is received for '.($itemType == 'course' ? 'Course' : 'Event');
                    $emailString .= '<br/>';
                    $emailString .= 'Product: '.$itemToPurchase->post_title;
                    $emailString .= '<br/>';
                    $emailString .= 'First Name: '.$rfname;
                    $emailString .= '<br/>';
                    $emailString .= 'Last Name: '.$rlname;
                    $emailString .= '<br/>';
                    $emailString .= 'Email: '.$remail;
                    $emailString .= '<br/>';
                    $emailString .= 'Address: '.$raddress1.($raddress2 != '' ? ', '.$raddress2 : '');
                    $emailString .= '<br/>';
                    $emailString .= 'City: '.$rcity;
                    $emailString .= '<br/>';
                    $emailString .= 'Post Code: '.$rpost_code;
                    $emailString .= '<br/>';
                    $emailString .= 'Country: '.$rcountry;
                    $emailString .= '<br/>';
                    $emailString .= 'Phone: '.$rphone;
                    $emailString .= '</body></html>';

                    $headers = 'From: IPU Services Limited <no-reply@ipu.ie>' . "\r\n"; // change to what the client wants to recieve emails as
                    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                    wp_mail($order_notification_email_address, 'New Order', $emailString, $headers);
                }

                // Send the confirmation email
                $emailString = 'Thank you for your order. You have successfully purchased a '.($itemType == 'course' ? 'Course' : 'Event').' - '.$itemToPurchase->post_title;
                $headers = 'From: IPU Services Limited <no-reply@ipu.ie>' . "\r\n";
                wp_mail($remail, 'New Order', $emailString, $headers);
				?> 
				The payment is being processed... 
				<script>
                    <?php 
                        $junction = '?';
                        if(strpos($cfg["thank_you_page_url"], '?') !== false) {
                            $junction = '&';
                        }
                    ?>
                    
                    window.open("<?php echo $cfg["thank_you_page_url"] . $junction . "item=" . $_GET['item'].'&fname='.$_POST['rfname'].'&lname='.$_POST['rlname']; ?>", "_self");
                </script> 
				<?php
			} catch (Stripe_CardError $e) {
				?>
				<?php 
				// If there is a payment error notify the customer of failed payment
					$id = $_GET['item'];//project id
					$post = get_post($id);
					$name = $post->post_name;//post name
					// Show stripe error to the user
					$errorMessage = $e->getMessage();
				?>				
				<?= $errorMessage ?>
				<br>
				Something went wrong, please click <a href = "<?= get_site_url() ."/". $name ?> ">here</a> to try again.  
				<?php
			}
		} else {
			?> 


			<script type="text/javascript" src="https://js.stripe.com/v2/"></script> 
			<script type="text/javascript"> 
				function fillOutDonationAmount(){ 
					if ($("#rdonation_amount").val() == "other"){ 
						$("#ddonation_amount_hidden").show(); 
						$("#rdonation_amount_hidden").val(""); 
					}else{ 
						$("#ddonation_amount_hidden").hide(); 
						$("#rdonation_amount_hidden").val($("#rdonation_amount").val()); 
					} 
				} 
			 
				function reward(){ 
					if($("#rgift").is(":checked")){ 
						$("#dgift_email").show(); 
						$("#dgift_name").show(); 
					}else{ 
						$("#dgift_email").hide(); 
						$("#dgift_name").hide(); 
					} 
			 
					if($("#rdontreward").is(":checked")){ 
						$("#address_block").hide(); 
						$('#rgift').prop('checked', false); 
					}else{ 
						$("#address_block").show(); 
					} 
				} 
			 
				function validateFields() { 
			 
					error = 0; 
			 
                    if ($("#rfname").val().length < 2) { 
                        $('#payment_form').find('.fname').text("Invalid"); 
                        $('#dfname').addClass("error"); 
                        error = error + 1; 
                    }

                    if ($("#rfname").val().indexOf("@") >= 0) { 
                        $('#payment_form').find('.fname').text("Invalid"); 
                        $('#dfname').addClass("error"); 
                        error = error + 1; 
                    } 

                    if ($("#rlname").val().indexOf("@") >= 0) { 
                        $('#payment_form').find('.lname').text("Invalid"); 
                        $('#dlname').addClass("error"); 
                        error = error + 1;
                    } 

                    if ($("#rlname").val().length < 2) { 
                        $('#payment_form').find('.lname').text("Invalid"); 
                        $('#dlname').addClass("error"); 
                        error = error + 1;
                    } 
                    if ($("#remail").val().length < 5) { 
                        $('#payment_form').find('.email').text("Invalid"); 
                        $('#demail').addClass("error"); 
                        error = error + 1;
                    }
			 
					if (error > 0){ 
						return 0; 
					}else{ 
						return 1; 
					} 
			 
				} 
				// This identifies your website in the createToken call below
				//Stripe.setPublishableKey('pk_test_VZuTdNe89VLJ8ct8W9MnFTsI');
				
				Stripe.setPublishableKey('<?= $publishable_key ?>');
				
				var stripeResponseHandler = function(status, response) { 
					var $form = $('#payment_form'); 
					$form.find('.form-error').text("");
					$form.find('.error').removeClass("error");
                    
					if (response.error) { 
						error = 0; 
						// Show the errors on the form  
						if (response.error.message == "This card number looks invalid"){ 
							error = error + 1; 
							$form.find('.card_num').text(response.error.message); 
							$('#p_card_num').addClass("error"); 
						} 
						if (response.error.message == "Your card number is incorrect."){ 
							error = error + 1; 
							$form.find('.card_num').text(response.error.message); 
							$('#p_card_num').addClass("error"); 
						} 
						if (response.error.message == "Your card's expiration year is invalid."){ 
							error = error + 1; 
							$form.find('.exp').text(response.error.message); 
							$('#p_exp').addClass("error"); 
						} 
			 
						if (response.error.message == "Your card's expiration month is invalid."){ 
							error = error + 1; 
							$form.find('.exp').text(response.error.message); 
							$('#p_exp').addClass("error"); 
						} 
						if (response.error.message == "Your card's security code is invalid."){ 
							error = error + 1; 
							$form.find('.cvc').text(response.error.message); 
							$('#o_cvc').addClass("error"); 
						} 
			 
						if (error == 0){ 
							$form.find('.payment-errors').text(response.error.message); 
			 
						} 
						$form.find('button').prop('disabled', false); 
					} else {
                        // token contains id, last4, and card type 
                        var token = response.id; 
                        // Insert the token into the form so it gets submitted to the server 
                        $form.append($('<input type="hidden" name="stripeToken" />').val(token)); 
                        // and re-submit 
                        $form.get(0).submit();
					} 
				}; 
			 
				jQuery(function($) { 
					$('#payment_form').submit(function(e) { 
						var $form = $(this); 
                        
                        var validate = validateFields();
                        if(validate) {
                            // Disable the submit button to prevent repeated clicks 
                            $form.find('button').prop('disabled', true); 
                            Stripe.card.createToken($form, stripeResponseHandler); 
                            // Prevent the form from submitting with the default action 
                        }
						return false; 
					}); 
				}); 
			</script> 

			<?php
			//Work out the amount to be donated and store in variable.  
			$currency_field = 'EUR';//get_field('currency', $_GET["item"]);
			$currency = 'EUR';//getCurrencyCode($currency_field);
			$currency_stripe = getStripeCurrencyCode($currency_field);
            
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

            <form id="payment_form" method="POST" action="">
                <div class="payment_address">
                    <div class="w_title">
                        <h3>Payment info</h3>
                        <?php if ($cfg["test_mode"] == 1) { ?>
                        	<p>Stripe: Test Mode</p>
                        <?php } ?>
                        <h2>ADDRESS DETAILS</h2>
                    </div>
                    <div class="payment_fields_wrapper">
                        <input id="qty" type="hidden" name="qty">

                        <div id="dfname" class="field">
                            <label for="rfname">First Name <i>*</i></label>
                            <input id="rfname" class="multiple" value="<?= $initialFirstName ?>" type="text" size="20" name="rfname">
                            <label for='rfname' class='form-error lname'></label> 
                        </div>
                        <div id="dlname" class="field">
                            <label for="rlname">Last Name <i>*</i></label>
                            <input id="rlname" class="multiple" value="<?= $initialLastName ?>" type="text" size="20" name="rlname">
                            <label for='rlname' class='form-error lname'></label> 
                        </div>
                        <div id="demail" class="field">
                            <label for="remail">Email <i>*</i></label>
                            <input id="remail"  value="<?= $initialEmail ?>" class="multiple" type="text" size="20" name="remail">
                            <label for='rfname' class='form-error email'></label> 
                        </div>
                        <div id="daddress1" class="field">
                            <label for="raddress1">Street Address <i>*</i></label>
                            <input id="raddress1" class="multiple" type="text" size="20" name="raddress1">
                            <label for='raddress1' class='form-error address1'></label>
                        </div>
                        <div id="daddress2" class="field">
                            <input id="raddress2" class="multiple" type="text" size="20" name="raddress2">
                            <label for='raddress2' class='form-error address2'></label> 
                        </div>

                        <div id="dcity" class="field">
                            <label for="rcity">City <i>*</i></label>
                            <input id="rcity" type="text" size="20" name="rcity">
                            <label for='rcity' class='form-error city'></label> 
                        </div>
                        <div id="dpost_code" class="field">
                            <label for="rpost_code">Postal Code <b>- if applicable</b></label>
                            <input id="rpost_code" type="text" size="20" name="rpost_code">
                            <label for='rpost_code' class='form-error post_code'></label> 
                        </div>
                        <div id="dcountry" class="field">
                            <label for="p_country">Country <i>*</i></label>
                            <input id="p_country" type="text" size="20" name="rcountry">
                            <label for='rcountry' class='form-error country'></label> 
                        </div>
                        <div id="dphone" class="field">
                            <label for="p_phone">Phone</label>
                            <input id="p_phone" type="text" size="20" name="rphone">
                            <label for='rphone' class='form-error phone'></label> 
                        </div>
                    </div>
                </div>

                <div class="payment_details">
                    <div class="w_title">
                        <h3>Payment info</h3>
                        <h2>Secure Payment Info</h2>
                    </div>
                    <div class="payment_fields_wrapper">
                        <div id="p_card_num" class="form-row field">
                            <label for="card_num">Card Number <b>- No spaces or dashes</b> <i>*</i></label>
                            <input id="card_num" type="text" data-stripe="number" size="20" name="card_num">
                            <label for='card_num' class='form-error card_num'></label> 
                        </div>
                        <div id="p_cvc" class="form-row field">
                            <label for="cvc">CVC Security code <b>- 3 digits at the back of your card</b> <i>*</i></label>
                            <input id="cvc" type="text" data-stripe="cvc" size="4" name="cvc">
                            <label for='cvc' class='form-error cvc'></label> 
                        </div>
                        <div id="p_exp" class="form-row field double_select">
                            <label for="exp">Expiration <b>- MM/YYYY</b>*</label>
                            <div class="select_wrapper select_wrapper_furst">
                                <select class="half" data-stripe="exp-month">
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
                                <select class="half" data-stripe="exp-year">
                                    <option value="2014">2014</option>
                                    <option value="2015">2015</option>
                                    <option value="2016">2016</option>
                                    <option value="2017">2017</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                </select>
                            </div>
                        </div>
                        <div class="form_submit">
                            <input id="submit_payment" class="button center" type="submit" value="Submit Payment">
                            <p>Your credit card will be charged</p>
                        </div>
                    </div>
                </div>
            </form>
			
			<!-- END FORM --> 
			<?php
		}
	}
}

//Other Methods 
function callDonationForm() {
//retrieving config settings 
	$cfg = searchConfigurationInfo();

	if ((!verifiesIfUserIsLogged()) && ($cfg["logged_to_donate"])) {
		?> 
		To continue you must be logged in. Click <a href = "<?php echo wp_login_url(get_permalink()); ?>">here</a> to log in. 
		<?php
	} else {

//displaying custom fields 
		acf_form_head();

		$options = array("form_attributes" => array("action" => $cfg["card_info_page_url"]),
			"submit_value" => "Next");
		acf_form($options);
	}
}

function databaseCheck() {
	global $wpdb;
	$prefix = $wpdb->prefix . "stripe_";
	$verifiesIfConfigurationTableExists = "CREATE TABLE IF NOT EXISTS `" . $prefix . "configuration` ( 
`test_secret_key` varchar(50) NOT NULL, 
`test_publishable_key` varchar(50) NOT NULL, 
`live_secret_key` varchar(50) NOT NULL, 
`live_publishable_key` varchar(50) NOT NULL, 
`donation_page_url` varchar(50) NOT NULL, 
`card_info_page_url` varchar(50) NOT NULL, 
`thank_you_page_url` varchar(50) NOT NULL, 
`test_mode` boolean NOT NULL, 
`logged_to_donate` boolean NOT NULL 
) ";
	$wpdb->get_results($verifiesIfConfigurationTableExists);

	$verifiesIfItsAlreadyPopulated = "SELECT * FROM " . $prefix . "configuration";
	$verifiesIfItsAlreadyPopulated = $wpdb->get_results($verifiesIfItsAlreadyPopulated);
	if (count($verifiesIfItsAlreadyPopulated) == 0) {
		$insert = "INSERT INTO " . $prefix . "configuration  
(test_secret_key, test_publishable_key, live_secret_key, live_publishable_key, donation_page_url, card_info_page_url, thank_you_page_url, test_mode) 
VALUES 
('','','','','','','', 1)";
		$wpdb->get_results($insert);
	}

	$verifiesIfAdvancedCustomFieldsTableExists = "CREATE TABLE IF NOT EXISTS `" . $prefix . "fields` ( 
`id` int(11) NOT NULL AUTO_INCREMENT, 
`donation_id` int(11) NOT NULL, 
`advanced_custom_field` varchar(50) NOT NULL, 
`value` text NOT NULL, 
PRIMARY KEY (`id`) 
)AUTO_INCREMENT=1 ;";
	$wpdb->get_results($verifiesIfAdvancedCustomFieldsTableExists);

	$verifiesIfTheDonationTableExists = "CREATE TABLE IF NOT EXISTS `" . $prefix . "donations` ( 
`id` int(11) NOT NULL AUTO_INCREMENT, 
`reference_id` varchar(50) NOT NULL, 
`user_id` int(11) NULL, 
`stripe_token` varchar(50) NOT NULL, 
`amount` double NOT NULL, 
`anonymous` BOOLEAN NULL, 
`date` varchar(25) NOT NULL, 
PRIMARY KEY (`id`) 
) AUTO_INCREMENT=1 ;";
	$wpdb->get_results($verifiesIfTheDonationTableExists);

	$verifiesIfUserTableExists = "CREATE TABLE IF NOT EXISTS `wp_stripe_users` ( 
`id` int(11) NOT NULL AUTO_INCREMENT, 
`wp_users_id` int(11) NOT NULL, 
`stripe_users_id` varchar(50) NOT NULL, 
PRIMARY KEY (`id`) 
) AUTO_INCREMENT=1 ;";
	$wpdb->get_results($verifiesIfUserTableExists);
}

function searchConfigurationInfo() {

	databaseCheck();

	global $wpdb;
	$prefix = $wpdb->prefix . "stripe_";

	$query = "SELECT * FROM " . $prefix . "configuration";
	$queryResult = $wpdb->get_results($query);
    $result["test_secret_key"] = stripeGetResultSetColumn($queryResult, 0, "test_secret_key");
    $result["test_publishable_key"] = stripeGetResultSetColumn($queryResult, 0, "test_publishable_key");
    $result["live_secret_key"] = stripeGetResultSetColumn($queryResult, 0, "live_secret_key");
    $result["live_publishable_key"] = stripeGetResultSetColumn($queryResult, 0, "live_publishable_key");
    $result["donation_page_url"] = stripeGetResultSetColumn($queryResult, 0, "donation_page_url");
    $result["card_info_page_url"] = stripeGetResultSetColumn($queryResult, 0, "card_info_page_url");
    $result["thank_you_page_url"] = stripeGetResultSetColumn($queryResult, 0, "thank_you_page_url");
    $result["test_mode"] = stripeGetResultSetColumn($queryResult, 0, "test_mode");
    $result["logged_to_donate"] = stripeGetResultSetColumn($queryResult, 0, "logged_to_donate");

	return $result;
}

function stripeGetResultSetColumn($results, $index, $column) {
    if(count($results) > $index) {
        $res = $results[$index];
        if(isset($res->{$column})) {
            return $res->{$column};
        }
    }
    
    return '';
}

function verifiesIfUserIsLogged() {

	if (is_user_logged_in()) {
		return 1;
	} else {
		return 0;
	}
}

function myStartSession() {
	if (!session_id()) {
		session_start();
	}
}

function getCustomFieldsLabel($cfId) {
	global $wpdb;
	$prefixN = $wpdb->prefix;
	$lookingFor = "SELECT * FROM " . $prefixN . "postmeta 
WHERE meta_key = '" . $cfId . "'";
	$lookingFor = $wpdb->get_results($lookingFor);
	$lookingFor = stripeGetResultSetColumn($lookingFor, 0, "meta_value");
	$lookingFor = explode("label", $lookingFor);
	$lookingFor = explode("name", $lookingFor[1]);
	$polishing = $lookingFor[0];
	$polishing = substr($polishing, 8, -7);

	return $polishing;
}

function chargeWithCustomer($secret_key, $amountToDonate, $currency, $customer, $description, $receiptEmail) {
	require_once('plugin/Stripe.php');
	Stripe::setApiKey($secret_key);

	$charging = Stripe_Charge::create(
		array(
			"amount" => $amountToDonate,
			"currency" => $currency,
			"customer" => $customer,
			"description" => $description,
			"receipt_email" => trim($receiptEmail)
		)
	);

	return $charging;
}

function chargeWithToken($secret_key, $amountToDonate, $currency, $token, $description, $receiptEmail) {
	require_once('plugin/Stripe.php');
	Stripe::setApiKey($secret_key);
    
	$charging = Stripe_Charge::create(
		array(
			"amount" => $amountToDonate,
			"currency" => $currency,
			"card" => $token,
			"description" => $description,
			"receipt_email" => trim($receiptEmail)
		)
	);

	return $charging;
}

function createStripeCustomer($secret_key, $token, $email, $name) {
	require_once('plugin/Stripe.php');
	Stripe::setApiKey($secret_key);

	$creating = Stripe_Customer::create(
		array(
			"email" => $email,
			"card" => $token,
			"description" => "Customer for ".$name." / tel:".$_POST['rphone']
		)
	);

	return $creating;
}

function updateCustomerCard($secret_key, $customerRef, $token) {
	require_once('plugin/Stripe.php');
	Stripe::setApiKey($secret_key);

	try {
		$customer = Stripe_Customer::retrieve($customerRef);
		$customer->card = $token;
		$customer->save();

		return true;
	} catch (Stripe_InvalidRequestError $e) {
		// Customer is not valid
		return false;
	}
}

function showSupportersByProjectSender($user_id) {
	global $wpdb;
	$prefix = $wpdb->prefix . "stripe_";
	$donations = $prefix . "donations";
	$users = $prefix . "users";
	$fields = $prefix . "fields";
	$wp_users = $wpdb->prefix . "users";
	$projects = $wpdb->prefix . "posts";

	$findingProjectsOfThisUser = "SELECT * FROM $projects WHERE post_author = '$user_id' AND post_status = 'publish' AND post_type = 'projects'";
	$findingProjectsOfThisUser = $wpdb->get_results($findingProjectsOfThisUser);
	$control = 0;

	$projects = array();
	while (count($findingProjectsOfThisUser) > $control) {
		$id = stripeGetResultSetColumn($findingProjectsOfThisUser, $control, "ID");

		$retrievingDonations = "SELECT * FROM $donations  
INNER JOIN $wp_users ON ($donations.user_id = $wp_users.id) 
WHERE reference_id = '$id' 
ORDER BY $donations.id DESC";
		$retrievingDonations = $wpdb->get_results($retrievingDonations);
		$control2 = 0;
		while (
            ($retrievingDonations) > $control2) {
			$donation_id = stripeGetResultSetColumn($retrievingDonations, $control2, "id");
			$projects[$donation_id]["project_name"] = stripeGetResultSetColumn($findingProjectsOfThisUser, $control, "post_title");
			$anonymous = stripeGetResultSetColumn($retrievingDonations, $control2, "anonymous");
			if ($anonymous) {
				$projects[$donation_id]["user_name"] = "Anonymous";
				$projects[$donation_id]["user_email"] = "Anonymous";
			} else {
				$projects[$donation_id]["user_name"] = stripeGetResultSetColumn($retrievingDonations, $control2, "display_name");
				$projects[$donation_id]["user_email"] = stripeGetResultSetColumn($retrievingDonations, $control2, "user_email");
			}
			$projects[$donation_id]["amount"] = stripeGetResultSetColumn($retrievingDonations, $control2, "amount");
			$projects[$donation_id]["date"] = stripeGetResultSetColumn($retrievingDonations, $control2, "date");

			$collectingAddressFields = "SELECT * FROM $fields  
WHERE  
(advanced_custom_field = 'Address line 1'  
OR advanced_custom_field = 'Address line 2'  
OR advanced_custom_field = 'Post Code'  
OR advanced_custom_field = 'Country') 
AND donation_id = '$donation_id'";
			$collectingAddressFields = $wpdb->get_results($collectingAddressFields);
			$control3 = 0;

			while (count($collectingAddressFields) > $control3) {
				$field = stripeGetResultSetColumn($collectingAddressFields, $control3, "advanced_custom_field");
				$projects[$donation_id]["fields"][$field] = stripeGetResultSetColumn($collectingAddressFields, $control3, "value");
				$control3++;
			}
			$control2++;
		}


		$control++;
	}

	return $projects;
}

function showSupportersByProject($project_id) {
	global $wpdb;
	$prefix = $wpdb->prefix . "stripe_";
	$donations = $prefix . "donations";
	$users = $prefix . "users";
	$fields = $prefix . "fields";
	$wp_users = $wpdb->prefix . "users";
	$projects = $wpdb->prefix . "posts";



	$projects = array();


	$retrievingDonations = "SELECT * FROM $donations  
INNER JOIN $wp_users ON ($donations.user_id = $wp_users.id) 
WHERE reference_id = '$project_id' 
ORDER BY $donations.id DESC";
	$retrievingDonations = $wpdb->get_results($retrievingDonations);
	$control2 = 0;
	while (count($retrievingDonations) > $control2) {
		$donation_id = stripeGetResultSetColumn($retrievingDonations, $control2, "id");
		$projects[$donation_id]["project_name"] = stripeGetResultSetColumn($findingProjectsOfThisUser, $control, "post_title");
		$anonymous = stripeGetResultSetColumn($retrievingDonations, $control2, "anonymous");
		if ($anonymous) {
			$projects[$donation_id]["user_name"] = "Anonymous";
			$projects[$donation_id]["user_email"] = "Anonymous";
		} else {
			$projects[$donation_id]["user_name"] = stripeGetResultSetColumn($retrievingDonations, $control2, "display_name");
			$projects[$donation_id]["user_email"] = stripeGetResultSetColumn($retrievingDonations, $control2, "user_email");
		}
		$projects[$donation_id]["amount"] = stripeGetResultSetColumn($retrievingDonations, $control2, "amount");
		$projects[$donation_id]["date"] = stripeGetResultSetColumn($retrievingDonations, $control2, "date");
		$control2++;
	}
	return $projects;
}

function savesField($donationId, $fieldName, $fieldValue) {
	global $wpdb;
	$prefix = $wpdb->prefix . "stripe_";
	$savesData = "INSERT INTO " . $prefix . "fields 
(donation_id, advanced_custom_field, value) 
VALUES 
('$donationId', '$fieldName', '$fieldValue')";
	$wpdb->get_results($savesData);
}

function getStripeCurrencyCode($currency) {

	if (strtolower($currency) == "eur") {
		return "eur";
	}
	if (strtolower($currency) == "uk sterling") {
		return "gbp";
	}
	if (strtolower($currency) == "us dollar") {
		return "usd";
	}
}
?>