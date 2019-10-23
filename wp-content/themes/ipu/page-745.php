<?php
/**
 * The Template for Suppliers - Business
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
	$shortDesc = get_field('short_description', 745);
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
				$field_key = "field_5489d4ca32e2d";
				$field = get_field_object($field_key);
				if ($field) {
					foreach ($field['choices'] as $k => $v) {
						?>
						<div class="sbf_filter" id="<?= $k; ?>"> <input type="checkbox" name="gi_<?= $k; ?>" value=".gi_<?= $k; ?>" id="gi_<?= $k; ?>"><label for="gi_<?= $k; ?>"><?= $v; ?></label></div> 
						<?php
					}
				}
			?>					
		</div>

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
					'post_type' => 'supplier',
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
 
					?>
				
				<?php
					//event content
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
											<?= $shortDesc; ?>	
										</span>
									</div>	
									<a class="gi_btn gi_btn_arrow" href="<?= get_permalink(); ?>" title="<?php the_title(); ?> - read">Read</a>				
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
	</section>
		<?php
			/******
			 * slider content end
			 ******/
		?>	
		 
<section class="content lp_content eight_column">
 <div class="grid_wrapper">
		<div id="container" class=" grid_post">
			<?php
				/*******************************
				 * main content
				 ******************************/
			?>
			<?php
		$args = array(
		'posts_per_page' => -1,
		'post_type' => 'supplier',
		'orderby' => 'date',
		'order' => 'ASC'
	);
				
			$query = new WP_Query($args);
			while ($query->have_posts()) :
				$query->the_post();
				$fields = get_fields();
 				$select = $fields["category"];
 				$fieldz = get_field_object('category');
 				$value = get_field('category');
 				$categorylbl = $fieldz['choices'][$value];
				
				//update
				$author = $fields["author"];
				$offer = $fields["offer"];
				$shortDesc = $fields["short_description"];
				$bg_picture = wp_get_attachment_image_src(get_field('picture'), 'medium');
				$logo = wp_get_attachment_image_src(get_field('logo'), 'medium');
				foreach($select as $selected){
					$category = $selected;
					//$categorylbl = $label;
				}			
				?>		
			
				<div class="item g_item gi_supplier gi_<?= $category; ?> <?= $post_type; ?>" data-time="<?= $date; ?>" data-category="<?= $post_type; ?>">									
								<div class="gi_data_img" style="<?php if($bg_picture[0]){?> background: url('<?=$bg_picture[0];?> ');<?php }?>">
									<div class="gi_data_img_overlay">
										<div class="gi_data">
											<div class="gi_data_category"><?= $post_type; ?></div>
											<span class="gi_data_date"><?= get_the_date("d M Y"); ?></span>
										</div>
										<div class="gi_avatar" style="<?php if($logo[0]){?> background: url('<?=$logo[0];?> ');<?php }?>">
<!--											<img src="<?=$logo[0];?>" width='24'/>-->
										</div>
									</div>
								</div>
								<div class="gi_content">
									<h4 class="gi_subtitle"><?= $offer; ?></h4>
									<h4 class="gi_title"><?php the_title(); ?></h4>	
									<p class="gi_supplier">
										<?php if (!empty($author)) { ?>
											By the <?= $author; ?>
										<?php } ?>
									</p>									
									<p class="gi_content_txt">
										 <?= $shortDesc; ?>	
									</p>
								</div>	
								<a class="gi_btn" href="<?= get_permalink(); ?>" title="<?php the_title(); ?> - read">Read</a>									
							</div>
			
			
		
			
			
			
			<script>
				var n<?= $category; ?> = $('#container' + ' .gi_<?= $category; ?>').length;
				var s<?= $category; ?> = $('<span />',{
					class:'gi_<?= $category; ?> sbf_filter_counter' , 
					html: n<?= $category; ?>
				});
				s<?= $category; ?>.appendTo('#<?= $category; ?>');
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
</script>
<?php
get_footer();



