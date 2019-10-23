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

.sbf_filter input{
		display: none;
	}
.sbf_filter label{
		padding: 10px 101px 10px 0px;
	}
.sb_filters .sbf_filtergroup .sbf_filter .sbf_filter_counter{
	visibility: hidden;
}

body {
  font-family: 'Helvetica Neue', Arial, sans-serif;
}

#container {
  border: 2px solid;
  padding: 5px;
  width: 100%;
  height: 160px;
}

.item {
  width: 350px;
  min-height: 230px;
  height: 100%;
  background: #26D;
  float: left;
  margin: 5px;
  color: white;
  font-size: 60px;
}

.item.large {
  width: 150px;
  height: 150px;
  background: #2D6;
  z-index: 10;
}

.item:hover {
  cursor: pointer;
}

/**** Isotope CSS3 transitions ****/

.isotope,
.isotope .isotope-item {
  -webkit-transition-duration: 0.8s;
     -moz-transition-duration: 0.8s;
          transition-duration: 0.8s;

}

.isotope {
  -webkit-transition-property: height, width;
     -moz-transition-property: height, width;
          transition-property: height, width;
}

.isotope .isotope-item {
  -webkit-transition-property: -webkit-transform, opacity;
     -moz-transition-property:    -moz-transform, opacity;
          transition-property:         transform, opacity;
}
</style>
<article id="content_wrapper">
	<aside class="sidebar sb_filters two_column">
		<?php
			$args = array(
				'posts_per_page' => -1,
				'post_type' => array('sop', 'article', 'faq', 'file', 'guideline'),
				'orderby' => 'date',
				'order' => 'ASC'
			);
		$shortDesc = get_field('short_description', 735);
		?>
	<?php if(!empty($shortDesc)){?>
		<div class="sb_txt"><?= $shortDesc; ?></div>
	<?php } ?>
		<h3>Filter BY TYPE</h3>
		<div id="filters" class="sbf_filtergroup" data-group="type">
			<!--<div class="sbf_filter"><input type="checkbox" value=".item" id="item" class="all" ><label for="item">All</label></div>-->

			<div class="sbf_filter" id="formss"><input type="checkbox" name="gi_formss" value=".gi_formss" id="gi_formss"><label for="gi_formss">Forms</label></div>
			<div class="sbf_filter" id="medicinesinformations"><input type="checkbox" name="gi_medicinesinformations" value=".gi_medicinesinformations" id="gi_medicinesinformations"><label for="gi_medicinesinformations">Medicines Information</label></div>
			<div class="sbf_filter" id="noacss"><input type="checkbox" name="gi_noacss" value=".gi_noacss" id="gi_noacss"><label for="gi_noacss">NOACs</label></div>
			<div class="sbf_filter" id="nurseprescribings"><input type="checkbox" name="gi_nurseprescribings" value=".gi_nurseprescribing" id="gi_nurseprescribings"><label for="gi_nurseprescribings">Nurse Prescribing</label></div>
			<div class="sbf_filter" id="tamiflus"><input type="checkbox" name="gi_tamiflus" value=".gi_tamiflus" id="gi_tamiflu"><label for="gi_tamiflus">Tamiflu</label></div>
			<div class="sbf_filter" id="unlicencedmediciness"><input type="checkbox" name="gi_unlicencedmediciness" value=".gi_unlicencedmediciness" id="gi_unlicencedmediciness"><label for="gi_unlicencedmediciness">Unlicenced Medicines</label></div>
		
		
		</div>
	</aside>
	

	<section class="content lp_content eight_column">
		<div class="sort">
			<div class="btn_sort_wrapper">
				<span>Sort by</span>
				<?php include_once 'common/sortby.php'; ?>
			</div>
		</div>
		<div class="grid_wrapper">
		<div id="container" class=" grid_post">
			<?php
				/*******************************
				 * main content
				 ******************************/
			?>
			<?php
			$query = new WP_Query($args);
			while ($query->have_posts()) :
				$query->the_post();
				$fields = get_fields();
				$title = $fields["title"];
				$categorytxt = $fields["category"];
				$fieldz = get_field_object('category');
				$value = get_field('category');
				$categorylbl = $fieldz['choices'][$value];
				$shortDesc = $fields["short_description"];
				$attachment_id = get_field('upload_file');

				$viewFile = wp_get_attachment_url($attachment_id);
				$post_type = get_post_type();
				
				//print_r($categorytxt[0]);
				?>				
				
			<?php
				/*******************************
				 * category_hse_contact repeater 
				 ******************************/
			?>
			<?php
				$page = 'categoryhsecontact';
				$subpage = 'noacs';
				
				if (get_field($page)):
						while (have_rows($page)) : the_row();
							if (have_rows($subpage)):
								while (have_rows($subpage)) : the_row();
								$select = get_sub_field('select');
								$display = get_sub_field('display');
								$id = $post->ID;

								foreach($select as $selected){
									$category = $selected;
								}			
			?>
						<?php
							/**************
							 * boxes layout  
							 **************/
						?>
			
						<?php if(!empty($category) && ($display == 'yes')) { ?>

						<?php
							//filter by category
							//*************
						?>
								<?php  if ($post_type == 'article') {  ?>
									<div class="item g_item gi_article gi_<?= $category; ?>" data-time="<?= $date; ?>" data-category="<?= $post_type; ?>">
										<div class="gi_cover_picture"></div>
										<div class="gi_data_wrapper">		
											<div class="gi_data_sidebar">
												<div class="gi_data_date">
													<span class="gi_data_day"><?= get_the_date("d"); ?></span>
													<span class="gi_data_month"><?= get_the_date("M"); ?></span>
												</div>	
											</div>			
											<div class="gi_data">
												<div class="gi_data_category"><?= $post_type; ?> </div>
												<?php// showCounter(); ?>
												<h4 class="gi_title">
													<?php the_title(); ?> 
												</h4>	
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
								<?php }  ?>

								<?php if ($post_type == 'faq') { ?>
									<div class="item g_item gi_faq gi_<?= $category; ?>" data-time="<?= $date; ?>" data-category="<?= $post_type; ?>">
										<div class="gi_data">
											<div class="gi_data_category" data-category="<?= $post_type; ?>"><?= $post_type; ?></div>
											<?php// showCounter(); ?>
											<span class="gi_data_date"><?= get_the_date("d M y"); ?></span>
										</div>
										<h4 class="gi_title">
											<?php the_title(); ?> 
										</h4>
										<div class="gi_content">
											<span class="gi_content_txt"><?= $shortDesc; ?></span>
										</div>	
										<a href="<?php the_permalink(); ?>" class="gi_btn" title="<?= $title; ?> - read">Read</a>			
									</div>
								<?php } ?>

								<?php if ($post_type == 'file') { ?>
									<?php
										$downloadFile = wp_get_attachment_url(get_post_meta(get_the_ID(), 'files', true));
									?>
									<div class="item g_item gi_file gi_<?= $category; ?>"  data-time="<?= $date; ?>" data-category="<?= $post_type; ?>" >
										<div class="gi_data_wrapper">		
											<div class="gi_data">
												<div class="gi_data_category" data-category="<?= $post_type; ?>"><?= $post_type; ?></div>
												<span class="gi_data_date"><?= get_the_date("d M y"); ?></span>
												<h4 class="gi_title">
													<?php the_title(); ?> 
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
										<a href="<?= $downloadFile; ?>" class="gi_btn" title="<?= $title; ?> - read">Download</a>		
									</div>
								<?php } ?>

								<?php if ($post_type == 'guideline') { ?>
									<div class="item g_item gi_guideline gi_<?= $category; ?>"  data-time="<?= $date; ?>"  data-category="<?= $post_type; ?>">
										<div class="gi_data">
											<div class="gi_data_category" data-category="<?= $post_type; ?>">Guideline</div>
											<span class="gi_data_date"><?= get_the_date("d M y"); ?></span>
										</div>
										<h4 class="gi_title">
									<?php the_title(); ?> 
										</h4>
										<div class="gi_content">
											<span class="gi_content_txt">
									<?= $shortDesc; ?>
											</span>
										</div>	
										<a href="<?php the_permalink(); ?>" class="gi_btn">www.hse.ie</a>

									</div>
								<?php } ?>	

						<?php } ?>

						<?php
							////////////     Filters    //////////////
						?>	
						<script>
							<?php if($category): ?>
								var n<?= $category; ?> = $('#container' + ' .gi_<?= $category; ?>').length;

								var s<?= $category; ?> = $('<span />',{
									class:'<?= $category; ?> sbf_filter_counter' , 
									html: n<?= $category; ?>
								});

								s<?= $category; ?>.appendTo('#<?= $category; ?>');
							<?php endif; ?>
						</script>
							<?php
						endwhile;
					endif;
				endwhile;
				wp_reset_query();
				wp_reset_postdata();
				?>
								
				<?php 
				endif;
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



