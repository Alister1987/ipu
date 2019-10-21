<?php
/**
Template Name: My Account
 *
 * @package WordPress
 * @subpackage IPU
 * @since Twenty Fourteen 1.0
 */

/* Get user info. */
global $current_user, $wp_roles;
//get_currentuserinfo(); //deprecated since 3.1

/* Load the registration file. */
//require_once( ABSPATH . WPINC . '/registration.php' ); //deprecated since 3.1
/* If profile was saved, update profile. */
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['first_name'] ) ) {
    /* @var $errors type */
    $errors = array();    
    /* Update user information. */
    if ( !empty( $_POST['url'] ) ) {
        wp_update_user( array( 'ID' => $current_user->ID, 'user_url' => esc_url( $_POST['url'] ) ) );
    }
    if ( !empty( $_POST['googleplus'] ) ) {
        update_user_meta( $current_user->ID, 'googleplus', esc_attr( $_POST['googleplus'] ) );
    }
    if ( !empty( $_POST['facebook'] ) ) {
        update_user_meta( $current_user->ID, 'facebook', esc_attr( $_POST['facebook'] ) );
    }
    if ( !empty( $_POST['twitter'] ) ) {
        update_user_meta( $current_user->ID, 'twitter', esc_attr( $_POST['twitter'] ) );
    }
    if ( !empty( $_POST['display_name'] ) ) {
        //update_user_meta( $current_user->ID, 'display_name', esc_attr( $_POST['display_name'] ) );
	wp_update_user( array( 'ID' => $current_user->ID, 'display_name' => esc_attr( $_POST['display_name'] ) ) );
    }
    if ( !empty( $_POST['nickname'] ) ) {
        update_user_meta( $current_user->ID, 'nickname', esc_attr( $_POST['nickname'] ) );
    }   
    if ( !empty( $_POST['first_name'] ) ) {
        update_user_meta( $current_user->ID, 'first_name', esc_attr( $_POST['first_name'] ) );
    }
    if ( !empty( $_POST['last_name'] ) ) {
        update_user_meta($current_user->ID, 'last_name', esc_attr( $_POST['last_name'] ) );
    }
    if ( !empty( $_POST['description'] ) ) {
        update_user_meta($current_user->ID, 'description', esc_attr( $_POST['description'] ) );
    }
    /* Update custom profile photo */
    update_user_meta( $current_user->ID, 'cupp_meta', $_POST['cupp_meta'] );
    update_user_meta( $current_user->ID, 'cupp_upload_meta', $_POST['cupp_upload_meta'] );
    update_user_meta( $current_user->ID, 'cupp_upload_edit_meta', $_POST['cupp_upload_edit_meta'] );
    
    /* Update user password */
    $pass1 = $pass2 = '';
    if ( isset( $_POST['pass1'] ) )
	    $pass1 = $_POST['pass1'];
    if ( isset( $_POST['pass2'] ) )
	    $pass2 = $_POST['pass2'];
    
    do_action_ref_array( 'check_passwords', array( $user->user_login, &$pass1, &$pass2 ) );
    
    if ( empty($pass1) && !empty($pass2) )
	    $errors->add( 'pass', __( '<strong>ERROR</strong>: You entered your new password only once.' ), array( 'form-field' => 'pass1' ) );
    elseif ( !empty($pass1) && empty($pass2) )
	    $errors->add( 'pass', __( '<strong>ERROR</strong>: You entered your new password only once.' ), array( 'form-field' => 'pass2' ) );

	    /* Check for "\" in password */
    if ( false !== strpos( wp_unslash( $pass1 ), "\\" ) )
	    $errors->add( 'pass', __( '<strong>ERROR</strong>: Passwords may not contain the character "\\".' ), array( 'form-field' => 'pass1' ) );

    /* checking the password has been typed twice the same */
    if ( !empty( $pass1 ) && $pass1 != $pass2 )
	    $errors->add( 'pass', __( '<strong>ERROR</strong>: Please enter the same password in the two password fields.' ), array( 'form-field' => 'pass1' ) );

    if ( count($errors) == 0 && !empty( $_POST['pass1'] ) )
        wp_update_user( array( 'ID' => $current_user->ID, 'user_pass' => esc_attr( $_POST['pass1'] ) ) );
}

$user_ID = get_current_user_id();
$current_user = get_userdata( $user_ID );

    
wp_enqueue_media();

get_header();
?>
<article id="content_wrapper" class="page-<?=$id;?>">
	<aside class="sidebar two_column">
	    	<div class="sb_txt">
			<h3><?php echo esc_attr($current_user->user_login) ?></h3>
			<h4><?php echo esc_attr($current_user->user_email) ?></h4>
		</div>	    	
	</aside>

	<div class="content lp_content eight_column">
		<section class="content lp_content lp_event content_commitee">
			<div class="si_section_content">
				<section class="furst">
					<div class="box_wrapper box_huge box_two_column">
						<div class="box_inside">
							   <?php if ($errors && count($errors)) {
								     if ( isset( $errors ) && is_wp_error( $errors ) ) : ?>
							    <div class="error"><p><?php echo implode( "</p>\n<p>", $errors->get_error_messages() ); ?></p></div>
							    <?php endif;
							   } ?>
							<h3>Edit Account Information</h3>
							<div class="box_content">
								<form id="your-profile" action="<?php echo get_permalink(); ?>" method="post" novalidate="novalidate" <?php do_action( 'user_edit_form_tag' ); ?>>
									
									
									<p>
									        <input type="hidden" name="from" value="profile" />
										<input type="hidden" name="checkuser_id" value="<?php echo get_current_user_id(); ?>" />
									</p>
									<div class="w_title">
									        <h2>Personal Information</h2>
									    <p></p>
									</div>
									<div>
									    <div class="field">
										<p><?php _e('First Name') ?><br>
										<span class="wpcf7-form-control-wrap">
											<input size="40" type="text" name="first_name" id="first_name" value="<?php echo esc_attr($current_user->first_name) ?>"></span> </p>
										<p></p>
									    </div>
									    <div class="field">
										<p><?php _e('Last Name') ?><br>
										<span class="wpcf7-form-control-wrap">
											<input size="40" type="text" name="last_name" id="last_name" value="<?php echo esc_attr($current_user->last_name) ?>"></span> </p>
										<p></p>
									    </div>
									    <div class="field">
										<p><?php _e('Nickname') ?> <?php _e('(required)'); ?><br>
										<span class="wpcf7-form-control-wrap">
											<input size="40" type="text" name="nickname" id="nickname" value="<?php echo esc_attr($current_user->nickname) ?>"></span> </p>
										<p></p>
									    </div>
									    <div class="field">
										<p><?php _e('Display name publicly as') ?><br>
										<span class="wpcf7-form-control-wrap">
											<select class="form-select"  name="display_name" id="display_name">
												<?php
													$public_display = array();
													$public_display['display_nickname']  = $current_user->nickname;
													$public_display['display_username']  = $current_user->user_login;
													$public_display['display_image']  = $current_user->user_image;

													if ( !empty($current_user->first_name) )
														$public_display['display_firstname'] = $current_user->first_name;

													if ( !empty($current_user->last_name) )
														$public_display['display_lastname'] = $current_user->last_name;

													if ( !empty($current_user->first_name) && !empty($current_user->last_name) ) {
														$public_display['display_firstlast'] = $current_user->first_name . ' ' . $current_user->last_name;
														$public_display['display_lastfirst'] = $current_user->last_name . ' ' . $current_user->first_name;
													}

													if ( !in_array( $current_user->display_name, $public_display ) ) // Only add this if it isn't duplicated elsewhere
														$public_display = array( 'display_displayname' => $current_user->display_name ) + $public_display;

													$public_display = array_map( 'trim', $public_display );
													$public_display = array_unique( $public_display );

													foreach ( $public_display as $id => $item ) {
												?>
													<option <?php selected( $current_user->display_name, $item ); ?>><?php echo $item; ?></option>
												<?php
													}
												?>
											</select>
										</span>
										</p>
										<p></p>
									    </div>
									</div>	
									
									
									<br>
									<div class="w_title">
									        <h2>Contact Information</h2>
									    <p></p>
									</div>
									
									<div>
									    <div class="field">
										<p><?php _e('Website') ?><br>
										<span class="wpcf7-form-control-wrap">
											<input size="40" type="text" name="url" id="url" value="<?php echo esc_attr($current_user->user_url) ?>"></span> </p>
										<p></p>
									    </div>	
										<div class="field">
										<p><?php _e('Google+') ?><br>
										<span class="wpcf7-form-control-wrap">
											<input size="40" type="text" name="googleplus" id="googleplus" value="<?php echo esc_attr($current_user->googleplus) ?>"></span> </p>
										<p></p>
									    </div>	
										<div class="field">
										<p><?php _e('Twitter username (without @)') ?><br>
										<span class="wpcf7-form-control-wrap">
											<input size="40" type="text" name="facebook" id="facebook" value="<?php echo esc_attr($current_user->facebook) ?>"></span> </p>
										<p></p>
									    </div>	
										<div class="field">
										<p><?php _e('Facebook profile URL') ?><br>
										<span class="wpcf7-form-control-wrap">
											<input size="40" type="text" name="twitter" id="twitter" value="<?php echo esc_attr($current_user->twitter) ?>"></span> </p>
										<p></p>
									    </div>	
									    <?php
											foreach ( wp_get_user_contact_methods( $current_user ) as $name => $desc ) {
										?>
										<div class="field">
										    <p><?php echo apply_filters( "user_{$name}_label", $desc ); ?><br>
										    <span class="wpcf7-form-control-wrap">
											    <input size="40" type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo esc_attr($current_user->$name) ?>"></span> </p>
										    <p></p>
										</div>
										<?php
										
											}
										?>
									</div>
									<br>

									<div class="w_title">
									        <h2>About Yourself</h2>
									    <p></p>
									</div>
									
									<div>
									    <div class="field">
										<p><?php _e('Biographical Info') ?><br>
										<p><?php _e('Share a little biographical information to fill out your profile. This may be shown publicly.'); ?></p>
										<span class="wpcf7-form-control-wrap">
											<textarea name="description" id="description" rows="5" cols="40"><?php echo $current_user->description; // textarea_escaped ?></textarea></span> </p>
										<p></p>
									    </div>
									</div>
									<br>

									<div class="w_title">
									        <h2>Change Password</h2>
									    <p></p>
									</div>
									
									<div>
									    <div class="field">
										<p><?php _e('New Password') ?><br>
										<p><?php _e( 'If you would like to change the password type a new one. Otherwise leave this blank.' ); ?></p>
										<span class="wpcf7-form-control-wrap">
											<input size="40" class="form-password" type="password" name="pass1" id="pass1" value="" autocomplete="off" />
										<p></p>
									    </div>
									    <div class="field">
										<p><?php _e('Repeat New Password') ?><br>
										<p><?php _e( 'Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers, and symbols like ! " ? $ % ^ &amp; ).' ); ?></p>
										<span class="wpcf7-form-control-wrap">
											<input size="40" class="form-password" type="password" name="pass2" id="pass2" value="" autocomplete="off" />											
										<p></p>
									    </div>
									</div>
									<br>
									<div class="w_title">
									        <h2>Change Profile Photo</h2>
									    <p></p>
									</div>
									
									<div>
									    <div class="field">
										<p><?php _e('Current Profile Photo') ?><br>
										<?php
										$cupp_url = get_the_author_meta( 'cupp_meta', $current_user->ID );
										$cupp_upload_url = get_the_author_meta( 'cupp_upload_meta', $current_user->ID );
										$cupp_upload_edit_url = get_the_author_meta( 'cupp_upload_edit_meta', $current_user->ID );
										    ?>
										    <div id="current_img">
											    <?php if($cupp_upload_url): ?>
												<img src="<?php echo esc_url( $cupp_upload_url ); ?>" class="cupp-current-img" style="max-width: 191px; max-height: 191px;">

											    <?php elseif($cupp_url) : ?>
												<img src="<?php echo esc_url( $cupp_url ); ?>" class="cupp-current-img" style="max-width: 191px; max-height: 191px;">

											    <?php else : ?>
												<img src="<?php echo plugins_url( 'custom-user-profile-photo/img/placeholder.gif' ); ?>" class="cupp-current-img placeholder" style="max-width: 191px; max-height: 191px;">
											    <?php endif; ?>
										    </div>
										<p><?php _e( 'If you would like to change the profile photo select the upload button below.' ); ?></p>										
										<input id="upload_button" class="btn" name="upload_button" type="button" value="Upload" />	
		    
										<input id="cupp_meta" class="cupp_meta" name="cupp_meta" type="hidden" value="<?php echo $cupp_url; ?>" />	
										<input id="cupp_upload_meta" class="cupp_upload_meta" name="cupp_upload_meta" type="hidden" value="<?php echo esc_url_raw( $cupp_upload_url ); ?>" />	
										<input id="cupp_upload_edit_meta" class="cupp_upload_edit_meta" name="cupp_upload_edit_meta" type="hidden" value="<?php echo esc_url_raw( $cupp_upload_edit_url ); ?>" />
										
									    </div>
									</div>
									<br>
									<hr>
									<br>
									<p class="submit"><input type="submit" name="submit" id="submit" class="btn btn_action_register" value="Update Profile"></p>
								</form>
							</div>
						</div>
					</div>
				</section>
			</div>
		</section>
	</div>
</article>

<script>
jQuery(document).ready(function($){
	var media_uploader = null;

	function open_media_uploader_video()
	{
	    if (media_uploader) {
		media_uploader.open();
	    } else {
		media_uploader = wp.media({
		    title: 'Select image',
		    multiple: false,
		    library: {
		       type: 'image'
		    },
		    button: {
		       text: 'Use selected image'
		    }
		});

		media_uploader.on("select", function(){
		    // Get media attachment details from the frame state
		    var attachment = media_uploader.state().get('selection').first().toJSON();
		    // Send the attachment URL to our custom image input field.
		    $('#current_img img').attr('src', attachment.url);

		    $('#cupp_meta').val('');
		    $('#cupp_upload_meta').val(attachment.url);
		    $('#cupp_upload_edit_meta').val('/wp-admin/post.php?post='+attachment.id+'&action=edit&image-editor');
      
		});

		media_uploader.open();
	    }
	}
	
	$('#upload_button').click(open_media_uploader_video);
});
</script>


<?php
get_footer();


