<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
$id = get_the_ID();
	$shortDesc = get_field('short_description', $id);

?>
 

<article id="content_wrapper" class="<?=$id;?>">
		<aside class="sidebar sb_single_item two_column">
			<?php if(!empty($shortDesc)){?>
				<div class="sb_txt"><?= $shortDesc; ?></div>
			<?php } ?>
			
		</aside>	

		<div class="content si_content eight_column">

			<section class="si_txt content_same_height">

				<div class="si_section_title">
					<h3><?php the_title;?></h3>
					<div class="btn btn_action_maxmin btn_action_max" id="si_maximize">Maximize</div>
				</div>

				<div class="si_section_content">

				<div class="si_purpose">
 
	<?php if ( is_search() ) : ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php
			the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyfourteen' ) );
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfourteen' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<?php the_tags( '<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>' ); ?>
				</div>

		 
				</div>
			</section>

			<section class="grid_post content_same_height">
				<div class="g_section_title">
					<h3>Associated resources</h3>
					<div class="btn btn_action_maxmin btn_action_max" id="g_maximize">Maximize</div>
				</div>
				
				<div class="grid_wrapper">
					<div class="g_item gi_sop">
						<div class="gi_data">
							<div class="gi_data_category">Article</div>
							<span class="gi_data_date"><?= $dateR; ?></span>
						</div>
						<h4 class="gi_title">
						Standard Operating Procedure for Dealing with the Receipt of Medicinal Products Requiring Refrigeration.
						</h4>
<!--						<div class="gi_content_picture"></div>-->
						<div class="gi_content">
							<p class="gi_content_title">Purpose</p>
							<span class="gi_content_txt">
							Set a standardised protocol of procedures for dealing with the receipt of medicinal products requiring refrigeration.
							</span>
							<p class="gi_content_title">Scope</p>
							<span class="gi_content_txt">
							Covers the receipt of all medicinal products requiring refrigeration within a retail pharmacy business.
							</span>
						</div>	
						<a href="#" class="gi_btn">Read</a>
						
					</div>

 		
				</div>

			</section>
		</div>
	</article>


 


 
