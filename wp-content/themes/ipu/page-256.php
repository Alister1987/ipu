<?php
/**
 * The Template for LEGISLATION page
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
/* End: Recommended Isotope styles */

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
					
		$shortDesc = get_field('short_description', 256);			
		?>
		<?php if(!empty($shortDesc)){?>
			<div class="sb_txt"><?= $shortDesc; ?></div>
		<?php } ?>
			<h3>Filter BY TYPE</h3>
<!--			
			<div id="filters" class="sbf_filtergroup" data-group="filter">
				<!--<div class="sbf_filter"><input type="checkbox" value=".item" id="item" class="all" ><label for="item">All</label></div>-->
				<?php
					$args1 = array(
						'posts_per_page' => 5,
						'post_type' => array( 'article', 'faq', 'file', 'guideline', 'sop'),
						'orderby' => 'meta_value',
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
				?>	

				<?php if($post_type):?>
					<div class="sbf_filter" id="<?= $post_type; ?>"> <input type="checkbox" name="gi_<?= $post_type; ?>" value=".gi_<?= $post_type; ?>" id="gi_<?= $post_type; ?>"><label for="gi_<?= $post_type; ?>"><?= $post_type; ?></label></div>
				<?php  endif; ?>


				<?php  endwhile; ?>
				<?php
				wp_reset_query();
				wp_reset_postdata();
				?>

								<div class="sbf_filter"><span id="allEntry">All</span></div>
					<div class="sbf_filter" id="dispensary"><input type="checkbox" name="gi_article" value=".gi_article" id="gi_article" style=" "><label for="gi_article">article</label></div>
					<div class="sbf_filter" id="faq"> <input type="checkbox" name="gi_faq" value=".gi_faq" id="gi_faq"  style=" "><label for="gi_faq">faq</label></div>
					<div class="sbf_filter" id="sop"> <input type="checkbox" name="gi_sop" value=".gi_sop" id="gi_sop" style=" "><label for="gi_sop">sop</label></div>
					<div class="sbf_filter" id="files"> <input type="checkbox" name="gi_file" value=".gi_file" id="gi_file" style=" "><label for="gi_file">files</label></div>
					<div class="sbf_filter" id="guidlines"> <input type="checkbox" name="gi_guidlines" value=".gi_guidlines" id="gi_guidlines" style=" "><label for="gi_guidlines">Guidlines</label></div>	 
			</div>
			-->
			
			<div id="filters" class="sbf_filtergroup" data-group="filter">
				<div class="sbf_filter"><input type="checkbox" value=".item" id="item" class="all"><label for="item">All</label></div>
				<div class="sbf_filter sbf_filter_active" id="article"> <input type="checkbox" name="gi_article" value=".gi_article" id="gi_article"><label for="gi_article">Article</label></div>
				<div class="sbf_filter" id="faq"> <input type="checkbox" name="gi_faq" value=".gi_faq" id="gi_faq"><label for="gi_faq">Faq</label></div>
				<div class="sbf_filter" id="file"> <input type="checkbox" name="gi_file" value=".gi_file" id="gi_file"><label for="gi_file">File</label></div>
				<div class="sbf_filter" id="guideline"> <input type="checkbox" name="gi_guideline" value=".gi_guideline" id="gi_guideline"><label for="gi_guideline">Guideline</label></div>
				<div class="sbf_filter" id="sop"> <input type="checkbox" name="gi_sop" value=".gi_sop" id="gi_sop"><label for="gi_sop">Sop</label></div> 					 
			</div>
		</aside>	
	 
				
 

	<section class="content lp_content eight_column">
		<div class="furst">
			<div class="box_wrapper box_w_blue box_huge box_two_column">	
				<div class="box_inside">	
					<?php
					while (have_posts()) : the_post();
						$fields = get_fields();
						$title = $fields["title"];
						$content = $fields["content"];
						?>
						<h3><?php the_title(); ?></h3>

						<div class="box_content">
							<?php the_content(); ?>
						</div>
					<?php endwhile; ?>
					<?php
					wp_reset_query();
					wp_reset_postdata();
					?>		
				</div>
			</div>
		</div>
		
		<div class="sort">
			<div class="btn_sort_wrapper">
				<span>Sort by</span>
				<?php include_once 'common/sortby.php'; ?>
			</div>
		</div>
		<div class="grid_wrapper">
		<div id="container" class="grid_post">
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
				$page = 'categoryprofessional';
				$subpage = 'legislations';
				
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
							<?php if($post_type): ?>
								var n<?= $post_type; ?> = $('#container' + ' .gi_<?= $post_type; ?>').length;

								var s<?= $post_type; ?> = $('<span />',{
									class:'<?= $post_type; ?> sbf_filter_counter' , 
									html: n<?= $post_type; ?>
								});

								s<?= $post_type; ?>.appendTo('#<?= $post_type; ?>');
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

