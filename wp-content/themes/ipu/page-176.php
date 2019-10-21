<?php
/**
 * The Template for SOP AND guideline
 *
 * @package WordPress
 * @subpackage IPU
 * @since Twenty Fourteen 1.0
 */
get_header(); ?>

<style>
/* End: Recommended Isotope styles */

#filters .sbf_filter input{
	display: none;
}
#filters .sbf_filter label{
	padding: 10px 101px 10px 0px;
}

</style>
<article id="content_wrapper">
		<aside class="sidebar sb_filters two_column">
		<?php
				//$customOrder = $_POST['phpvar'];
			//	print_r($_POST);
					$args = array(
						'posts_per_page' => -1,
						'post_type' => array('postersandpromo'),
						'orderby' => 'date',
						'order' => 'ASC'
					);
					
		$shortDesc = get_field('short_description', 176);			
		?>
		<?php if(!empty($shortDesc)){?>
			<div class="sb_txt"><?= $shortDesc; ?></div>
		<?php } ?>
			<h3><?php echo get_option( 'dropdown_text_name' )?></h3>
 
<!--			
			<div id="filters" class="sbf_filtergroup" data-group="type">
				<?php
					$args1 = array(
						'posts_per_page' => 11,
						'post_type' => array('guideline', 'sop'),
						'orderby' => 'date',
						'order' => 'ASC'
					);
					$query = new WP_Query($args1);
					while ($query->have_posts()) :
						//$counter = 1;
						$query->the_post();
						$fields = get_fields();
						$title = $fields["title"];
						$categorytxt = $fields["category"];
						$fieldz = get_field_object('category');
						$value = get_field('category');
						$categorylbl = $fieldz['choices'][$value];
						$shortDesc = $fields["short_description"];
						$viewLink = $fields["sop_link"];
						$post_type = get_post_type();
						$date = get_the_date("dmY");
						
					//	print_r($categorytxt);
				?>	
				<div class="sbf_filter" id="<?= $categorytxt; ?>"> <input type="checkbox" name="gi_<?= $categorytxt; ?>" value=".gi_<?= $categorytxt; ?>" id="gi_<?= $categorytxt; ?>" ><label for="gi_<?= $categorytxt; ?>"><?= $categorylbl; ?></label></div>
				<?php  endwhile; ?>
				<?php
				wp_reset_query();
				wp_reset_postdata();
				?>
	</div>-->

			<div id="filters" class="sbf_filtergroup" data-group="type">
				<!--<div class="sbf_filter"><input type="checkbox" value=".item" id="item" class="all" ><label for="item">All</label></div>-->
				<div class="sbf_filter" id="inspection"><input type="checkbox" name="gi_inspection" value=".gi_inspection" id="gi_inspection"><label for="gi_inspection">Inspection</label></div>
				<div class="sbf_filter" id="legislation"><input type="checkbox" name="gi_legislation" value=".gi_legislation" id="gi_legislation"><label for="gi_legislation">Legislation</label></div>
				<div class="sbf_filter" id="vaccinations"><input type="checkbox" name="gi_vaccinations" value=".gi_vaccinations" id="gi_vaccinations"><label for="gi_vaccinations">Vaccinations</label></div>
			</div>
					
		




			
		</aside>	
		<section class="content lp_content eight_column xsx">
			 
<!--			<form method="post" id="order" style="float: right; margin-top: -30px; margin-right: 16px">
  Sort by:
  <select name="select" onchange='this.form.submit()'>
    <option value="title"<?php selected( $_POST['select'],'title', 1 ); ?>>Name</option>
    <option value="date"<?php selected( $_POST['select'],'date', 1 ); ?>>Recent</option>
	<option value="popular"<?php selected( $_POST['select'],'popular', 1 ); ?>>Popular</option>
  </select>
</form>		-->
 
		<div class="sort">
			<div class="btn_sort_wrapper">
				<span>Sort by</span>
				<?php include_once 'common/sortby.php'; ?>
			</div>
		</div>
<div class="grid_wrapper">
				<div id="container" class=" grid_post">
					<?php
				$count = 1;
				$i = 0;
					$query = new WP_Query($args);
					while ($query->have_posts()) :
						//$counter = 1;
						$query->the_post();
						$fields = get_fields();
						$title = $fields["title"];
						$categorytxt = $fields["category"];
						$fieldz = get_field_object('category');
						$value = get_field('category');
						$categorylbl = $fieldz['choices'][$value];
						$shortDesc = $fields["short_description"];
					//	$viewLink = $fields["upload_file"];
										$attachment_id = get_field('upload_file');

				$viewFile = wp_get_attachment_url($attachment_id);
						$post_type = get_post_type();
 
$link_file = $fields["upload_file"];
$short_description = $fields["short_description"];
$files = wp_get_attachment_url(get_post_meta($link_file, 'files', true));

$link_letter = $fields["image"];
$picture = wp_get_attachment_image_src($link_letter, 'full', true);
$defaultPicture = wp_get_attachment_image_src($linkdef, 'full', true);
$def = 'img/antibiotic.jpg';
						?>		
					
					<div class="item g_item gi_poster">
			<?php if( $picture[0] != $defaultPicture[0] ) { ?>
				<div class="gi_cover_picture">
					<img src="<?= $picture[0];?>" alt="IPU" class="logo_header">
				</div>
			<?php } else { ?>
				<div class="gi_cover_picture">
					<img src="<?php bloginfo('template_directory'); ?>/<?=$def;?>" alt="IPU" class="logo_header">
				</div>
			<?php } ?>
				<span class="gi_wrapper_content">	
						<div class="gi_data_wrapper">		
							<div class="gi_data">
								<div class="gi_data_category">Poster</div>
								<span class="gi_data_date"><?= get_the_date("d M y"); ?></span>
								<h4 class="gi_title">
									<?= the_title(); ?>
								</h4>				
							</div>

							<div class="gi_data_sidebar">
								<div class="gi_data_sidebar_icon"></div>
								<div class="gi_data_sidebar_data">533kb</div>

							</div>
						</div>

						<div class="gi_content">
							<span class="gi_content_txt">
								<?= $shortDesc; ?>
							</span>
						</div>	
						<a href="<?= $viewFile; ?>" class="gi_btn" title="<?= $categorylbl; ?> - read">Read</a>
					</span>
					</div>
			 
					
					
		
					
					
					 


					<?php 
						$i++;
					endwhile; ?>
					<?php
					wp_reset_query();
					wp_reset_postdata();
					?>

 					<script>
						var container = '#container';
						
						<?php
						////////////////////////////////////////////////////////////////////////////////////////////////////////
						///////////////////////////////            Filters            //////////////////////////////////////////
						////////////////////////////////////////////////////////////////////////////////////////////////////////
	
											
							$query = new WP_Query($args1);
							while ($query->have_posts()) :
							$query->the_post();
							$post_type = get_post_type();
							$fields = get_fields();
							$title = $fields["title"];
							$categorytxt = $fields["category"];
						?>
							var n<?= $categorytxt[0]; ?> = $(container + ' .gi_<?= $categorytxt[0]; ?>').length;
							var s<?= $categorytxt[0]; ?> = $('<span />',{
								class:'<?= $categorytxt[0]; ?> sbf_filter_counter' , 
								html: n<?= $categorytxt[0]; ?>,
							});
							s<?= $categorytxt[0]; ?>.appendTo('#<?= $categorytxt[0]; ?>');
						<?php endwhile; ?>

						<?php
							wp_reset_query();
							wp_reset_postdata();
						?>	
							$('.sbf_filter_counter').addClass('remove');
						$('.remove:last-child').addClass('last');
							$('.last:last-child').removeClass('remove');
						$('.remove').remove();
							
					</script>
			</div>
		</div>
 
	</section>
	</article>

<?php

get_footer();
