<?php
/**
 * The Template for Thank you page
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
		'posts_per_page' => 4,
		'post_type' => array('event'),
		'orderby' => 'rand',
		'order' => 'ASC'
	);
	//$shortDesc = get_field('short_description', 147);
?>

<article id="content_wrapper">
	<section class="content lp_content eight_column">
		<?php the_content(); ?>
	</section>
	
		<?php
			/******
			 * slider content end
			 ******/
		?>	
				
	<section class="content lp_content eight_column">
		<h3>EVENT & TRAINING</h3>

		<h2>OTHER EVENTS YOU MIGHT LIKE</h2>
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
				$year = date('Y', strtotime($evDate));
				$month = date('M', strtotime($evDate));
				$day = date('d', strtotime($evDate));
				$time = date('H:i', strtotime($evDate));

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
									<div class="gi_data_category"><?= $categoryLbl; ?></div>
									<h4 class="gi_title">
										<?php the_title(); ?>  
									</h4>
									<h4 class="gi_content_txt">
										<?= $shortDesc; ?>
									</h4>	
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
								<div class="gi_data_category"><?= $categoryLbl; ?></div>
								<h4 class="gi_title">
									<?php the_title(); ?>  
								</h4>
								<h4 class="gi_content_txt">
									<?= $shortDesc; ?>
								</h4>	
								<a class="gi_btn_arrow" href="<?= get_permalink(); ?>" title="<?php the_title(); ?> - read">Read</a>							

							</div>
						</div>
					</div>
				<?php } ?>
				<?php
				////////////     Filters    //////////////
				?>	
				<script>
	<?php if ($category): ?>
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
</script>



<?php
get_footer();



