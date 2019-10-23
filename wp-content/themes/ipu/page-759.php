<?php
/**
 * The Template for Events - > Courses available
 *
 * @package WordPress
 * @subpackage IPU
 * @since Twenty Fourteen 1.0
 */
get_header();

$cfg = searchConfigurationInfo();
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

	/* End: Recommended Isotope styles */

	#filters .sbf_filter input{
		display: none;
	}
	#filters .sbf_filter label{
		padding: 10px 101px 10px 0px;
	}
.sb_filters .sbf_filtergroup .sbf_filter .sbf_filter_counter{
	visibility: hidden;
}

</style>

<?php
	$args = array(
		'posts_per_page' => -1,
		'post_type' => array('course'),
		'orderby' => 'date',
		'order' => 'ASC'
	);
	$shortDesc = get_field('short_description', 759);
?>

<article id="content_wrapper">
	<aside class="sidebar sb_filters two_column">

		<?php if(!empty($shortDesc)){?>
			<div class="sb_txt"><?= $shortDesc; ?></div>
		<?php } ?>
		<h3><?php echo get_option( 'dropdown_text_name' )?></h3>

		<div id="filters" class="sbf_filtergroup" data-group="filter">
			<div class="sbf_filter sbf_filter_active"><input type="checkbox" value=".item" id="item" class="all"><label for="item">All</label></div>
			<?php
				$field_key = "field_54870383184be";
				$field_cat = get_field_object($field_key);
				if ($field_cat) {
					foreach ($field_cat['choices'] as $k => $v) {
						?>
						<div class="sbf_filter" id="<?= $k; ?>"> <input type="checkbox" name="gi_<?= $k; ?>" value=".gi_<?= $k; ?>" id="gi_<?= $k; ?>"><label for="gi_<?= $k; ?>"><?= $v; ?></label></div>
						<?php
					}
				}
			?>
		</div>
	</aside>

		<?php
			/******
			 * slider content end
			 ******/
		?>

<section class="content lp_content eight_column">
	<div class="grid_wrapper">
	<div id="container" class=" grid_post">
		<?php
			$query = new WP_Query($args);
			while ($query->have_posts()) :
				$query->the_post();
				$fields = get_fields();
				//update ******
				$shortDesc = $fields["short_description"];
				$avatar = wp_get_attachment_image_src(get_field('image'), 'medium');

				$evDate = get_field('date');
				$year = date( 'Y', strtotime( $evDate ) );
				$month = date( 'M', strtotime( $evDate ) );
				$day = date( 'd', strtotime( $evDate ) );
				$time = date( 'H:i', strtotime( $evDate ) );

				$category = $fields["category"];

				$fieldz = get_field_object('category');
				$value = get_field('category');
				$categoryLbl = $fieldz['choices'][$value];
				if ($category == "cat1") {
					$color = "green";
				}
				if ($category == "cat2") {
					$color = "blue";
				}
				if ($category == "cat3") {
					$color = "turquoise";
				}
				if ($category == "cat4") {
					$color = "purple";
				}

				//update
				$title = $fields["title"];
				$subtitle = $fields["subtitle"];
				$course_duration = $fields["course_duration"];
				$description = $fields["description"];
				$non_member_price = $fields["non_member_price"];
				$member_price = $fields["members_price"];
                $enable_order_now = $fields['enable_order_now'];
				?>


		<div class="item g_item gi_person gi_training">
					<div class="gi_data">
						<!-- <div class="gi_data_category">Training</div> -->
						<div class="gi_data_time"><?= $course_duration; ?></div>
					</div>
					<div class="gi_content">
						<div class="gi_subtitle"> <?= $subtitle; ?></div>
						<div class="gi_title"> <?= $title; ?> </div>
						<div class="gi_content_txt">
							 <?= $description; ?>
						</div>
					</div>
					<div class="gi_register">
                        <?php if($member_price != '' || $non_member_price != '') { ?>
						<div class="gir_info">
							<?php if($member_price != '' && $member_price != 0) { ?>
							<span class="gir_price" href="#"><i>€<?=$member_price; ?></i> for IPU Members
                            <?php } ?>
								<?php if($non_member_price != '' && $non_member_price != 0) { ?>
							<span class="gir_price" href="#"><i>€<?=$non_member_price; ?></i> for IPU Non Members
                            <?php } ?>
						</span></span></div>
                        <?php } ?>
						<div class="gir_action">
                            <?php
                                $junction = '?';
                                if(strpos($cfg["card_info_page_url"], '?') !== false) {
                                    $junction = '&';
                                }
                            ?>

                            <?php if($enable_order_now) { ?>
							 <a class="btn btn_action_order" href="/checkout?item=<?php echo get_the_ID() ?>">Order now</a>
                            <?php } ?>
							<!-- Register interest -->
							<?php if (is_user_logged_in()) { ?>
								<!-- logged in  -->
								<form action="/wp-content/themes/ipu/register-interest.php" class="register-interest--form" method="post">

									<input type="hidden" name="name" value="<?= $current_user->display_name; ?>">
									<input type="hidden" name="email" value="<?= $current_user->user_email; ?>">
									<input type="hidden" name="courseId" value="<?= get_the_ID(); ?>">
									<input type="hidden" name="recaptcha_response" id="recaptchaResponse">
									<input type="submit" value="Register your interest" class="btn btn_action_register">

								</form>

							<?php } else { ?>
								<!-- not logged in, modal to get email and name -->
								<a class="btn btn_action_register guest_register" href="#">Register your interest</a>

							<?php } ?>
							<!-- /Register interest -->
						</div>

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

					</div>
				</div>

					<?php
						////////////     Filters    //////////////
					?>
				<script>
					<?php if($category): ?>
						var n<?= $category; ?> = $('#container' + ' .gi_<?= $category; ?>').length;
						var s<?= $category; ?> = $('<span />',{
							class:'gi_<?= $category; ?> sbf_filter_counter' ,
							html: n<?= $category; ?>
						});
						s<?= $category; ?>.appendTo('#<?= $category; ?>');
					<?php endif; ?>
				</script>
			<?php

			endwhile;
			?>
		<?php
			wp_reset_query();
			wp_reset_postdata();
		?>
	</div>
</div>
</section>
</article>

<script>
	//filters counter
	//move-
	$('.sbf_filter_counter').addClass('remove');
	$('.remove:last-child').addClass('last');
	$('.last:last-child').removeClass('remove');
	$('.remove').remove();

	$('.sbf_filter_counter').css('visibility','visible');


	$('.guest_register').click(function (e) {
		e.preventDefault();
		$(this).parent().next().addClass('register-interest--form-show');
	});

</script>



<?php
get_footer();
