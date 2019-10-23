<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
get_header();
?>
<?php
$post_type = get_post_type();
?>


<style>
	.si_content .grid_post.fempi{width: 100%; background: transparent;}
</style>
<article id="content_wrapper">
<?php
/**
 * Left column
 * */
?>
<aside class="sidebar sb_single_item sb_single_article two_column">
 
 	
			<div class="sb_wrapper sb_wrapper_stickit">
		 		<?php
				//$customOrder = $_POST['phpvar'];
			//	print_r($_POST);
				$args = array(
					'posts_per_page' => 6,
					'post_type' => array('article'),
					'orderby' => 'date',
					'order' => 'DESC'
				);

				$shortDesc = get_field('short_description', 818);			
				?>
				<?php if(!empty($shortDesc)){?>
					<div class="sb_txt"><?= $shortDesc; ?></div>
				<?php } ?>
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
				$subpage = 'fempis';
				
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
			
						<?php if($display == 'yes') { ?>
						<?php
							//filter by category
							//*************
						?>
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
						<?php } ?>

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

<?php
//get_sidebar();
get_footer();
