<!-- get POST details from form
     get course details
     email user saying register has been done
     register system user saying user has registered for --name-- of course
     return to previous page
 -->
 <?php

    require_once('./../../../wp-blog-header.php');

    if (valid_data()) {

        // email to settings
        $toEmail = $_POST['email'];
        $toName = $_POST['name'];

        $fromEmail = 'info@ipu.ie';

        $courseId = $_POST['courseId'];
        // course user is interested in
        $course = get_post($courseId);
        $emailList = get_post_custom($courseId);
        $length = (int)$course->interest_email_queue;


        // subject title for emails
        $emailSubject = 'Interest in '.$course->post_title;

        // mail to user
        $emailString = 'Thank you '.$toName.' for your interest in '.$course->post_title;
        $headers = 'From: Irish Pharmacy Union <'.$fromEmail.'>' . "\r\n";
        wp_mail($toEmail, $emailSubject, $emailString, $headers);

        // var_dump($length);exit;
         for($i = 0; $i < $length; $i++) {
             $emailAddress = $emailList['interest_email_queue_' . $i . '_interest_notification_email'];

             // mail to admin
             $emailString = $toName.' is interested in '.$course->post_title.'. Their email is: '.$toEmail;
             $headers = 'From: IPU Website <no-reply@ipue.ie>' . "\r\n"; // change to what the client wants to recieve emails as
             wp_mail($emailAddress[0], $emailSubject, $emailString, $headers);
             // wp_mail($fromEmail, $emailSubject, $emailString, $headers);

             $_SESSION['register_interest_referrer'] = $_SERVER['HTTP_REFERER'];
             $_SESSION['register_interest_title'] = $course->post_title;
             $_SESSION['register_interest_name'] = $toName;

         }

        wp_redirect( '/?page_id=4211' ); exit;
    }

    wp_redirect( $_SERVER['HTTP_REFERER'] ); exit;

    // quick validation of $_POST data
    function valid_data () {
        $props = array('email', 'name', 'courseId');

        foreach($props as $prop) {

            if (!isset($_POST[$prop]) || empty($_POST[$prop])) {
                return false;
            }
        }
        
		// Build POST request:
		$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
		$recaptcha_secret = '6Ld0LZwUAAAAAGoj9M0YO-Zujvzy-DvkylWHMco5';
		$recaptcha_response = $_POST['recaptcha_response'];

		// Make and decode POST request:
		$recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
		$recaptcha = json_decode($recaptcha);
		
		if ($recaptcha->score >= 0.5) {
			return true;
		} 
		//else {
		//	// Not verified - show form error
		//}
        return false;
    }

 ?>
