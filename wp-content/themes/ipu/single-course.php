<?php
/**
 * The template for displaying single course
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
get_header();

$current_user = wp_get_current_user();
$url = get_field('avatar', 'user_'.$current_user->ID);
$profile_img = $url['url'];
$bio = get_field('bio', 'user_'.$current_user->ID);
$post_id = get_the_ID();


//update
$fields = get_fields($post_id);

$cfg = searchConfigurationInfo();
$title = $fields["title"];
$subtitle = $fields["subtitle"];
$course_duration = $fields["course_duration"];
$description = $fields["description"];
$non_member_price = $fields["non_member_price"];
$member_price = $fields["members_price"];
$enable_order_now = $fields['enable_order_now'];
$register_interest = $fields['register_interest'];
$application_form  = wp_get_attachment_url(get_post_meta(get_the_ID(), 'application_form', true));
$document1 = wp_get_attachment_url(get_post_meta(get_the_ID(),'document1',true));
$document2 = wp_get_attachment_url(get_post_meta(get_the_ID(),'document2',true));


?>

	<script src="https://www.google.com/recaptcha/api.js?render=6Ld0LZwUAAAAALo0aSgPJ3KrTXGpaB662gMxxQkV"></script>
    <script>
        grecaptcha.ready(function () {
            grecaptcha.execute('6Ld0LZwUAAAAALo0aSgPJ3KrTXGpaB662gMxxQkV', { action: 'contact' }).then(function (token) {
                var recaptchaResponse = document.getElementById('recaptchaResponse');
                recaptchaResponse.value = token;
            });
        });
    </script>

    <style>
        .a-resources {width: 100%; margin-bottom: 20px;}
        .a-resources li {border: solid 1px #ccc; padding: 10px; width: 25%; display: inline; float: left; margin-right: 10px}

        .left{
            position: absolute;
            left: 0px;
            width: 240px;
            color: white;
            z-index: 1000;
        }
        .last-entry li{background-color: #222;
            border: solid 1px;
            margin-right: 20px;}
    </style>
    <article id="content_wrapper">
        <aside class="sidebar two_column sb_single_course">
			<?php
			/*******************************
			 *			Left Col
			 *******************************/
			?>
            <div class="sb_txt">
				<?php while (have_posts()): the_post(); ?>

                    <div class="data_time"><?= $course_duration; ?></div>
                    <div class="data_price">
						<?php if($member_price != '' && $member_price != 0) { ?>
                            <div class="data_price_single">€<?=$member_price; ?> for IPU Members</div>
						<?php } ?>
						<?php if($non_member_price != '' && $non_member_price != 0) { ?>

                            <div class="data_price_single">€<?=$non_member_price; ?> for non members</div>
						<?php } ?>

                    </div>

				<?php endwhile; ?>

            </div>
            <div class="sb_txt">
				<?php
				$junction = '?';
				if(strpos($cfg["card_info_page_url"], '?') !== false) {
					$junction = '&';
				}
				?>
				<?php if($application_form) { ?>
                    <a class="btn btn_si_download" target="_blank" href="<?= $application_form; ?>" title="Download Application">Download Application</a>
				<?php } ?>
				<?php if($document1) { ?>
                    <a class="btn btn_si_download" target="_blank" href="<?= $document1; ?>" title="Download Documents">Download Document</a>
				<?php } ?>
				<?php if($document2) { ?>
                    <a class="btn btn_si_download" target="_blank" href="<?= $document2; ?>" title="Download Documents">Download Document</a>
				<?php } ?>
				<?php if($enable_order_now) { ?>
                    <a class="btn btn_action_order" href="<?php echo $cfg["card_info_page_url"].$junction.'item='.get_the_ID() ?>">Order now</a>
				<?php } ?>			<!-- Register interest -->
				<?php if (is_user_logged_in()) { ?>
                    <!-- logged in  -->
                    <form action="/wp-content/themes/ipu/register-interest.php" class="register-interest--form" method="post">

                        <input type="hidden" name="name" value="<?= $current_user->display_name; ?>">
                        <input type="hidden" name="email" value="<?= $current_user->user_email; ?>">
                        <input type="hidden" name="courseId" value="<?= get_the_ID(); ?>">
						<input type="hidden" name="recaptcha_response" id="recaptchaResponse">
						<?php if($register_interest == 'yes') { ?>
                            <input type="submit" value="Register your interest" class="btn btn_action_register">
						<?php } ?>

                    </form>

				<?php } else { ?>
                    <!-- not logged in, modal to get email and name -->
					<?php if($register_interest == 'yes') { ?>
                        <a class="btn btn_action_register guest_register" target="_blank" href="#">Register your interest</a>
					<?php } ?>

				<?php } ?>
                <!-- /Register interest -->

				<?php if($register_interest == 'yes') { ?>
                    <div class="register-interest--guest">

                        <div class="register-interest--guest-title">
                            <p>Register your interest</p>
                            <span class="btn btn_action_close">Close</span>
                        </div>

                        <form action="/wp-content/themes/ipu/register-interest.php" class="register-interest--form" method="post">

                            <input type="text" name="name" placeholder="Enter Name">
                            <input type="email" name="email" placeholder="Enter Email">

                            <input type="hidden" name="courseId" value="<?= get_the_ID(); ?>">
							<input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                            <input type="submit" value="Submit" class="btn">

                        </form>

                    </div>
				<?php } ?>
            </div>
        </aside>
        <div class="content si_content si_content_guideline si_content_guideline si_content_course eight_column">

            <section class="si_txt content_same_height <?php echo have_rows('related_documents')?"":"si_txt_maximize" ?>">
                <div class="si_section_title">
                    <h3><?= $post_type; ?></h3>
					<?php if (have_rows('related_documents')) { ?>
                        <div class="btn btn_action_maxmin btn_action_max" id="si_maximize">Maximize</div>
					<?php  } ?>
                </div>
                <div class="si_section_content">
                    <div class="si_purpose">
                        <div id="primary" class="content-area">
                            <div id="content" class="site-content" role="main">
                                <h3><?= $subtitle; ?></h3>
                                <h2><?= $title; ?> </h2>

                            </div><!-- #content -->
                        </div><!-- #primary -->
						<?php
						wp_reset_query();
						wp_reset_postdata();
						?>
                    </div>
                    <div class="si_descr">
						<?= $description; ?>

                    </div>

                </div>
            </section>


			<?php if (have_rows('related_documents')) { ?>
                <section class="grid_post content_same_height" style="display: block !important;">
                    <div class="g_section_title">
                        <h3>Associated resources</h3>
                        <div class="btn btn_action_maxmin btn_action_max" id="g_maximize">Maximize</div>
                    </div>

                    <div class="grid_wrapper">
						<?php
						while (have_rows('related_documents')) : the_row();
							$priority = get_sub_field('documents');
							$year = get_the_date("Y");
							$month = get_the_date("M");
							$day = get_the_date('d');
							$dateR = get_the_date('d m y');
							?>
							<?php if ($priority): ?>
								<?php include 'common/associaded_resources.php'; ?>
							<?php endif; ?>
						<?php endwhile; ?>
						<?php
						wp_reset_query();
						wp_reset_postdata();
						?>
                    </div>
                </section>
			<?php } ?>





        </div>
    </article>
<?php
get_footer();
