<?php
/**
 * The Template for SOP AND guideline
 *
 * @package WordPress
 * @subpackage IPU
 * @since Twenty Fourteen 1.0
 */
get_header(); ?>
<?php
  //$order = "&order=ASC";
//  if ($_POST['select'] == 'title') { $order = "title";  }
//  if ($_POST['select'] == 'date') { $order = "post_date";  }
//  if ($_POST['select'] == 'popular') { $order = "rand";  }
?>
<style>
 
.option-set li{color: black; float:left; display:inline; padding: 15px}
.option-set li a{color: black;  margin-right: 20px; font-size: 14px}

#filters .sbf_filter input{
	display: none;
}
#filters .sbf_filter label{
	padding: 10px 161px 10px 0px;
}

</style>
<article id="content_wrapper">
		<aside class="sidebar sb_filters two_column">
		<?php
				//$customOrder = $_POST['phpvar'];
			//	print_r($_POST);
					$args = array(
						'posts_per_page' => -1,
						'post_type' => array('sop', 'article', 'faq', 'file', 'guideline'),
						'orderby' => 'date',
						'order' => 'ASC'
					);
					
					//print_r($args);
			?>
			<p class="sb_txt"> <?=  get_field('short_description', 89);?></p>
			<h3>Filter BY</h3>
			
			
			
			<div id="filters" class="sbf_filtergroup" data-group="filter">
				<div class="sbf_filter sbf_filter_active"><input type="checkbox" value=".item" id="item" class="all"><label for="item">All</label></div>
				<div class="sbf_filter" id="article"> <input type="checkbox" name="gi_article" value=".gi_article" id="gi_article"><label for="gi_article">Article</label></div>
				<div class="sbf_filter" id="faq"> <input type="checkbox" name="gi_faq" value=".gi_faq" id="gi_faq"><label for="gi_faq">Faq</label></div>
				<div class="sbf_filter" id="file"> <input type="checkbox" name="gi_file" value=".gi_file" id="gi_file"><label for="gi_file">File</label></div>
				<div class="sbf_filter" id="guideline"> <input type="checkbox" name="gi_guideline" value=".gi_guideline" id="gi_guideline"><label for="gi_guideline">Guideline</label></div>
				<div class="sbf_filter" id="sop"> <input type="checkbox" name="gi_sop" value=".gi_sop" id="gi_sop"><label for="gi_sop">Sop</label></div> 					 
			</div>
			
			
			
<!--			<div id="filters" class="sbf_filtergroup" data-group="filter">
				<div class="sbf_filter"><input type="checkbox" value=".item" id="item" class="all" ><label for="item">All</label></div>
				<?php
				$count = 0;
					$args1 = array(
						'posts_per_page' => -1,
						'post_type' => array( 'article', 'sop', 'faq', 'file', 'guideline'),
						'orderby' => 'meta_value',
						'order' => 'DESC'
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
						
				?>	

				
					<div class="sbf_filter" id="<?= $post_type; ?>" class="<?= $post_type; ?>"> <input type="checkbox" name="gi_<?= $post_type; ?>" value=".gi_<?= $post_type; ?>" id="gi_<?= $post_type; ?>"><label for="gi_<?= $post_type; ?>"><?= $post_type; ?></label></div>
			 
				<?php 
					$count++;
				endwhile; ?>
				<?php
				wp_reset_query();
				wp_reset_postdata();
				?> 
			</div>			-->
		</aside>	
		<section class="content lp_content eight_column">
		 
 
<div class="sort">
	<div class="btn_sort_wrapper">
		<span>Sort by</span>
		<div class="btn_sort_group">
			<div class="btn btn_sort org btn_sort_selected">Date</div>
			<div class="btn btn_sort rand">Random</div>
			<!--<div class="btn btn_sort name">Name</div>-->
		</div>
	</div>
</div>
	 
				<div id="container" class="grid_post" >
					<?php
			//	$count = 1;
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
						$date = get_the_date("dmY");
						
						?>		

					
					<?php if($post_type == 'article') { ?>
						<div class="item g_item gi_article date" data-option-value="<?= $date; ?>" data-category="<?= $post_type; ?>">
							<div class="gi_cover_picture"></div>
							<div class="gi_data_wrapper">		
								<div class="gi_data_sidebar">
									<div class="gi_data_date">
										<span class="gi_data_day"><?= get_the_date("d"); ?></span>
										<span class="gi_data_month"><?= get_the_date("M"); ?></span>
									</div>	
								</div>			
								<div class="gi_data">
									<div class="gi_data_category"><?= $post_type; ?></div>
									<div class="gi_data_number">42</div>
									<h4 class="gi_title">
										<?= $title; ?>
									</h4>	
									<span class="gi_author">
										By <?= get_field('author'); ?>
									</span>				
								</div>
							</div>
							<div class="gi_content">
								<span class="gi_content_txt">
								<?= $shortDesc; ?>
								</span>
							</div>	
							<a href="<?= $viewLink; ?>" class="gi_btn" title="<?= $categorylbl; ?> - view">View</a>	
						</div>
					<?php } ?>
					
					<?php if($post_type == 'faq') { ?>
						<div class="item g_item gi_faq " data-time="<?= $date; ?>" data-category="<?= $post_type; ?>">
							<div class="gi_data">
								<div class="gi_data_category" data-category="<?= $post_type; ?>"><?= $post_type; ?></div>
								<div class="gi_data_number">42</div>
								<span class="gi_data_date"><?= get_the_date("d M y"); ?></span>
							</div>
							<h4 class="gi_title">
							<?= $title; ?>
							</h4>
							<div class="gi_content">
								<span class="gi_content_txt"><?= $shortDesc; ?></span>
							</div>	
							<a href="<?= $viewLink; ?>" class="gi_btn" title="<?= $title; ?> - read">Read</a>			
						</div>
					<?php } ?>
					
					<?php if($post_type == 'file') { ?>
						<div class="item g_item gi_file"  data-time="<?= $date; ?>" data-category="<?= $post_type; ?>" >
							<div class="gi_data_wrapper">		
								<div class="gi_data">
									<div class="gi_data_category" data-category="<?= $post_type; ?>"><?= $post_type; ?></div>
									<span class="gi_data_date"><?= get_the_date("d M y"); ?></span>
									<h4 class="gi_title">
								<?= $title; ?>
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
							<a href="<?= $viewLink; ?>" class="gi_btn" title="<?= $title; ?> - read">Download</a>		
						</div>
					<?php } ?>
					
					
					<?php if($post_type == 'sop') { ?>
						<div class="item brick g_item gi_sop" data-state="move"  data-time="<?= $date; ?>"  data-category="<?= $post_type; ?>">
							<div class="gi_data">
								<div class="gi_data_category" data-category="<?= $post_type; ?>"><?= $post_type; ?></div>
								<span class="gi_data_date"><?= get_the_date("d M y"); ?></span>
							</div>
							<h4 class="gi_title">
							<?= $title; ?>
							</h4>
<!--							<div class="gi_content_picture"></div>-->
							<div class="gi_content">
								<p class="gi_content_title">Purpose</p>
								<span class="gi_content_txt">
								<?= $shortDesc; ?>
								</span>
								<p class="gi_content_title">Scope</p>
								<span class="gi_content_txt">
								<?= $shortDesc; ?>
								</span>
							</div>	
							<a href="<?= $viewLink; ?>" class="gi_btn" title="<?= $categorylbl; ?> - read">Read</a>

						</div>
					<?php } ?>

					
					<?php if($post_type == 'guideline') { ?>
					<div class="item g_item gi_link"  data-time="<?= $date; ?>"  data-category="<?= $post_type; ?>">
						<div class="gi_data">
							<div class="gi_data_category" data-category="<?= $post_type; ?>">Guideline</div>
							<span class="gi_data_date"><?= $dateR; ?></span>
						</div>
						<h4 class="gi_title">
						Standard Operating Procedure for Dealing with the Receipt of Medicinal Products Requiring Refrigeration.
						</h4>
						<div class="gi_content">
							<span class="gi_content_txt">
							Set a standardised protocol of procedures for dealing with the receipt of medicinal products requiring refrigeration.
							</span>
						</div>	
						<a href="#" class="gi_btn">www.hse.ie</a>

					</div>
					<?php } ?>
					<?php  endwhile; ?>
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
						?>	

						<?php if($post_type): ?>
							var n<?= $post_type; ?> = $(container + ' .gi_<?= $post_type; ?>').length;

							var s<?= $post_type; ?> = $('<span />',{
								class:'<?= $post_type; ?> sbf_filter_counter' , 
								html: n<?= $post_type; ?>
							});

							s<?= $post_type; ?>.appendTo('#<?= $post_type; ?>');
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
	 
	</section>
	</article>
<?php

get_footer();
