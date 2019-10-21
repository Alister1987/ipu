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

get_header(); ?>




 

<article id="content_wrapper">
		<aside class="sidebar sb_single_item two_column">
			 

		</aside>	

		<div class="content si_content eight_column">

			<section class="si_txt content_same_height">

				<div class="si_section_title">
					<h3><?php the_title;?></h3>
				</div>

				<div class="si_section_content">

				<div class="si_purpose">
				 <?php
	if ( is_front_page() && twentyfourteen_has_featured_posts() ) {
		// Include the featured content template.
		get_template_part( 'featured-content' );
	}

				// Start the Loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( 'content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				endwhile;
			?>
				</div>

		 
				</div>
			</section>

			<section class="grid_post content_same_height">
				<div class="g_section_title">
					<h3>Content...</h3>
					<div class="btn btn_action_maxmin btn_action_max" id="g_maximize">Maximize</div>
				</div>
				
				<div class="grid_wrapper">
 

					<div class="g_item gi_link">
						<div class="gi_data">
							<div class="gi_data_category">Guideline</div>
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
				</div>

			</section>
		</div>
	</article>



<?php
//get_sidebar();
get_footer();
