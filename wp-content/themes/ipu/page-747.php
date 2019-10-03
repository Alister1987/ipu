<?php
/**
 * The Template for HSE CONTACT - > CLAIMS
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

.sidebar{min-height: 400px;}
 
</style>

<?php

	$shortDesc = get_field('short_description', 747);
	
	
?>

<article id="content_wrapper">
	<aside class="sidebar sb_filters two_column">

		<?php if(!empty($shortDesc)){?>
			<div class="sb_txt"><?= $shortDesc; ?></div>
		<?php } ?>
 
	</aside>
	<section class="content lp_content eight_column lp_event">
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
					'post_type' => array('article'),
					'orderby' => 'date',
					'order' => 'DESC'
				);
				$query2 = new WP_Query($args_slider);
				while ($query2->have_posts()) :
					$post_type = get_post_type();
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
						
				<?php
					if (have_rows('categorybusiness')):
						while (have_rows('categorybusiness')) : the_row();
							$display = get_sub_field('managing');
							if( $display == 'yes' ){
					?>
						
					<li class="slide_event">
					
		 <div class="g_item gi_article article">
			 
			<div class="gi_data_wrapper">		
				<div class="gi_data_sidebar">
					<div class="gi_data_date">
						<span class="gi_data_day"><?= $day; ?></span>
						<span class="gi_data_month"><?= $month; ?></span>
					</div>	
				</div>			
				<div class="gi_data">
					<div class="gi_data_category"><?= $post_type; ?></div>
					 
					<h4 class="gi_title">
					<?php the_title(); ?>			</h4>	
					<span class="gi_author">
						By  Judy Goldman 					</span>				
				</div>
			</div>
			<div class="gi_content">
				<span class="gi_content_txt">
					<?=$shortDesc;?>	
				</span>
			</div>	
			<a class="gi_btn gi_btn_arrow" href="<?= get_permalink(); ?>" title="<?php the_title(); ?> - read">Read</a>				
		</div>		
					</li>
										<?php
					}
					endwhile;
				endif;
 

			wp_reset_query();
			wp_reset_postdata();
			?>
					<?php
				endwhile;
				?>
				<?php
					wp_reset_query();
					wp_reset_postdata();
				?>
			</ul>
		</div>
	</section>
		<?php
			/******
			 * slider content end
			 ******/
		?>	
		 
<section class="content lp_content eight_column">
 
		<div id=" " class=" grid_post">
			<?php
				/*******************************
				 * main content
				 ******************************/
			?>
			<?php
				$args = array(
		'posts_per_page' => -1,
		'post_type' => 'article',
		'orderby' => 'date',
		'order' => 'ASC'
	);
				
			$query = new WP_Query($args);
			while ($query->have_posts()) :
				$query->the_post();
				$fields = get_fields();
//				$title = $fields["title"];
//				$categorytxt = $fields["category"];
//				$fieldz = get_field_object('category');
//				$value = get_field('category');
//				$categorylbl = $fieldz['choices'][$value];
//				$shortDesc = $fields["short_description"];
//				$attachment_id = get_field('upload_file');
//
//				$viewFile = wp_get_attachment_url($attachment_id);
//				$post_type = get_post_type 

				?>				
				
 
			
	  			  <?php
// check if the repeater field has rows of data
				if (have_rows('categorybusiness')):

					// loop through the rows of data
					while (have_rows('categorybusiness')) : the_row();

						// display a sub field value
						$display = get_sub_field('managing');
						if( $display == 'yes' ){
?>
	
									<div class="item g_item gi_article gi_<?= $category; ?> <?= $post_type; ?>" data-time="<?= $date; ?>" data-category="<?= $post_type; ?>">
										<div class="gi_cover_picture"></div>
										<div class="gi_data_wrapper">		
											<div class="gi_data_sidebar">
												<div class="gi_data_date">
													<span class="gi_data_day"><?= get_the_date("d"); ?></span>
													<span class="gi_data_month"><?= get_the_date("M"); ?></span>
												</div>	
											</div>			
											<div class="gi_data">
												<div class="gi_data_category name"><?= $post_type; ?></div>
												
												<?php showCounter(); ?>
												
												<h4 class="gi_title"><?php the_title(); ?></h4>	
												<span class="gi_author">
													<?php if (!empty($author)) { ?>
														By <?= $author; ?>
													<?php } ?>
												</span>				
											</div>
										</div>
										<div class="gi_content">
											<span class="gi_content_txt">
												<?= $shortDesc; ?>
											</span>
										</div>	
										<a href="<?php the_permalink(); ?>" class="gi_btn" title="<?= $categorylbl; ?> - view">View</a>	
									</div>
			<?php } ?>
	
	<?php
					endwhile;

				endif;
				?>

	 			
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
 

<?php
get_footer();



