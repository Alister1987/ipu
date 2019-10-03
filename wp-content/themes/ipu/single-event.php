<?php
/**
 * The template for displaying all pages
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
?>
<?php
$post_type = get_post_type();
$event = get_post();


// checking if prices are setup
$memberPriceField = 'price_member';
$nonMemberPriceField = 'price_non_member';

if($event->post_type == 'course') {
    $memberPriceField = 'members_price';
    $nonMemberPriceField = 'non_member_price';
}

$mPrice = $event->{$memberPriceField};
$nmPrice = $event->{$nonMemberPriceField};
$enable_order_now = $event->enable_order_now;
$register_interest = $fields['register_interest'];
$application_form  = wp_get_attachment_url(get_post_meta(get_the_ID(), 'application_form', true));
$venue = get_field('venue');

$download_button_text = get_field("download_button_text");
if(!$download_button_text)
	$download_button_text = "Download Application Form";

$eventLists = get_field("events_and_courses_list");

?>

<article id="content_wrapper">
<?php
/**
 * Left column
 * */
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

	<aside class="sidebar sb_single_item sb_single_article sb_single_event two_column">
		<?php
		while (have_posts()) : the_post();
			$fields = get_fields();

			$title = $fields["title"];
            $shortDesc = $fields["short_description"];
			$author_id = get_the_author_meta('ID');


			$image_id = get_post_thumbnail_id();
			$image_url = wp_get_attachment_image_src($image_id, 'large', true);
			$avatar = wp_get_attachment_image_src(get_field('image'), 'large');
			$author = $fields["author"];
			$author_role = get_field('author_role');

			$evDate = get_field('date');
			$year = date( 'Y', strtotime( $evDate ) );
			$month = date( 'M', strtotime( $evDate ) );
			$day = date( 'd', strtotime( $evDate ) );
			$time = date( 'H:i', strtotime( $evDate ) );

			$dates = false;
			if(is_array($eventLists) && count($eventLists) > 1){
				$dates = array_column($eventLists,"date");
				$min_date = min(array_map("strtotime",$dates));
				$max_date = max(array_map("strtotime",$dates));
				$min_day = date( 'd',  $min_date  );
				$min_year = date( 'Y',  $min_date  );
				$min_month = date( 'M',  $min_date  );
				$max_day = date( 'd', $max_date  );
				$max_month = date( 'M',  $max_date );
				$max_year = date( 'Y',  $max_date );

			}
			?>

			<?php if($dates) {?>
                <div class="se_date">
                    <span class="se_date_day" style="font-size: 18px"><?=$min_day;?>  <?=$min_month;?>  <?=$min_year;?> / <?=$max_day;?>  <?=$max_month;?>  <?=$max_year;?></span>
                </div>
			<?php }else{ ?>
                <div class="se_date">
                    <span class="se_date_day"><?=$day;?>  <?=$month;?>  <?=$year;?></span>
                    <span class="se_date_hour"><?=$time;?></span>
                </div>
			<?php } ?>



			<div class="se_date">
				<span class="se_date_hour">Member Price: <?php echo $mPrice; ?></span>
				<span class="se_date_hour">Non Member Price: <?php echo $nmPrice; ?></span>
			</div>

            <div class="se_info">
                <a class="btn btn_action_dowload_blue" target="_blank" href="<?php echo $application_form; ?>"><?php echo $download_button_text ?></a>
            </div>


			<div class="se_info">
				<h3><?php echo $title ?></h3>
				<?php
				//contact details
				if (have_rows('contact')):
					while (have_rows('contact')) : the_row();

						$address = get_sub_field('address');
						$email = get_sub_field('email');
						$phone = get_sub_field('phone_number');
						$website = get_sub_field('website');
						?>

						<span class="se_info_address">
							Venue: <?= $venue ?>
						</span>
						<span class="se_info_contact">
							<a href="mailto:<?= $email; ?>"><?= $email; ?></a>
							<a href="tel://<?= $phone; ?>"><?= $phone; ?></a>
							<a href="href://<?= $website; ?>"><?= $website; ?></a>
						</span>
                        <?php if($enable_order_now) { ?>
                        	<?php if($register_interest == 'yes') { ?>
<!-- 						<div class="btn btn_action_register">Register my interest</div>
 -->						<a data-scroll id="eventOrder" href="#id_payment" class="btn btn_action_order">Order now</a>
 							<?php } ?>
                        <?php } ?>

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
=                                <?php if($register_interest == 'yes') { ?>
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

					<?php endwhile; ?>
				<?php endif; ?>
			</div>
		<?php endwhile; ?>

		<?php
		wp_reset_query();
		wp_reset_postdata();
		?>
	</aside>
	<div class="content si_content se_content eight_column">
		<section class="si_txt content_same_height">
			<div class="si_section_title">
				<h3><?= $post_type; ?></h3>
				<p>&nbsp</p>
				<div class="btn btn_action_maxmin btn_action_max" id="si_maximize">Maximize</div>
			</div>


			<?php if(!empty($avatar[0])){?>
			<div class="se_section_img" style="background: url('<?= $avatar[0]; ?>');"></div>
			<?php }else{ ?>

			<?php } ?>


			<div class="si_section_content">
				<div class="si_purpose">
					<?php
					while (have_posts()) : the_post();
						$fields = get_fields();

						$title = $fields["title"];
						$shortDesc = $fields["short_description"];
						$desc = $fields["description"];

						$image_id = get_post_thumbnail_id();
						$image_url = wp_get_attachment_image_src($image_id, 'large', true);
						$inline_image = wp_get_attachment_image_src(get_field('picture'), 'medium');
						?>

						<div id="primary" class="content-area">
							<div id="content" class="site-content" role="main">

								<?php if($inline_image){?>
								<p><img src="<?= $inline_image[0]; ?>" alt="<?php the_title(); ?>" /></p>
								<?php } ?>

								<?php the_content();?>
							</div><!-- #content -->
						</div><!-- #primary -->
					<?php endwhile; ?>
					<?php
					wp_reset_query();
					wp_reset_postdata();
					?>
				</div>



			</div>
		</section>

		<section class="grid_post content_same_height" style="display: block !important;">
			<div class="g_section_title">
				<h3>Associated resources</h3>
				<p>&nbsp</p>
				<div class="btn btn_action_maxmin btn_action_max" id="g_maximize">Maximize</div>
			</div>

			<div class="grid_wrapper">
				<?php
				if (have_rows('related_documents')):
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
				<?php endif; ?>
				<?php
					wp_reset_query();
					wp_reset_postdata();
				?>
			</div>
		</section>


        <?php if($enable_order_now && ($mPrice != '' || $nmPrice != '')) { ?>
		<section class="si_payment" id="id_payment">

				<div class="sip_steps">
					<div class="sip_step_wrapper active_step">
						<div class="sip_step_inside step_1">
							<span class="sip_step">1</span>
							<p>Choose Tickets</p>
						</div>
					</div>
					<div class="sip_step_wrapper">
						<div class="sip_step_inside step_2">
							<span class="sip_step">2</span>
							<p>Payment</p>
						</div>
					</div>
					<div class="sip_step_wrapper">
						<div class="sip_step_inside step_3">
							<span class="sip_step">3</span>
							<p>Complete</p>
						</div>
					</div>
				</div>

				<div class="sip_price">
                    <?php
                        $stripeCfg = searchConfigurationInfo();
                        $stripeCardPage = $stripeCfg["card_info_page_url"];
                        $stripeCardPageId = 0;

                        if(strpos($stripeCardPage, "?page_id=") !== false) {
                            $stripeCardPage = str_replace('/?page_id=', '', $stripeCardPage);
                            $stripeCardPage = str_replace('?page_id=', '', $stripeCardPage);
                            $stripeCardPageId = $stripeCardPage;
                            $stripeCardPage = '/';
                        }

                    ?>
                    <form action='<?= $stripeCardPage ?>' method='get'>
                        <input type='hidden' value='<?= $event->ID ?>' name='item' />
                        <?php if($stripeCardPageId != 0) { ?>
                            <input type='hidden' value='<?= $stripeCardPageId ?>' name='page_id' />
                        <?php } ?>
                        <div class="sip_tickets_wrapper">
                            <?php if($mPrice != '') { ?>
                            <div class="sip_tickets">
                                <div class="sip_prefix"><?= $mPrice ?>€</div>
                                <div class="sip_title">Member price</div>
                                <div class="sip_postfix">
                                    <select id="m_qty" name="m_qty">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if($nmPrice != '') { ?>
                            <div class="sip_tickets">
                                <div class="sip_prefix"><?= $nmPrice ?>€</div>
                                <div class="sip_title">Non-Member price</div>
                                <div class="sip_postfix">
                                    <select id="nm_qty" name="nm_qty">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="sip_total">
                            <div class="total_label">Total (<label id='total_tickets'>0</label> tickets)</div>
                            <div class="total_number"><label id="total_price">0.00</label>€</div>
                            <input id='btn-submit-payment' type='submit' class="btn btn_action_order" value="Check out" style='text-align: left'></input>
                        </div>
                        <div class="sip_info">
                            <p>Security is our highest priority. We meet or exceed the most stringent industry standards: each piece of our infrastructure and each stage of our operations are designed with security in mind.</p>
                            </p>
                        </div>
                    </form>

                    <script type='text/javascript'>
                        $(document).ready(function () {
                            var mPrice = <?= $mPrice == "" ? 0 : $mPrice ?>;
                            var nmPrice = <?= $nmPrice == "" ? 0 : $nmPrice ?>;

                            $("#m_qty,#nm_qty").change(function () {
                                // checking if tickets are selected
                                var mQty = parseInt($("#m_qty").val());
                                var nmQty = parseInt($("#nm_qty").val());

                                if(!mQty) {
                                    mQty = 0;
                                }

                                if(!nmQty) {
                                    nmQty = 0;
                                }

                                $('#total_tickets').html(mQty + nmQty);
                                $('#total_price').html(parseFloat(mQty * mPrice + nmQty * nmPrice).toFixed(2));
                            });

                            $('#btn-submit-payment').click(function () {
                                // checking if tickets are selected
                                var mQty = parseInt($("#m_qty").val());
                                var nmQty = parseInt($("#nm_qty").val());

                                if(!mQty) {
                                    mQty = 0;
                                }

                                if(!nmQty) {
                                    nmQty = 0;
                                }

                                if(mQty + nmQty > 0) {
                                    return true;
                                }

                                return false;
                            });
                        });
                    </script>
				</div>

            <div class="sip_stripe"> <!-- Stripe logo -->
                <a href="//www.authipay.com/" target="_blank">
                    <img src="<?php echo get_template_directory_uri()?>/images/aib_logo.png" width="100%">
                </a>
            </div>

			</section>
            <?php } ?>
	</div>
</article>


<?php
//get_sidebar();
get_footer();
