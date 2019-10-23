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
				'post_type' => array( 'article', 'faq', 'file', 'guideline'),
				'orderby' => 'date',
				'order' => 'ASC'
			);
		$shortDesc = get_field('short_description', 733);			
		?>
		<?php if(!empty($shortDesc)){?>
			<div class="sb_txt"><?= $shortDesc; ?></div>
		<?php } ?>
		
		<h3><?php echo get_option( 'dropdown_text_name' )?></h3>
		<div id="filters" class="sbf_filtergroup" data-group="type">
			<!--<div class="sbf_filter"><input type="checkbox" value=".item" id="item" class="all" ><label for="item">All</label></div>-->
			<div class="sbf_filter" id="dentaltreatmentschemes"><input type="checkbox" name="gi_dentaltreatmentschemes" value=".gi_dentaltreatmentschemes" id="gi_dentaltreatmentschemes"><label for="gi_dentaltreatmentschemes">Dental Treatment Scheme</label></div>
			<div class="sbf_filter" id="doctorvisitcards"><input type="checkbox" name="gi_doctorvisitcards" value=".gi_doctorvisitcards" id="gi_doctorvisitcards"><label for="gi_doctorvisitcards">Doctor Visit Card</label></div>
			<div class="sbf_filter" id="dpss"><input type="checkbox" name="gi_dpss" value=".gi_dpss" id="gi_dps"><label for="gi_dpss">DPS</label></div>
			<div class="sbf_filter" id="eeaentitlementss"><input type="checkbox" name="gi_eeaentitlementss" value=".gi_eeaentitlementss" id="gi_eeaentitlementss"><label for="gi_eeaentitlementss">EEA Entitlements</label></div>
			<div class="sbf_filter" id="fluvaccinationschemes"><input type="checkbox" name="gi_fluvaccinationschemes" value=".gi_fluvaccinationschemes" id="gi_fluvaccinationschemes"><label for="gi_fluvaccinationschemes">Flu Vaccination Scheme</label></div>
			<div class="sbf_filter" id="gmss"><input type="checkbox" name="gi_gmss" value=".gi_gmss" id="gi_gmss"><label for="gi_gmss">GMS</label></div>
			<div class="sbf_filter" id="healthamendments"><input type="checkbox" name="gi_healthamendments" value=".gi_healthamendment" id="gi_healthamendments"><label for="gi_healthamendments">Health Amendment Act Scheme</label></div>
			<div class="sbf_filter" id="drugsschemes"><input type="checkbox" name="gi_drugsschemes" value=".gi_drugsschemes" id="gi_drugsschemes"><label for="gi_drugsschemes">High-Tech Drugs Scheme</label></div>
			<div class="sbf_filter" id="hospitalemergencys"><input type="checkbox" name="gi_hospitalemergencys" value=".gi_hospitalemergencys" id="gi_hospitalemergencys"><label for="gi_hospitalemergencys">Hospital Emergency Scheme</label></div>
			<div class="sbf_filter" id="ltischemes"><input type="checkbox" name="gi_ltischemes" value=".gi_ltischemes" id="gi_ltischemes"><label for="gi_ltischemes">LTI Scheme</label></div>
			<div class="sbf_filter" id="methadonetreatments"><input type="checkbox" name="gi_methadonetreatments" value=".gi_methadonetreatments" id="gi_methadonetreatments"><label for="gi_methadonetreatments">Methadone Treatment Scheme</label></div>
			<div class="sbf_filter" id="nexs"><input type="checkbox" name="gi_nexs" value=".gi_nexs" id="gi_nexs"><label for="gi_nexs">NEX</label></div>
			<div class="sbf_filter" id="preferreddrugss"><input type="checkbox" name="gi_preferreddrugss" value=".gi_preferreddrugss" id="gi_preferreddrugss"><label for="gi_preferreddrugss">Preferred Drugs Initiative</label></div>		
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
				$subpage = 'schemess';
				
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
												<?php showCounter(); ?>
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



