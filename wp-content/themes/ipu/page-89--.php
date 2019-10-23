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
						'post_type' => array('sop', 'guideline'),
						'orderby' => 'date',
						'order' => 'ASC'
					);
			?>
			<p class="sb_txt"><?= get_field('short_description', 89);?></p>
			<h3>Filter BY Type</h3>
				<div id="filters" class="sbf_filtergroup" data-group="type">
					<div class="sbf_filter"><input type="checkbox" value=".item" id="item" class="all" ><label for="item">All</label></div>
					<div class="sbf_filter" id="dispensary"><input type="checkbox" name="gi_dispensary" value=".gi_dispensary" id="gi_dispensary"><label for="gi_dispensary">Dispensary</label></div>
					<div class="sbf_filter" id="elderly"><input type="checkbox" name="gi_elderly" value=".gi_elderly" id="gi_elderly"><label for="gi_elderly">Elderly</label></div>
					<div class="sbf_filter" id="healthscreening"><input type="checkbox" name="gi_healthscreening" value=".gi_healthscreening" id="gi_healthscreening"><label for="gi_healthscreening">Health screening</label></div>
					<div class="sbf_filter" id="inspection"><input type="checkbox" name="gi_inspection" value=".gi_inspection" id="gi_inspection"><label for="gi_inspection">Inspection</label></div>
					<div class="sbf_filter" id="legislation"><input type="checkbox" name="gi_legislation" value=".gi_legislation" id="gi_legislation"><label for="gi_legislation">Legislation</label></div>
					<div class="sbf_filter" id="training"><input type="checkbox" name="gi_training" value=".gi_training" id="gi_training"><label for="gi_training">Training</label></div>
					<div class="sbf_filter" id="paediatrics"><input type="checkbox" name="gi_paediatrics" value=".gi_paediatrics" id="gi_paediatrics"><label for="gi_paediatrics">Paediatrics</label></div>
					<div class="sbf_filter" id="psi"><input type="checkbox" name="gi_psi" value=".gi_psi" id="gi_psi"><label for="gi_psi">PSI</label></div>
					<div class="sbf_filter" id="retailstore"><input type="checkbox" name="gi_retailstore" value=".gi_retailstore" id="gi_retailstore"><label for="gi_retailstore">Retail store</label></div>
					<div class="sbf_filter" id="vaccinations"><input type="checkbox" name="gi_vaccinations" value=".gi_vaccinations" id="gi_vaccinations"><label for="gi_vaccinations">Vaccinations</label></div>
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
					$i=0;
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
							$viewLink = $fields["sop_link"];
							$post_type = get_post_type();
							
							$purpose = $fields["purpose"];
							$scope = $fields["scope"];
							$responsibility = $fields["responsibility"];
	
							
					?>		
					
					<?php if ($post_type == 'guideline'){ ?>
						<div class="brick item g_item gi_guideline gi_<?=$categorytxt[0];?>" data-state="move" data-cat="<?=$categorytxt[0];?>">
							<div class="gi_data">
								<div class="gi_data_category"><?= $post_type; ?></div>
								<span class="gi_data_date"><?= get_the_date("d M y"); ?></span>
							</div>
							<h4 class="gi_title ">
								<?php the_title();?>
							</h4>
<!--							 <div class="number"><?= $post_type; ?> <?= $i; ?></div>-->
<!--							<div class="gi_content_picture"></div>-->
							<div class="gi_content">
<!--								<p class="gi_content_title"><?php the_title();?></p>-->
								<span class="gi_content_txt">
									<?= $shortDesc; ?>
								</span>
							</div>	
							<a href="<?= get_permalink(); ?>" class="gi_btn" title="<?= $categorylbl; ?> - read">Read</a>
						</div>
					<?php } ?>
					
					
					<?php if ($post_type == 'sop'){ ?>
					<div class="brick item g_item gi_sop gi_<?=$categorytxt[0];?>" data-state="move" data-cat="<?=$categorytxt[0];?>">
							<div class="gi_data">
								<div class="gi_data_category"><?= $post_type; ?></div>
								<span class="gi_data_date"><?= get_the_date("d M y"); ?></span>
							</div>
							<h4 class="gi_title ">
							<?php the_title();?>
							</h4>
<!--					 <div class="number"><?= $post_type; $i; ?> <?= $i; ?></div>-->
<!--							<div class="gi_content_picture"></div>-->
							<div class="gi_content">								
								<?php if( $purpose ) { ?>
									<p class="gi_content_title">Purpose</p>
									<span class="gi_content_txt"><?= $purpose; ?></span>
								<?php } ?>
								<?php if( $scope ) { ?>
									<p class="gi_content_title">Scope</p>
									<span class="gi_content_txt"><?= $scope ?></span>
								<?php } ?>
								<?php if( $responsibility ) { ?>
									<p class="gi_content_title">Responsibility</p>
									<span class="gi_content_txt"><?= $responsibility; ?></span>
								<?php } ?>
							</div>	
							<a href="<?= get_permalink(); ?>" class="gi_btn" title="<?= $categorylbl; ?> - read">Read</a>
						</div>
					<?php } ?>
					
					<?php $i++; ?>
					<?php endwhile; ?>
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
							$query = new WP_Query($args);
							while ($query->have_posts()) :
							$query->the_post();
							$post_type = get_post_type();
							$fields = get_fields();
							$title = $fields["title"];
							$categorytxt = $fields["category"];
						?>	
						<?php if($categorytxt[0]): ?>
							var n<?= $categorytxt[0]; ?> = $(container + ' .gi_<?= $categorytxt[0]; ?>').length;

							var s<?= $categorytxt[0]; ?> = $('<span />',{
								class:'<?= $categorytxt[0]; ?> sbf_filter_counter' , 
								html: n<?= $categorytxt[0]; ?>
							});

							s<?= $categorytxt[0]; ?>.appendTo('#<?= $categorytxt[0]; ?>');
						<?php endif; ?>
						<?php endwhile; ?>

						<?php
							wp_reset_query();
							wp_reset_postdata();
						?>	
						
						//move-
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
