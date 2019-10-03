<?php
/**
 * ERROR PAGE
 *
 * @package WordPress
 * @subpackage IPU
 * @since Twenty Fourteen 1.0
 */

session_start();

// CHECK IF USER IS LOGGED IN
// IF USER IS LOGGED IN
// SET SESSION VARIABLE TO BE ACCESSED
// REDIRECT TO REQUESTED PAGE
if(!empty($_REQUEST["_s2member_vars"]))
    @list($restriction_type, $requirement_type, $requirement_type_value, $seeking_type, $seeking_type_value, $seeking_uri)
        = explode("..", stripslashes((string)$_REQUEST["_s2member_vars"]));

if (!empty($seeking_uri)) {
    $URI = base64_decode($seeking_uri);
}

// If we have a link to redirect to after login, use it, otherwise use the default login URL
if(!empty($URI)) {
	$checkedBefore = isset($_SESSION[$URI]) ? $_SESSION[$URI] : false;

    if(!$checkedBefore && is_page_permitted_by_s2member($seeking_type_value, true)) {
    	$_SESSION[$URI] = true;
		wp_redirect($URI);exit;
    }
}

get_header();
?>

<article id="content_wrapper" class="cw_blocked">

		<div class="content eight_column thanks_wrapper">
            <section class="payment_wrapper content_same_height" style="height: 386px;">
				<div class="thx_content">

					<p style="text-align:center;">This page is for contract members of the IPU.</p>
					<p style="text-align:center;"> Already a member? Please login to view the content.</p>

				</div>

                <div class="thx_action thx_action_last">
                    <a class="btn btn_action_go" href="<?php echo ( !empty($URI) ? wp_login_url( esc_url($URI) ) : wp_login_url() ); ?>">Existing Member Login</a>
                </div>

				<div class="thx_action thx_action_last">
					<a class="btn btn_action_go" href="<?= home_url();?>">Go to the homepage</a>
                </div>
			</section>
		</div>
	</article>
<div class="thanks_dummy_wrapper">
		<span class="thanks_dummy"></span>
	</div>

<div class="g_thanks_wrapper">
		<section class="grid_post grid_sort g_thanks">
		</section>
		</div>
<?php
get_footer();
