<?php //
/**
 * The Template for HSE CONTACT - > CLAIMS --- OLD
 *
 * @package WordPress
 * @subpackage IPU
 * @since Twenty Fourteen 1.0
 */
get_header();
?>
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
		'post_type' => array('event'),
		'orderby' => 'date',
		'order' => 'ASC'
	);
	$shortDesc = get_field('short_description', 147);
?>

<article id="content_wrapper">
	<aside class="sidebar sb_filters two_column">

		<?php if(!empty($shortDesc)){?>
			<div class="sb_txt"><?= $shortDesc; ?></div>
		<?php } ?>
		<h3><?php echo get_option( 'dropdown_text_name' )?></h3>


				<div id="filters" class="sbf_filtergroup" data-group="filter">
<!--			<div class="sbf_filter sbf_filter_active"><input type="checkbox" value=".item" id="item" class="all"><label for="item">All</label></div>			-->
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
	<div class="content lp_content eight_column content_same_height lp_event">

		<?php
			/******
			 * slider content
			 ******/
		?>
		<div class="slider_event">
			<a class="unslider-arrow next"></a>
			<ul>
				<?php
				$args_slider = array(
					'posts_per_page' => 4,
					'post_type' => array('event'),
					'orderby' => 'date',
					'order' => 'DESC'
				);
				$query2 = new WP_Query($args_slider);
				while ($query2->have_posts()) :
					$query2->the_post();
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


					?>

				<?php
					//event content
				?>
					<li class="slide_event">

						<div class="g_item gi_event gi_<?= $color; ?> gi_<?= $category; ?>">
							<div class="gi_data_wrapper">
								<div class="gi_data_sidebar">
									<div class="gi_data_date">
										<span class="gi_data_day"><?= $day; ?></span>
										<span class="gi_data_month"><?= $month; ?></span>
									</div>
								</div>
								<div class="gi_data">
									<div class="gi_data_category_wrapper">
										<div class="gi_data_category"><?= $categoryLbl; ?></div>
									</div>
									<h4 class="gi_title">
										<div class="ellipsis_text">
											<span><?php the_title(); ?></span>
										</div>
									</h4>
									<h5 class="gi_content_txt">
										<div class="ellipsis_text">
											<span><?= $shortDesc; ?></span>
										</div>
									</h5>
									<a class="gi_btn_arrow" href="<?= get_permalink(); ?>" title="<?php the_title(); ?> - read">Read</a>
								</div>
							</div>
						</div>
					</li>
					<?php
				endwhile;
				?>
				<?php
					wp_reset_query();
					wp_reset_postdata();
				?>
			</ul>
		</div>

		<?php
			/******
			 * slider content end
			 ******/
		?>

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
				?>
				<?php if (!empty($avatar)) {
					?>
					<div class="item g_item gi_event gi_<?= $color; ?> gi_event_img gi_<?= $category; ?>">

						<div class="gi_event_img_wrapper">
							<?php if (!empty($evDate)) { //------- if the event got a picture -------  ?>
								<div class="gi_data_sidebar_img">
									<div class="gi_data_date">
										<span class="gi_data_day"><?= $day; ?></span>
										<span class="gi_data_month"><?= $month; ?></span>
									</div>
								</div>
							<?php } // ------- end -------  ?>
							<div class="gi_cover_picture" style="background-image: url('<?= $avatar[0]; ?>')"></div>
							<div class="gi_data_wrapper">
								<div class="gi_data_sidebar">
									<?php if (!empty($evDate)) { //------- if the event got a picture -------  ?>
										<div class="gi_data_date">
											<span class="gi_data_day"><?= $day; ?></span>
											<span class="gi_data_month"><?= $month; ?></span>
										</div>
									<?php } // ------- end -------  ?>
								</div>
								<div class="gi_data">
									<div class="gi_data_category_wrapper">
										<div class="gi_data_category"><?= $categoryLbl; ?></div>
									</div>

									<h4 class="gi_title">
										<div class="ellipsis_text">
											<span><?php the_title(); ?></span>
										</div>
									</h4>
									<h5 class="gi_content_txt">
										<div class="ellipsis_text">
											<span><?= $shortDesc; ?></span>
										</div>
									</h5>
									<a class="gi_btn_arrow" href="<?= get_permalink(); ?>" title="<?php the_title(); ?> - read">Read</a>
								</div>
							</div>
						</div>
					</div>
				<?php } else { ?>
					<div class="item g_item gi_event gi_<?= $color; ?> gi_<?= $category; ?>">

						<div class="gi_data_wrapper">
							<?php if (!empty($evDate)) { //------- if the event got a picture -------  ?>
								<div class="gi_data_sidebar">
									<div class="gi_data_date">
										<span class="gi_data_day"><?= $day; ?></span>
										<span class="gi_data_month"><?= $month; ?></span>
									</div>
								</div>
							<?php } // ------- end -------  ?>
							<div class="gi_data">
										<div class="gi_data_category_wrapper">
										<div class="gi_data_category"><?= $categoryLbl; ?></div>
									</div>
									<h4 class="gi_title">
										<div class="ellipsis_text">
											<span><?php the_title(); ?></span>
										</div>
									</h4>
									<h5 class="gi_content_txt">
										<div class="ellipsis_text">
											<span><?= $shortDesc; ?></span>
										</div>
									</h5>
								<a class="gi_btn_arrow" href="<?= get_permalink(); ?>" title="<?php the_title(); ?> - read">Read</a>

							</div>
						</div>
					</div>
				<?php } ?>
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

		</div>
</article>

<script>
	//filters counter
	//move-
	$('.sbf_filter_counter').addClass('remove');
	$('.remove:last-child').addClass('last');
	$('.last:last-child').removeClass('remove');
	$('.remove').remove();

	$('.sbf_filter_counter').css('visibility','visible');
</script>



<?php
get_footer();
