<?php
/**
 * The Template for Home – non members
 *
 * @package WordPress
 * @subpackage IPU
 * @since Twenty Fourteen 1.0
 */
get_header();
?>


<article id="content_wrapper mk_home_content_wrapper">
	<?php
	/************
	 * 
	 * Left Column
	 * 
	 * ***********/
	?>
	<aside class="sidebar two_column sb_mk_home content_same_height">
		<div class="sb_mkh_wrapper">
            <h3>Latest News</h3>
			<div class="timeline">	
				<?php
				$post_type = get_post_type();
				$args = array(
					'posts_per_page' => 5,
					'post_type' => array('news'),
					'orderby' => 'date',
					'order' => 'ASC'
				);
				?>
				<?php
				$query = new WP_Query($args);
				while ($query->have_posts()) :
					//$counter = 1;
					$query->the_post();
					$fields = get_fields();
					$title = $fields["title"];
					$category = $fields["category"];
					$fieldz = get_field_object('category');
					$value = get_field('category');
					$categorylbl = $fieldz['choices'][$value];
					$shortDesc = $fields["short_description"];
					$viewLink = $fields["sop_link"];
					$post_type = get_post_type();
					$date = get_the_date("dmY");
					$id = get_the_ID();

					$color = '';
					if ($category == 'cat1') {
						$color = 'tl_n_turquoise';
					} elseif ($category == 'cat2') {
						$color = 'tl_n_blue';
					} elseif ($category == 'cat3') {
						$color = 'tl_n_purple';
					} elseif ($category == 'cat4') {
						$color = 'tl_n_green';
					}

					$day = get_the_date('d');
					$month = get_the_date('M');
					?>

					<a href="<?= get_permalink(); ?>">
						<div class="tl_item tl_n_item <?= $color; ?> <?= $category; ?>" >
							<div class="tl_date">
								<span class="tl_day"><?= $day; ?></span>
								<span class="tl_month"><?= $month; ?></span>
							</div>	
							<div class="tl_iconbar">
							</div>	
							<div class="tl_txt">
								<span class="n_cat"><?= $category; ?></span>
								<span class="n_title"><?php the_title(); ?></span>
								<span class="n_shortDesc">
									<p><?= $shortDesc; ?></p>
								</span>
<!--								<span class="btn_tl">Read</span>-->
							</div>					
						</div>
					</a>





	<?php
endwhile;
wp_reset_query();
wp_reset_postdata();
?>








			</div>
		</div>
	</aside>	



	<?php
	/************
	 * 
	 * Content
	 * 
	 * ***********/
	?>
	<div class="content lp_content eight_column mk_home_content content_same_height">

		<section class="mkh_about">
			<div class="box_wrapper box_green">	

			<?php
			$repeater = 'left_content';
			$download = 'button';

			if (get_field($repeater)):
				while (have_rows($repeater)) : the_row();
					//$title = get_sub_field('title');
					$title = get_sub_field('title');
					$description = get_sub_field('description');
					$subtitle = get_sub_field('subtitle');
					$link_address = get_sub_field('link_title');
					$link_url = get_sub_field('link_url');
					?>


						<div class="box_inside">	
							<h4><?= $subtitle; ?></h4>
							<h3><?= $title; ?></h3>
							<div class="box_content">
								<?= $description; ?>
							</div>	
							<div class="box_action">
								<a href="<?= $link_url; ?>" class="btn btn_action_go"><?= $link_address; ?></a>	
							</div>						
						</div>

							<?php
						endwhile;
					endif;
					wp_reset_query();
					wp_reset_postdata();
					?>
			</div>	
			<div class="box_wrapper box_w_green">	
				<?php
				$second = 'right_content';
				if (get_field($second)):
					while (have_rows($second)) : the_row();
						//$title = get_sub_field('title');
						$title = get_sub_field('title');
						$description = get_sub_field('description');
						$subtitle = get_sub_field('subtitle');
						$link_title = get_sub_field('link_title');
						$link_url = get_sub_field('link_url');
						?>
						<div class="box_inside">	
							<h4><?= $subtitle; ?></h4>
							<h3><?= $title; ?></h3>
							<div class="box_content"><?= $description; ?></div>
							<div class="box_action">
								<a href="<?= $link_url; ?>" class="btn btn_action_go"><?= $link_title; ?></a>	
							</div>	
						</div>
					<?php
				endwhile;
			endif;
			wp_reset_query();
			wp_reset_postdata();
			?>
			</div>					
		</section>
		<section class="content lp_content">

			<div class="grid_wrapper mkh_event">	
				<div class="w_title">
					<h3>Event &amp; training</h3>
					<h2>Upcoming</h2>		
				</div>
				<div id="container" class=" grid_post">
					<?php
					$args_ev = array(
						'posts_per_page' => 4,
						'post_type' => 'event',
						'orderby' => 'date',
						'order' => 'DESC'
					);
					?>
					<?php
					$query_ev = new WP_Query($args_ev);
					while ($query_ev->have_posts()) :
						$query_ev->the_post();
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
									<?php } // ------- end -------   ?>
									<div class="gi_cover_picture" style="background-image: url('<?= $avatar[0]; ?>')"></div>
									<div class="gi_data_wrapper">		
										<div class="gi_data_sidebar">
											<?php if (!empty($evDate)) { //------- if the event got a picture -------   ?>
												<div class="gi_data_date">
													<span class="gi_data_day"><?= $day; ?></span>
													<span class="gi_data_month"><?= $month; ?></span>
												</div>	
											<?php } // ------- end -------   ?>
										</div>			
										<div class="gi_data">
											<div class="gi_data_category_wrapper">
												<div class="gi_data_category"><?= $categoryLbl; ?></div>
											</div>

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
										<?php if (!empty($evDate)) { //------- if the event got a picture -------   ?>
										<div class="gi_data_sidebar"> 
											<div class="gi_data_date">
												<span class="gi_data_day"><?= $day; ?></span>
												<span class="gi_data_month"><?= $month; ?></span>
											</div>	
										</div>	
										<?php } // ------- end -------   ?>
									<div class="gi_data">
										<div class="gi_data_category_wrapper">
											<div class="gi_data_category"><?= $categoryLbl; ?></div>
										</div>
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
								var s<?= $category; ?> = $('<span />', {
									class: 'gi_<?= $category; ?> sbf_filter_counter',
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
	</div>
</article>
<?php
get_footer();

