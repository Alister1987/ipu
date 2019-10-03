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

$id = get_the_ID();
$shortDesc = get_field('short_description', $id);
?>
 
<article id="content_wrapper" class="<?=$id;?>">
		<aside class="sidebar sb_single_item two_column">
			<?php if(!empty($shortDesc)){?>
				<div class="sb_txt"><?= $shortDesc; ?></div>
			<?php } ?>
		</aside>		

	<div class="content lp_content eight_column blank_page">
		
			<div class="box_wrapper box_w_green box_huge box_only">	
				<div class="box_inside">	
<!--					<h4>Hoy I'm the subtitle</h4>-->
				 
					 
						
				<?php while ( have_posts()) : the_post();
						$fields = get_fields(); 
					?>		

					<h3><?php the_title();?></h3>
					<div class="box_content">
						<?php the_content(); ?>
					</div>	
					
					<?php endwhile; ?>

					<?php
						wp_reset_query();
						wp_reset_postdata();
					?>
					
					
					
					   <?php
//						if (is_front_page() && twentyfourteen_has_featured_posfts()) {
//							// Include the featured content template.
//							get_template_part('featured-content');
//						}
//
//						// Start the Loop.
//						while (have_posts()) : the_post();
//
//							// Include the page content template.
//							get_template_part('content', 'page');
//
//							// If comments are open or we have at least one comment, load up the comment template.
//							if (comments_open() || get_comments_number()) {
//								comments_template();
//							}
//						endwhile;
						?>

					</div>
				</div>
			</div>

				
		</div>
	 
	</article>



<?php
//get_sidebar();
get_footer();
