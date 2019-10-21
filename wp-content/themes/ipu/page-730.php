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
		$shortDesc = get_field('short_description', 730);
		?>
		<?php if(!empty($shortDesc)){?>
			<div class="sb_txt"><?= $shortDesc; ?></div>
		<?php } ?>
		<h3>Filter BY TYPE</h3>
		<div id="filters" class="sbf_filtergroup" data-group="type">
			<!--<div class="sbf_filter"><input type="checkbox" value=".item" id="item" class="all" ><label for="item">All</label></div>-->
			<div class="sbf_filter" id="claimingprocedures"><input type="checkbox" name="gi_claimingprocedures" value=".gi_claimingprocedures" id="gi_claimingprocedures"><label for="gi_claimingprocedures">Claiming Procedure</label></div>
			<div class="sbf_filter" id="feesinformationss"><input type="checkbox" name="gi_feesinformations" value=".gi_feesinformations" id="gi_feesinformations"><label for="gi_feesinformations">Fees Information</label></div>
			<div class="sbf_filter" id="hsecontractss"><input type="checkbox" name="gi_hsecontractss" value=".gi_hsecontractss" id="gi_hsecontractss"><label for="gi_hsecontractss">HSE Contracts</label></div>
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

				?>				
				
			<?php
				/*******************************
				 * category_hse_contact repeater 
				 ******************************/
			?>
			
			<?php
				$page = 'categoryhsecontact';
				$subpage = 'claimss';
				
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
								<?php if ($post_type == 'article') {  ?>
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
								<?php }  ?>

								<?php if ($post_type == 'faq') { ?>
									<div class="item g_item gi_faq gi_<?= $category; ?> <?= $post_type; ?>" data-time="<?= $date; ?>" data-category="<?= $post_type; ?>">
										<div class="gi_data">
											<div class="gi_data_category name" data-category="<?= $post_type; ?>"><?= $post_type; ?></div>
											<?php showCounter(); ?>
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
									<div class="item g_item gi_file gi_<?= $category; ?> <?= $post_type; ?>"  data-time="<?= $date; ?>" data-category="<?= $post_type; ?>" >
										<div class="gi_data_wrapper">		
											<div class="gi_data">
												<div class="gi_data_category name" data-category="<?= $post_type; ?>"><?= $post_type; ?></div>
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
									<div class="item g_item gi_guideline gi_<?= $category; ?> <?= $post_type; ?>"  data-time="<?= $date; ?>"  data-category="<?= $post_type; ?>">
										<div class="gi_data">
											<div class="gi_data_category name" data-category="<?= $post_type; ?>">Guideline</div>
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



