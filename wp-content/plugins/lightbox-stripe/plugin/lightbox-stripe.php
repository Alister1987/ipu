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
    add_submenu_page('stripeAdmin', 'Donations', 'Donations', 'manage_options', 'stripeAdminDonations', 'adminDonationsPage');
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
            Donations
        </h1>

        <table class = "wp-list-table widefat fixed users">
            <thead>
                <tr>
                    <th>Nome</th>
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
                $retrievingDonations = mysql_query($retrievingDonations);

                $control = 0;
                while (mysql_num_rows($retrievingDonations) > $control) {
                    $donation_id = mysql_result($retrievingDonations, $control, "id");
                    $name = mysql_result($retrievingDonations, $control, "display_name");
                    $email = mysql_result($retrievingDonations, $control, "user_email");
                    $amount = mysql_result($retrievingDonations, $control, "amount");
                    $reference = mysql_result($retrievingDonations, $control, "reference_id");
                    $date = mysql_result($retrievingDonations, $control, "date");

                    $catchingAdvancedCustomFields = "SELECT * FROM $fields
                                             WHERE donation_id = '$donation_id'";
                    $catchingAdvancedCustomFields = mysql_query($catchingAdvancedCustomFields);
                    ?>
                    <tr>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $email; ?></td>
                        <td>
                            <?php
                            $searchProjects = "SELECT * FROM $projects
                                           WHERE ID = '$reference'";
                            $searchProjects = mysql_query($searchProjects);
                            if (mysql_num_rows($searchProjects) > 0) {
                                echo mysql_result($searchProjects, 0, "post_title");
                            }
                            ?>
                        </td>
                        <td><?php echo $amount; ?></td>
                        <td>
                            <?php
                            $control2 = 0;
                            while (mysql_num_rows($catchingAdvancedCustomFields) > $control2) {
                                $customField = mysql_result($catchingAdvancedCustomFields, $control2, "advanced_custom_field");
                                $value = mysql_result($catchingAdvancedCustomFields, $control2, "value");
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
                            test_mode = '" . $_POST["test_mode"] . "',
                            logged_to_donate = '" . $_POST["logged_to_donate"] . "'";
            $query = mysql_query($query);

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
	
	//Get the settings from the wordpress Admin Panel
    $cfg = searchConfigurationInfo();
	
    if ((!verifiesIfUserIsLogged()) && ($cfg["logged_to_donate"])) {//You must be logged in to donate...
        ?>
        To continue you must be logged in. Click <a href = "<?php echo wp_login_url(get_permalink()); ?>">here</a> to log in.
	
   <?php 
    } else { //You do not need to be logged in to donate...
		//Set the correct API Keys
        if ($cfg["test_mode"] == 1) { //TEST MODE
            $publishable_key = $cfg["test_publishable_key"];
            $secret_key = $cfg["test_secret_key"];
        } else { //LIVE MODE
            $publishable_key = $cfg["live_publishable_key"];
            $secret_key = $cfg["live_secret_key"];
        }

		//If token has been defined, begin the transaction
        if (isset($_POST["stripeToken"])) {
			echo "here";die();
            $_SESSION["project"] = $_GET["project"];//Get the project name
            $_SESSION["amount"] = $_GET["amount"];//Get the amount to donate
            if ($_POST["rdonation_amount_hidden"] > 0){
                $_SESSION["amount"] = $_POST["rdonation_amount_hidden"] * 100;
            }
			
            try {//Try to process payment
                global $wpdb;
                $prefix = $wpdb->prefix . "stripe_";
				echo $prefix;die();
				
                //Quick search through the array to check if the "Amount to Donate" and the "Anonymity Mode" fields have been created
                $fieldsToBeStored = $_SESSION["fields"];
                $keys = array_keys($fieldsToBeStored);

                foreach ($keys as $key) {
                    if (getCustomFieldsLabel($key) == "Amount to Donate") {
                        $amountToDonate = $fieldsToBeStored[$key] * 100;
                    }
                    if (getCustomFieldsLabel($key) == "Anonymity Mode") {
                        $anonymousDonation = 1;
                    }
                }

                if (!$amountToDonate) {
                    $amountToDonate = $_SESSION["amount"];
                }
				
                $anonymousDonation = $_POST["ranonymous"];
                if (verifiesIfUserIsLogged()) {//If user is logged in
                    $usr_id = get_current_user_id(); //Get the user id
                    $searchEntryOnData = "SELECT * FROM " . $prefix . "users WHERE wp_users_id = '$usr_id'"; //Select user data from stripe_users
                    $searchEntryOnData = mysql_query($searchEntryOnData);//execute query and return resutls
                    if (mysql_num_rows($searchEntryOnData) > 0) {//if result get the stripe_users_id
                        $stripe_usr_id = mysql_result($searchEntryOnData, 0, "stripe_users_id");
                    } else {//else first payment so create user
                        $createUser = createUser($secret_key, $_POST["stripeToken"], wp_get_current_user()->user_email);
                        $stripe_usr_id = $createUser->id;
                        $insert = "INSERT INTO " . $prefix . "users (wp_users_id, stripe_users_id)VALUES ('$usr_id', '$stripe_usr_id')";
                        $insert = mysql_query($insert);
                    }
                } else {//User is not logged in
					//SELECT ALL FROM STRIPE_USERS WHERE EMAIL = POSTED EMAIL
                    $searchEntryOnData = "SELECT * FROM " . $wpdb->prefix . "users WHERE user_email = '" . $_POST["remail"] . "'";		
					
                    $searchEntryOnData = mysql_query($searchEntryOnData);
                    if (mysql_num_rows($searchEntryOnData) > 0) {
                        $usr_id = mysql_result($searchEntryOnData, 0, "ID");
                    }else{
						//Wordpress user creation
                        $password = wp_generate_password( $length=12, $include_standard_special_chars=false );
                        $hashpass = wp_hash_password($password);
                        $usr_id = wp_create_user($_POST["remail"], $hashpass, $_POST["remail"]);
                       // manually modifying the password as other plugin is causing conflict
                        $updatePass = "UPDATE " . $wpdb->prefix  . "users 
                                       SET user_pass = '$hashpass', display_name = '". $_POST["rfname"] . " " .  $_POST["rlname"] . "' 
                                       WHERE ID = '$usr_id'";
                        $updatePass = mysql_query($updatePass);
                        //wp_new_user_notification($usr_id, $password);
						//End Wordpress User Creation
						//Stripe USER
						$createUser = createUser($secret_key, $_POST["stripeToken"], $_POST["remail"]);
						$stripe_usr_id = $createUser->id;
						$insert = "INSERT INTO " . $prefix . "users 
													(wp_users_id, stripe_users_id)
													VALUES
													('$usr_id', '$stripe_usr_id')";
						$insert = mysql_query($insert);
                    }
                }
			
                $currency_field = get_field('currency', $_SESSION["project"]);
                $currency_stripe = getStripeCurrencyCode($currency_field);
                if (!empty($stripe_usr_id)) {
					$charging = chargeWithCustomer($secret_key, $amountToDonate, $currency_stripe, $stripe_usr_id);
                } else {
                    $charging = chargeWithToken($secret_key, $amountToDonate, $currency_stripe, $_POST["stripeToken"]);
                }
				
				
                if ($charging) {
                    $amountToSave = $amountToDonate / 100;
                    $now = date("d/m/Y H:i:s");
                    $savesData = "INSERT INTO " . $prefix . "donations
                                     (reference_id, stripe_token, amount, anonymous, user_id, date)
                                     VALUES
                                     ('" . $_SESSION["project"] . "', '" . $_POST["stripeToken"] . "', '$amountToSave', '$anonymousDonation', '$usr_id', '$now')";
				
                    mysql_query($savesData);
                    $donationId = mysql_insert_id();
                    $controller = 0;
                    
                    if ($_POST["rdontreward"] == "yes"){ //If don't reward equals true (doesn't want a reward)
                        savesField($donationId, "Reward", "No");
                    }else{
                        savesField($donationId, "Reward", "Yes");
                        savesField($donationId, "Address line 1", $_POST["raddress1"]);
                        savesField($donationId, "Address line 2", $_POST["raddress2"]);
                        savesField($donationId, "Phone", $_POST["rphone"]);
                        savesField($donationId, "Post code", $_POST["rpost_code"]);
                        savesField($donationId, "Country", $_POST["rcountry"]);
                        savesField($donationId, "City", $_POST["rcity"]);
                    }
                    $user_info = get_userdata($usr_id);
                    
                    if ($_POST["rgift"] == "yes"){
                        savesField($donationId, "Gift", "It is a gift");
                        savesField($donationId, "Recipients Name", $_POST["rgift_name"]);
                        savesField($donationId, "Recipients Email", $_POST["rgift_email"]);
                        
                        $subjectMSG = $user_info->display_name . " has sent you a gift!";
                        $messageMSG = "Dear " . $_POST["rgift_name"] . ",

						" . $user_info->display_name . " has supported " . get_field("athlete_name", $_SESSION["project"] ) . " on your behalf and you will receive a reward shortly!

						Keep up to date with PledgeSports on Twitter and Facebook!
						@PledgeSports, @PledgeSportsUK https://www.facebook.com/pledgesports

						Please share this with your friend";
												wp_mail( $_POST["rgift_email"], $subjectMSG, $messageMSG);
                    }

                    foreach ($fieldsToBeStored as $field) {
                        //Before inserting, looks for the Advanced Custom Field's Label
                        $lookingFor = getCustomFieldsLabel($keys[$controller]);

                        //Inserts
                        $savesData = "INSERT INTO " . $prefix . "fields(donation_id, advanced_custom_field, value)
										VALUES ('$donationId', '" . $lookingFor . "', '$field')";
                        mysql_query($savesData);
                        $controller++;
                    }
                }
                ?>
				 The payment is being processed...
					<script>window.open("<?php echo $cfg["thank_you_page_url"]."?project=".$_GET['project']; ?>", "_self");</script>
                <?php
            } catch (Stripe_CardError $e) {//There was an error processing the payment, display message to user. 
                ?>
					Something went wrong, please click <a href = "<?= $cfg["donation_page_url"]; ?>">here</a> to try again. 
                <?php
            }
        } else { //No token defined, no payment could be made.
            $_SESSION["fields"] = $_POST["fields"];
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

                    <?php if (!verifiesIfUserIsLogged()): ?>
                                if ($("#rfname").val().length < 2) {
                                    $('#payment-form').find('.fname').text("Invalid");
                                    $('#dfname').addClass("error");
                                    error = error + 1;
                                }
                                
                                if ($("#rfname").val().indexOf("@") >= 0) {
                                    $('#payment-form').find('.fname').text("Invalid");
                                    $('#dfname').addClass("error");
                                    error = error + 1;
                                }
                                
                                 if ($("#rlname").val().indexOf("@") >= 0) {
                                    $('#payment-form').find('.lname').text("Invalid");
                                    $('#dlname').addClass("error");
                                    error = error + 1;
                                }
                                
                                if ($("#rlname").val().length < 2) {
                                    $('#payment-form').find('.lname').text("Invalid");
                                    $('#dlname').addClass("error");
                                     error = error + 1;
                                }
                                if ($("#remail").val().length < 5) {
                                    $('#payment-form').find('.email').text("Invalid");
                                    $('#demail').addClass("error");
                                    error = error + 1;
                                }
                    <?php endif ?>
                        
                    if($("#rgift").is(":checked")){
                        if ($("#rgift_email").val().length < 5) {
                            $('#payment-form').find('.gift_email').text("Invalid");
                            $('#dgift_email').addClass("error");
                            error = error + 1;
                        }
                        
                        if ($("#rgift_name").val().length < 5) {
                            $('#payment-form').find('.gift_name').text("Invalid");
                            $('#dgift_name').addClass("error");
                            error = error + 1;
                        }
                        
                        if ($("#rgift_name").val().indexOf("@") >= 0) {
                            $('#payment-form').find('.gift_name').text("Invalid");
                            $('#dgift_name').addClass("error");
                            error = error + 1;
                        }
                    }
                    
                    if(!$("#rdontreward").is(":checked")){
                        
                        if ($("#raddress1").val().length < 5) {
                            $('#payment-form').find('.address1').text("Invalid");
                            $('#daddress1').addClass("error");
                            error = error + 1;
                        }



                        if ($("#rcountry").val().length < 5) {
                            $('#payment-form').find('.country').text("Invalid");
                            $('#dcountry').addClass("error");
                            error = error + 1;
                        }

                        if ($("#rcity").val().length < 3) {
                            $('#payment-form').find('.city').text("Invalid");
                            $('#dcity').addClass("error");
                            error = error + 1;
                        }
                        
                    }
                    
                    if ($("#rdonation_amount_hidden").val() < 1) {
                        $('#payment-form').find('.donation_amount_hidden').text("Invalid amount specified");
                        $('#ddonation_amount_hidden').addClass("error");
                        error = error + 1;
                    }
                    
                    if ($("#rdonation_amount").val() < 1) {
                        $('#payment-form').find('.donation_amount').text("Invalid amount specified");
                        $('#ddonation_amount').addClass("error");
                        error = error + 1;
                    }
                    
                    if (error > 0){
                        return 0;
                    }else{
                        return 1;
                    }
                    
                }
                // This identifies your website in the createToken call below
                Stripe.setPublishableKey('<?php echo $publishable_key; ?>');

                var stripeResponseHandler = function(status, response) {
                    var $form = $('#payment-form');
                    $form.find('.form-error').text("")
                    $form.find('.error').removeClass("error")
                    validate = validateFields();
                    
                    if (response.error) {
                        error = 0;
                        // Show the errors on the form                        
                        if (response.error.message == "This card number looks invalid"){
                            error = error + 1;
                            $form.find('.card_num').text(response.error.message);
                            $('#dcard_num').addClass("error");
                        }
                        
                        if (response.error.message == "Your card number is incorrect."){
                            error = error + 1;
                            $form.find('.card_num').text(response.error.message);
                            $('#dcard_num').addClass("error");
                        }
                        
                        if (response.error.message == "Your card's expiration year is invalid."){
                            error = error + 1;
                            $form.find('.exp').text(response.error.message);
                            $('#dexp').addClass("error");
                        }
                        
                        if (response.error.message == "Your card's expiration month is invalid."){
                            error = error + 1;
                            $form.find('.exp').text(response.error.message);
                            $('#dexp').addClass("error");
                        }
                        
                        if (response.error.message == "Your card's security code is invalid."){
                            error = error + 1;
                            $form.find('.cvc').text(response.error.message);
                            $('#dcvc').addClass("error");
                        }
                        
                        if (error == 0){
                            $form.find('.payment-errors').text(response.error.message);

                        }
                        
                        $form.find('button').prop('disabled', false);
                        
                    } else {
                        
                        if (validate == 1){
                            // token contains id, last4, and card type
                            var token = response.id;
                            // Insert the token into the form so it gets submitted to the server
                            $form.append($('<input type="hidden" name="stripeToken" />').val(token));
                            // and re-submit

                            $form.get(0).submit();
                        }
                    }
                };

                jQuery(function($) {
                    $('#payment-form').submit(function(e) {
                        var $form = $(this);
                        // Disable the submit button to prevent repeated clicks
                        $form.find('button').prop('disabled', true);
                        Stripe.card.createToken($form, stripeResponseHandler);
                        // Prevent the form from submitting with the default action
                        return false;
                    });
                });
            </script>
			
            <?php 
				//Work out the amount to be donated and store in variable. 
				$currency_field = get_field('currency', $_GET["project"]);
				$currency = getCurrencyCode($currency_field);
				$currency_stripe = getStripeCurrencyCode($currency_field);
            ?>
            
			<!-- Payment Form for Project -->
            <form class = "nice_form" action="" method="POST" id="payment-form" autocomplete = "off">
			  <!-- 1. Your Contribution -->
              <div class="s_donation_info">
                    <h2><b>1</b>Your contribution</h2>
						<?php if ($_GET["amount"]): ?>
							<p class = "donate_amount">You're about to donate <?php echo $currency; ?><?php echo $_GET["amount"] / 100; ?></p>
						<?php else: ?>
                    <div class='field' id = "ddonation_amount">
                  
                        <label for='rdonation_amount'>I'm going to donate...*</label>
                        <select id="rdonation_amount" name="rdonation_amount" onChange= "fillOutDonationAmount();">
                            <option value = "">Select an amount here</option>
                            <?php while(the_repeater_field('fund_levels', $_GET["project"])): 
                                 if (get_sub_field('limited')): 
                                     if (getTakenLevels(get_sub_field('cost'), get_the_id()) < get_sub_field('limit')):?>
                                        <option value = "<?php echo get_sub_field('cost')?>"><?php echo $currency . get_sub_field('cost') . " - " . get_sub_field('title');?> </option>
                                    <?php endif;
                                  else:?>
                                    <option value = "<?php echo get_sub_field('cost')?>"><?php echo $currency . get_sub_field('cost') . " - " . get_sub_field('title'); ?></option>
                            <?php endif; ?>
                        <?php endwhile; ?>
                            <option value = "other">Other amount</option>
                        </select>
                        <label for='rdonation_amount' class='form-error donation_amount'></label>
                    </div>
                    <div class='field hidden' id = "ddonation_amount_hidden">
                        <label for='rdonation_amount_hidden'>Amount*</label>
                        <?php echo $currency; ?><input name = "rdonation_amount_hidden" id = "rdonation_amount_hidden" type="text" size="10" class = "half"/> 
                        <label for='rdonation_amount_hidden' class='form-error donation_amount_hidden '></label>
                    </div>
                <?php endif; ?>
                    <div class='field' id = "ddontreward">
                        <input name = "rdontreward" value = "yes" id = "rdontreward" type="checkbox" onClick = "reward()"/>  
                        <label for='rdontreward'>Don't send me a reward, I just want to support</label>
                    </div>
                </div>
			    <!-- End Your Contribution --> 

				<!-- 2. About You -->
                <div id ="personal_block" class="s_personal_info">
                    <h2><b>2</b> About you</h2>
                    <?php if (!verifiesIfUserIsLogged()): ?>
                        <div class='s_wrapper'>
                            <div class='field' id = "dfname">
                                <label for='rfname'>First Name*</label>
                                <input name = "rfname" id = "rfname" type="text" size="20" />  
                                <label for='rfname' class='form-error fname'></label>
                            </div>
                            <div class='field' id = "dlname">
                                <label for='rlname' >Last Name*</label>
                                <input name = "rlname" id = "rlname" type="text" size="20" />  
                                <label for='rfname' class='form-error lname'></label>
                            </div>
                      </div>
                        <div class='field' id = "demail">
                            <label for='remail' >Email*</label>
                            <input name = "remail" id = "remail" type="text" size="20" /> 
                            <label for='rfname' class='form-error email'></label>
                        </div>
                    <?php endif; ?>
                    <div class='field' id = "danonymous">
                        <input name = "ranonymous" value = "1" id = "ranonymous" type="checkbox" />  
                        <label for='ranonymous'>I would like to support this project anonymously</label>
                    </div>
                </div>
				<!-- End About You -->

                <!-- 3. Receive your Reward -->
                <div id ="address_block" class="s_adress_info">
                    <h2><b>3</b> Receive your Reward</h2>
                    <div class='field' id = "dgift">
                        <input name = "rgift" id = "rgift" type="checkbox" value = "yes" onClick = "reward();"/>  
                        <label for='rgift'>I want to send this reward as a gift to someone</label>
                    </div>
                    <div class='field hidden' id = "dgift_name">
                        <label for='rgift_name'>Name of the person you want to receive this gift*</label>
                        <input name = "rgift_name" id = "rgift_name" type="text" size="20" /> 
                        <label for='rgift_name' class='form-error gift_name'></label>
                    </div>
                    <div class='field hidden' id = "dgift_email">
                        <label for='rgift_email'>Email of the person you want to receive this gift*</label>
                        <input name = "rgift_email" id = "rgift_email" type="text" size="20" /> 
                        <label for='rgift_email' class='form-error gift_email'></label>
                    </div>
                    <div class='field' id = "daddress1">
                        <label for='raddress1'>Street address*</label>
                        <input class='multiple' name="raddress1" id = "raddress1" type="text" size="20" />   
                        <label for='raddress1' class='form-error address1'></label>
                    </div>
                    <div class='field' id = "daddress2">
                        <input class='multiple' name="raddress2" id = "raddress2" type="text" size="20"/>
                        <label for='raddress2' class='form-error address2'></label>
                    </div>
                    <div class='field' id = "dcity">
                        <label for='rcity'>City*</label>
                        <input name = "rcity" id = "rcity" type="text" size="20" />  
                        <label for='rcity' class='form-error city'></label>
                    </div>
                    <div class='field' id = "dpost_code">
                        <label for='rpost_code'>Post Code</label>
                        <input name = "rpost_code" id = "rpost_code" type="text" size="20" /> 
                        <label for='rpost_code' class='form-error post_code'></label>
                    </div>
                    <div class='field' id = "dcountry">
                        <label for='rcountry'>Country*</label>
                        <select name = "rcountry" id = "rcountry" >
                            <option value="Afghanistan" title="Afghanistan">Afghanistan</option>
                            <option value="Åland Islands" title="Åland Islands">Åland Islands</option>
                            <option value="Albania" title="Albania">Albania</option>
                            <option value="Algeria" title="Algeria">Algeria</option>
                            <option value="American Samoa" title="American Samoa">American Samoa</option>
                            <option value="Andorra" title="Andorra">Andorra</option>
                            <option value="Angola" title="Angola">Angola</option>
                            <option value="Anguilla" title="Anguilla">Anguilla</option>
                            <option value="Antarctica" title="Antarctica">Antarctica</option>
                            <option value="Antigua and Barbuda" title="Antigua and Barbuda">Antigua and Barbuda</option>
                            <option value="Argentina" title="Argentina">Argentina</option>
                            <option value="Armenia" title="Armenia">Armenia</option>
                            <option value="Aruba" title="Aruba">Aruba</option>
                            <option value="Australia" title="Australia">Australia</option>
                            <option value="Austria" title="Austria">Austria</option>
                            <option value="Azerbaijan" title="Azerbaijan">Azerbaijan</option>
                            <option value="Bahamas" title="Bahamas">Bahamas</option>
                            <option value="Bahrain" title="Bahrain">Bahrain</option>
                            <option value="Bangladesh" title="Bangladesh">Bangladesh</option>
                            <option value="Barbados" title="Barbados">Barbados</option>
                            <option value="Belarus" title="Belarus">Belarus</option>
                            <option value="Belgium" title="Belgium">Belgium</option>
                            <option value="Belize" title="Belize">Belize</option>
                            <option value="Benin" title="Benin">Benin</option>
                            <option value="Bermuda" title="Bermuda">Bermuda</option>
                            <option value="Bhutan" title="Bhutan">Bhutan</option>
                            <option value="Bolivia, Plurinational State of" title="Bolivia, Plurinational State of">Bolivia, Plurinational State of</option>
                            <option value="Bonaire, Sint Eustatius and Saba" title="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba</option>
                            <option value="Bosnia and Herzegovina" title="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                            <option value="Botswana" title="Botswana">Botswana</option>
                            <option value="Bouvet Island" title="Bouvet Island">Bouvet Island</option>
                            <option value="Brazil" title="Brazil">Brazil</option>
                            <option value="British Indian Ocean Territory" title="British Indian Ocean Territory">British Indian Ocean Territory</option>
                            <option value="Brunei Darussalam" title="Brunei Darussalam">Brunei Darussalam</option>
                            <option value="Bulgaria" title="Bulgaria">Bulgaria</option>
                            <option value="Burkina Faso" title="Burkina Faso">Burkina Faso</option>
                            <option value="Burundi" title="Burundi">Burundi</option>
                            <option value="Cambodia" title="Cambodia">Cambodia</option>
                            <option value="Cameroon" title="Cameroon">Cameroon</option>
                            <option value="Canada" title="Canada">Canada</option>
                            <option value="Cape Verde" title="Cape Verde">Cape Verde</option>
                            <option value="Cayman Islands" title="Cayman Islands">Cayman Islands</option>
                            <option value="Central African Republic" title="Central African Republic">Central African Republic</option>
                            <option value="Chad" title="Chad">Chad</option>
                            <option value="Chile" title="Chile">Chile</option>
                            <option value="China" title="China">China</option>
                            <option value="Christmas Island" title="Christmas Island">Christmas Island</option>
                            <option value="Cocos (Keeling) Islands" title="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                            <option value="Colombia" title="Colombia">Colombia</option>
                            <option value="Comoros" title="Comoros">Comoros</option>
                            <option value="Congo" title="Congo">Congo</option>
                            <option value="Congo, the Democratic Republic of the" title="Congo, the Democratic Republic of the">Congo, the Democratic Republic of the</option>
                            <option value="Cook Islands" title="Cook Islands">Cook Islands</option>
                            <option value="Costa Rica" title="Costa Rica">Costa Rica</option>
                            <option value="Côte d'Ivoire" title="Côte d'Ivoire">Côte d'Ivoire</option>
                            <option value="Croatia" title="Croatia">Croatia</option>
                            <option value="Cuba" title="Cuba">Cuba</option>
                            <option value="Curaçao" title="Curaçao">Curaçao</option>
                            <option value="Cyprus" title="Cyprus">Cyprus</option>
                            <option value="Czech Republic" title="Czech Republic">Czech Republic</option>
                            <option value="Denmark" title="Denmark">Denmark</option>
                            <option value="Djibouti" title="Djibouti">Djibouti</option>
                            <option value="Dominica" title="Dominica">Dominica</option>
                            <option value="Dominican Republic" title="Dominican Republic">Dominican Republic</option>
                            <option value="Ecuador" title="Ecuador">Ecuador</option>
                            <option value="Egypt" title="Egypt">Egypt</option>
                            <option value="El Salvador" title="El Salvador">El Salvador</option>
                            <option value="Equatorial Guinea" title="Equatorial Guinea">Equatorial Guinea</option>
                            <option value="Eritrea" title="Eritrea">Eritrea</option>
                            <option value="Estonia" title="Estonia">Estonia</option>
                            <option value="Ethiopia" title="Ethiopia">Ethiopia</option>
                            <option value="Falkland Islands (Malvinas)" title="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                            <option value="Faroe Islands" title="Faroe Islands">Faroe Islands</option>
                            <option value="Fiji" title="Fiji">Fiji</option>
                            <option value="Finland" title="Finland">Finland</option>
                            <option value="France" title="France">France</option>
                            <option value="French Guiana" title="French Guiana">French Guiana</option>
                            <option value="French Polynesia" title="French Polynesia">French Polynesia</option>
                            <option value="French Southern Territories" title="French Southern Territories">French Southern Territories</option>
                            <option value="Gabon" title="Gabon">Gabon</option>
                            <option value="Gambia" title="Gambia">Gambia</option>
                            <option value="Georgia" title="Georgia">Georgia</option>
                            <option value="Germany" title="Germany">Germany</option>
                            <option value="Ghana" title="Ghana">Ghana</option>
                            <option value="Gibraltar" title="Gibraltar">Gibraltar</option>
                            <option value="Greece" title="Greece">Greece</option>
                            <option value="Greenland" title="Greenland">Greenland</option>
                            <option value="Grenada" title="Grenada">Grenada</option>
                            <option value="Guadeloupe" title="Guadeloupe">Guadeloupe</option>
                            <option value="Guam" title="Guam">Guam</option>
                            <option value="Guatemala" title="Guatemala">Guatemala</option>
                            <option value="Guernsey" title="Guernsey">Guernsey</option>
                            <option value="Guinea" title="Guinea">Guinea</option>
                            <option value="Guinea-Bissau" title="Guinea-Bissau">Guinea-Bissau</option>
                            <option value="Guyana" title="Guyana">Guyana</option>
                            <option value="Haiti" title="Haiti">Haiti</option>
                            <option value="Heard Island and McDonald Islands" title="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
                            <option value="Holy See (Vatican City State)" title="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                            <option value="Honduras" title="Honduras">Honduras</option>
                            <option value="Hong Kong" title="Hong Kong">Hong Kong</option>
                            <option value="Hungary" title="Hungary">Hungary</option>
                            <option value="Iceland" title="Iceland">Iceland</option>
                            <option value="India" title="India">India</option>
                            <option value="Indonesia" title="Indonesia">Indonesia</option>
                            <option value="Iran, Islamic Republic of" title="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                            <option value="Iraq" title="Iraq">Iraq</option>
                            <option value="Ireland" title="Ireland" selected>Ireland</option>
                            <option value="Isle of Man" title="Isle of Man">Isle of Man</option>
                            <option value="Israel" title="Israel">Israel</option>
                            <option value="Italy" title="Italy">Italy</option>
                            <option value="Jamaica" title="Jamaica">Jamaica</option>
                            <option value="Japan" title="Japan">Japan</option>
                            <option value="Jersey" title="Jersey">Jersey</option>
                            <option value="Jordan" title="Jordan">Jordan</option>
                            <option value="Kazakhstan" title="Kazakhstan">Kazakhstan</option>
                            <option value="Kenya" title="Kenya">Kenya</option>
                            <option value="Kiribati" title="Kiribati">Kiribati</option>
                            <option value="Korea, Democratic People's Republic of" title="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                            <option value="Korea, Republic of" title="Korea, Republic of">Korea, Republic of</option>
                            <option value="Kuwait" title="Kuwait">Kuwait</option>
                            <option value="Kyrgyzstan" title="Kyrgyzstan">Kyrgyzstan</option>
                            <option value="Lao People's Democratic Republic" title="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                            <option value="Latvia" title="Latvia">Latvia</option>
                            <option value="Lebanon" title="Lebanon">Lebanon</option>
                            <option value="Lesotho" title="Lesotho">Lesotho</option>
                            <option value="Liberia" title="Liberia">Liberia</option>
                            <option value="Libya" title="Libya">Libya</option>
                            <option value="Liechtenstein" title="Liechtenstein">Liechtenstein</option>
                            <option value="Lithuania" title="Lithuania">Lithuania</option>
                            <option value="Luxembourg" title="Luxembourg">Luxembourg</option>
                            <option value="Macao" title="Macao">Macao</option>
                            <option value="Macedonia, the former Yugoslav Republic of" title="Macedonia, the former Yugoslav Republic of">Macedonia, the former Yugoslav Republic of</option>
                            <option value="Madagascar" title="Madagascar">Madagascar</option>
                            <option value="Malawi" title="Malawi">Malawi</option>
                            <option value="Malaysia" title="Malaysia">Malaysia</option>
                            <option value="Maldives" title="Maldives">Maldives</option>
                            <option value="Mali" title="Mali">Mali</option>
                            <option value="Malta" title="Malta">Malta</option>
                            <option value="Marshall Islands" title="Marshall Islands">Marshall Islands</option>
                            <option value="Martinique" title="Martinique">Martinique</option>
                            <option value="Mauritania" title="Mauritania">Mauritania</option>
                            <option value="Mauritius" title="Mauritius">Mauritius</option>
                            <option value="Mayotte" title="Mayotte">Mayotte</option>
                            <option value="Mexico" title="Mexico">Mexico</option>
                            <option value="Micronesia, Federated States of" title="Micronesia, Federated States of">Micronesia, Federated States of</option>
                            <option value="Moldova, Republic of" title="Moldova, Republic of">Moldova, Republic of</option>
                            <option value="Monaco" title="Monaco">Monaco</option>
                            <option value="Mongolia" title="Mongolia">Mongolia</option>
                            <option value="Montenegro" title="Montenegro">Montenegro</option>
                            <option value="Montserrat" title="Montserrat">Montserrat</option>
                            <option value="Morocco" title="Morocco">Morocco</option>
                            <option value="Mozambique" title="Mozambique">Mozambique</option>
                            <option value="Myanmar" title="Myanmar">Myanmar</option>
                            <option value="Namibia" title="Namibia">Namibia</option>
                            <option value="Nauru" title="Nauru">Nauru</option>
                            <option value="Nepal" title="Nepal">Nepal</option>
                            <option value="Netherlands" title="Netherlands">Netherlands</option>
                            <option value="New Caledonia" title="New Caledonia">New Caledonia</option>
                            <option value="New Zealand" title="New Zealand">New Zealand</option>
                            <option value="Nicaragua" title="Nicaragua">Nicaragua</option>
                            <option value="Niger" title="Niger">Niger</option>
                            <option value="Nigeria" title="Nigeria">Nigeria</option>
                            <option value="Niue" title="Niue">Niue</option>
                            <option value="Norfolk Island" title="Norfolk Island">Norfolk Island</option>
                            <option value="Northern Mariana Islands" title="Northern Mariana Islands">Northern Mariana Islands</option>
                            <option value="Norway" title="Norway">Norway</option>
                            <option value="Oman" title="Oman">Oman</option>
                            <option value="Pakistan" title="Pakistan">Pakistan</option>
                            <option value="Palau" title="Palau">Palau</option>
                            <option value="Palestinian Territory, Occupied" title="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                            <option value="Panama" title="Panama">Panama</option>
                            <option value="Papua New Guinea" title="Papua New Guinea">Papua New Guinea</option>
                            <option value="Paraguay" title="Paraguay">Paraguay</option>
                            <option value="Peru" title="Peru">Peru</option>
                            <option value="Philippines" title="Philippines">Philippines</option>
                            <option value="Pitcairn" title="Pitcairn">Pitcairn</option>
                            <option value="Poland" title="Poland">Poland</option>
                            <option value="Portugal" title="Portugal">Portugal</option>
                            <option value="Puerto Rico" title="Puerto Rico">Puerto Rico</option>
                            <option value="Qatar" title="Qatar">Qatar</option>
                            <option value="Réunion" title="Réunion">Réunion</option>
                            <option value="Romania" title="Romania">Romania</option>
                            <option value="Russian Federation" title="Russian Federation">Russian Federation</option>
                            <option value="Rwanda" title="Rwanda">Rwanda</option>
                            <option value="Saint Barthélemy" title="Saint Barthélemy">Saint Barthélemy</option>
                            <option value="Saint Helena, Ascension and Tristan da Cunha" title="Saint Helena, Ascension and Tristan da Cunha">Saint Helena, Ascension and Tristan da Cunha</option>
                            <option value="Saint Kitts and Nevis" title="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                            <option value="Saint Lucia" title="Saint Lucia">Saint Lucia</option>
                            <option value="Saint Martin (French part)" title="Saint Martin (French part)">Saint Martin (French part)</option>
                            <option value="Saint Pierre and Miquelon" title="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                            <option value="Saint Vincent and the Grenadines" title="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                            <option value="Samoa" title="Samoa">Samoa</option>
                            <option value="San Marino" title="San Marino">San Marino</option>
                            <option value="Sao Tome and Principe" title="Sao Tome and Principe">Sao Tome and Principe</option>
                            <option value="Saudi Arabia" title="Saudi Arabia">Saudi Arabia</option>
                            <option value="Senegal" title="Senegal">Senegal</option>
                            <option value="Serbia" title="Serbia">Serbia</option>
                            <option value="Seychelles" title="Seychelles">Seychelles</option>
                            <option value="Sierra Leone" title="Sierra Leone">Sierra Leone</option>
                            <option value="Singapore" title="Singapore">Singapore</option>
                            <option value="Sint Maarten (Dutch part)" title="Sint Maarten (Dutch part)">Sint Maarten (Dutch part)</option>
                            <option value="Slovakia" title="Slovakia">Slovakia</option>
                            <option value="Slovenia" title="Slovenia">Slovenia</option>
                            <option value="Solomon Islands" title="Solomon Islands">Solomon Islands</option>
                            <option value="Somalia" title="Somalia">Somalia</option>
                            <option value="South Africa" title="South Africa">South Africa</option>
                            <option value="South Georgia and the South Sandwich Islands" title="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
                            <option value="South Sudan" title="South Sudan">South Sudan</option>
                            <option value="Spain" title="Spain">Spain</option>
                            <option value="Sri Lanka" title="Sri Lanka">Sri Lanka</option>
                            <option value="Sudan" title="Sudan">Sudan</option>
                            <option value="Suriname" title="Suriname">Suriname</option>
                            <option value="Svalbard and Jan Mayen" title="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                            <option value="Swaziland" title="Swaziland">Swaziland</option>
                            <option value="Sweden" title="Sweden">Sweden</option>
                            <option value="Switzerland" title="Switzerland">Switzerland</option>
                            <option value="Syrian Arab Republic" title="Syrian Arab Republic">Syrian Arab Republic</option>
                            <option value="Taiwan, Province of China" title="Taiwan, Province of China">Taiwan, Province of China</option>
                            <option value="Tajikistan" title="Tajikistan">Tajikistan</option>
                            <option value="Tanzania, United Republic of" title="Tanzania, United Republic of">Tanzania, United Republic of</option>
                            <option value="Thailand" title="Thailand">Thailand</option>
                            <option value="Timor-Leste" title="Timor-Leste">Timor-Leste</option>
                            <option value="Togo" title="Togo">Togo</option>
                            <option value="Tokelau" title="Tokelau">Tokelau</option>
                            <option value="Tonga" title="Tonga">Tonga</option>
                            <option value="Trinidad and Tobago" title="Trinidad and Tobago">Trinidad and Tobago</option>
                            <option value="Tunisia" title="Tunisia">Tunisia</option>
                            <option value="Turkey" title="Turkey">Turkey</option>
                            <option value="Turkmenistan" title="Turkmenistan">Turkmenistan</option>
                            <option value="Turks and Caicos Islands" title="Turks and Caicos Islands">Turks and Caicos Islands</option>
                            <option value="Tuvalu" title="Tuvalu">Tuvalu</option>
                            <option value="Uganda" title="Uganda">Uganda</option>
                            <option value="Ukraine" title="Ukraine">Ukraine</option>
                            <option value="United Arab Emirates" title="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom" title="United Kingdom">United Kingdom</option>
                            <option value="United States" title="United States">United States</option>
                            <option value="United States Minor Outlying Islands" title="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                            <option value="Uruguay" title="Uruguay">Uruguay</option>
                            <option value="Uzbekistan" title="Uzbekistan">Uzbekistan</option>
                            <option value="Vanuatu" title="Vanuatu">Vanuatu</option>
                            <option value="Venezuela, Bolivarian Republic of" title="Venezuela, Bolivarian Republic of">Venezuela, Bolivarian Republic of</option>
                            <option value="Viet Nam" title="Viet Nam">Viet Nam</option>
                            <option value="Virgin Islands, British" title="Virgin Islands, British">Virgin Islands, British</option>
                            <option value="Virgin Islands, U.S." title="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                            <option value="Wallis and Futuna" title="Wallis and Futuna">Wallis and Futuna</option>
                            <option value="Western Sahara" title="Western Sahara">Western Sahara</option>
                            <option value="Yemen" title="Yemen">Yemen</option>
                            <option value="Zambia" title="Zambia">Zambia</option>
                            <option value="Zimbabwe" title="Zimbabwe">Zimbabwe</option>
                    </select>
                        <label for='rcountry' class='form-error country'></label>
                    </div>
                    <div class='field' id = "dphone">
                        <label for='rphone'>Phone</label>
                        <input name = "rphone" id = "rphone" type="text" size="20" />
                        <label for='rphone' class='form-error phone'></label>
                    </div>
                </div>
				<!-- End Receive Your Reward -->
                
				<!-- 4. Payment Information -->
                <div id ="payment_block" class="s_card_info">
                    <h2><b>4</b>Payment Information</h2> 
                    <div class="secured_info_wrapper">
                        <div class="secured_info">
                            <p>Secure Payment</p><p>Donating to Pledge Sport is safe and secure.<br />Contact <i>info@pledgesport.org</i> if you have any questions.</p> 
                        </div>   
                    </div>    
                    <div class="form-row field" id='dcard_num'>
                        <label for='card_num'>Card Number*</label>
                        <input name='card_num' id='card_num' type="text" size="20" data-stripe="number" />
                        <label for='card_num' class='form-error card_num'></label>
                    </div>
                    <div class="form-row field" id='dcvc'>
                        <label for='cvc'>CVC*</label>
                        <input name='cvc' id='cvc' type="text" size="4" data-stripe="cvc" />
                        <label for='cvc' class='form-error cvc'></label>
                    </div>
                    <div class="form-row field" id='dexp'>
                        <label for='exp'>Expiration (YYYY/MM)*</label>
                        <select class = "half" data-stripe="exp-year">
                            <option value = "2014">2014</option>
                            <option value = "2015">2015</option>
                            <option value = "2016">2016</option>
                            <option value = "2017">2017</option>
                            <option value = "2018">2018</option>
                            <option value = "2019">2019</option>
                            <option value = "2020">2020</option>
                            <option value = "2021">2021</option>
                            <option value = "2022">2022</option>
                        </select>
                        <select class = "half" data-stripe="exp-month">
                            <option value = "01">01</option>
                            <option value = "02">02</option>
                            <option value = "03">03</option>
                            <option value = "04">04</option>
                            <option value = "05">05</option>
                            <option value = "06">06</option>
                            <option value = "07">07</option>
                            <option value = "08">08</option>
                            <option value = "09">09</option>
                            <option value = "10">10</option>
                            <option value = "11">11</option>
                            <option value = "12">12</option>
                        </select>
                        <label for='exp' class='form-error exp'></label>
                    </div>
                </div>
				<!-- End Payment Information -->
				<!-- Submit The Form -->
                <span class="payment-errors"></span>
                <div class='form-submit'>
                    <input type = "submit" id='submit_payment' class='button center'  value = "Submit Payment"/>
                </div>
				<!-- End Submit the Form -->
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
    mysql_query($verifiesIfConfigurationTableExists);

    $verifiesIfItsAlreadyPopulated = "SELECT * FROM " . $prefix . "configuration";
    $verifiesIfItsAlreadyPopulated = mysql_query($verifiesIfItsAlreadyPopulated);
    if (mysql_num_rows($verifiesIfItsAlreadyPopulated) == 0) {
        $insert = "INSERT INTO " . $prefix . "configuration 
                   (test_secret_key, test_publishable_key, live_secret_key, live_publishable_key, donation_page_url, card_info_page_url, thank_you_page_url, test_mode)
                   VALUES
                   ('','','','','','','', 1)";
        mysql_query($insert);
    }

    $verifiesIfAdvancedCustomFieldsTableExists = "CREATE TABLE IF NOT EXISTS `" . $prefix . "fields` (
                                                    `id` int(11) NOT NULL AUTO_INCREMENT,
                                                    `donation_id` int(11) NOT NULL,
                                                    `advanced_custom_field` varchar(50) NOT NULL,
                                                    `value` text NOT NULL,
                                                    PRIMARY KEY (`id`)
                                                    )AUTO_INCREMENT=1 ;";
    mysql_query($verifiesIfAdvancedCustomFieldsTableExists);

    $verifiesIfTheDonationTableExists = "CREATE TABLE IF NOT EXISTS `" . $prefix . "donations` (
                                            `id` int(11) NOT NULL AUTO_INCREMENT,
                                            `reference_id` varchar(50) NOT NULL,
                                            `user_id` int(11) NULL,
                                            `stripe_token` varchar(50) NOT NULL,
                                            `amount` double NOT NULL,
                                            `anonymous` BOOLEAN NULL,
                                            `date` varchar(25) NOT NULL,
                                             PRIMARY KEY (`id`)
                                        )  AUTO_INCREMENT=1 ;";
    mysql_query($verifiesIfTheDonationTableExists);

    $verifiesIfUserTableExists = "CREATE TABLE IF NOT EXISTS `wp_stripe_users` (
                                    `id` int(11) NOT NULL AUTO_INCREMENT,
                                    `wp_users_id` int(11) NOT NULL,
                                    `stripe_users_id` varchar(50) NOT NULL,
                                    PRIMARY KEY (`id`)
                                 ) AUTO_INCREMENT=1 ;";
    mysql_query($verifiesIfUserTableExists);
}

function searchConfigurationInfo() {

    databaseCheck();

    global $wpdb;
    $prefix = $wpdb->prefix . "stripe_";

    $query = "SELECT * FROM " . $prefix . "configuration";
    $queryResult = mysql_query($query);
	
    $result["test_secret_key"] = mysql_result($queryResult, 0, "test_secret_key");
    $result["test_publishable_key"] = mysql_result($queryResult, 0, "test_publishable_key");
    $result["live_secret_key"] = mysql_result($queryResult, 0, "live_secret_key");
    $result["live_publishable_key"] = mysql_result($queryResult, 0, "live_publishable_key");
    $result["donation_page_url"] = mysql_result($queryResult, 0, "donation_page_url");
    $result["card_info_page_url"] = mysql_result($queryResult, 0, "card_info_page_url");
    $result["thank_you_page_url"] = mysql_result($queryResult, 0, "thank_you_page_url");
    $result["test_mode"] = mysql_result($queryResult, 0, "test_mode");
    $result["logged_to_donate"] = mysql_result($queryResult, 0, "logged_to_donate");

    return $result;
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
    $lookingFor = mysql_query($lookingFor);
    $lookingFor = mysql_result($lookingFor, 0, "meta_value");
    $lookingFor = explode("label", $lookingFor);
    $lookingFor = explode("name", $lookingFor[1]);
    $polishing = $lookingFor[0];
    $polishing = substr($polishing, 8, -7);

    return $polishing;
}

function chargeWithCustomer($secret_key, $amountToDonate, $currency, $customer) {
    require_once('plugin/Stripe.php');
    Stripe::setApiKey($secret_key);
    $charging = Stripe_Charge::create(array("amount" => $amountToDonate,
                "currency" => $currency,
                "customer" => $customer,
                "description" => ""));

    return $charging;
}

function chargeWithToken($secret_key, $amountToDonate, $currency, $token) {
    require_once('plugin/Stripe.php');
    Stripe::setApiKey($secret_key);
    $charging = Stripe_Charge::create(array("amount" => $amountToDonate,
                "currency" => $currency,
                "card" => $token,
                "description" => ""));

    return $charging;
}

function createUser($secret_key, $token, $email) {
    require_once('plugin/Stripe.php');
    Stripe::setApiKey($secret_key);

    $creating = Stripe_Customer::create(array("email" => $email,
                "card" => $token));

    return $creating;
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
    $findingProjectsOfThisUser = mysql_query($findingProjectsOfThisUser);
    $control = 0;

    $projects = array();
    while (mysql_num_rows($findingProjectsOfThisUser) > $control) {
        $id = mysql_result($findingProjectsOfThisUser, $control, "ID");

        $retrievingDonations = "SELECT * FROM $donations 
                                INNER JOIN $wp_users ON ($donations.user_id = $wp_users.id)
                                 WHERE  reference_id = '$id'
                                ORDER BY $donations.id DESC";
        $retrievingDonations = mysql_query($retrievingDonations);
        $control2 = 0;
        while (mysql_num_rows($retrievingDonations) > $control2) {
            $donation_id = mysql_result($retrievingDonations, $control2, "id");
            $projects[$donation_id]["project_name"] = mysql_result($findingProjectsOfThisUser, $control, "post_title");
            $anonymous = mysql_result($retrievingDonations, $control2, "anonymous");
            if ($anonymous) {
                $projects[$donation_id]["user_name"] = "Anonymous";
                $projects[$donation_id]["user_email"] = "Anonymous";
            } else {
                $projects[$donation_id]["user_name"] = mysql_result($retrievingDonations, $control2, "display_name");
                $projects[$donation_id]["user_email"] = mysql_result($retrievingDonations, $control2, "user_email");
            }
            $projects[$donation_id]["amount"] = mysql_result($retrievingDonations, $control2, "amount");
            $projects[$donation_id]["date"] = mysql_result($retrievingDonations, $control2, "date");
            
            $collectingAddressFields = "SELECT * FROM $fields 
                                        WHERE 
                                        (advanced_custom_field = 'Address line 1' 
                                        OR advanced_custom_field = 'Address line 2' 
                                        OR advanced_custom_field = 'Post Code' 
                                        OR advanced_custom_field = 'Country')
                                        AND donation_id = '$donation_id'";
            $collectingAddressFields = mysql_query($collectingAddressFields);
            $control3=0;
            
            while(mysql_num_rows($collectingAddressFields) > $control3){
                $field = mysql_result($collectingAddressFields, $control3, "advanced_custom_field");
                $projects[$donation_id]["fields"][$field] = mysql_result($collectingAddressFields, $control3, "value");
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
                                 WHERE  reference_id = '$project_id'
                                ORDER BY $donations.id DESC";
    $retrievingDonations = mysql_query($retrievingDonations);
    $control2 = 0;
    while (mysql_num_rows($retrievingDonations) > $control2) {
        $donation_id = mysql_result($retrievingDonations, $control2, "id");
        $projects[$donation_id]["project_name"] = mysql_result($findingProjectsOfThisUser, $control, "post_title");
        $anonymous = mysql_result($retrievingDonations, $control2, "anonymous");
        if ($anonymous) {
            $projects[$donation_id]["user_name"] = "Anonymous";
            $projects[$donation_id]["user_email"] = "Anonymous";
        } else {
            $projects[$donation_id]["user_name"] = mysql_result($retrievingDonations, $control2, "display_name");
            $projects[$donation_id]["user_email"] = mysql_result($retrievingDonations, $control2, "user_email");
        }
        $projects[$donation_id]["amount"] = mysql_result($retrievingDonations, $control2, "amount");
        $projects[$donation_id]["date"] = mysql_result($retrievingDonations, $control2, "date");
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
    mysql_query($savesData);
}

function getStripeCurrencyCode($currency){
   
    if (strtolower($currency) == "euro"){
        return "eur";
    }
    if (strtolower($currency) == "uk sterling"){
        return "gbp";
    }
    if (strtolower($currency) == "us dollar"){
        return "usd";
    }
}