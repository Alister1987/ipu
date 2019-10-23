<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage IPU
 * @since Twenty Fourteen 1.0
 */



get_header(); ?>

<style>
	.a-resources {width: 100%; margin-bottom: 20px;}
	.a-resources li {border: solid 1px #ccc; padding: 10px; width: 25%; display: inline; float: left; margin-right: 10px}
	
	#content{color: #000;}
</style>
<article id="content_wrapper">
	
	<?php while ( have_posts()) : the_post();
	$fields = get_fields(); 
	$title = $fields["title"];
	$shortDesc = $fields["short_description"];
	$desc = $fields["description"];
	$link = $fields["sop_link"];
	$date = get_the_date();
	$year = get_the_date("Y");
	$month = get_the_date("M");
	$day = get_the_date('d');
	$dateR = get_the_date('d m y');
	$purpose = get_field('purpose');
	$scope = get_field('scope');
	$responsibility = get_field('responsibility');
	$downloadSop  = wp_get_attachment_url(get_post_meta(get_the_ID(), 'files', true));
	$post_type = get_post_type();
	 
?>
		<aside class="sidebar sb_single_item two_column">
			<div class="sb_txt"><?= $shortDesc; ?> </div>
			<span class="sb_date"><?= $date; ?></span>	
			<a class="btn btn_si_download" href="<?= $downloadSop; ?>" title="Download this SOP">Download this SOP</a>
		 
		</aside>	

		<div class="content si_content si_single_sop eight_column">

			<section class="si_txt content_same_height">

				<div class="si_section_title">
					<h3><?=$post_type;?></h3>
					<div class="btn btn_action_maxmin btn_action_max" id="si_maximize">Maximize</div>
				</div>
				<div class="si_section_content">
 	 

						<div id="primary" class="content-area">
							<div id="content" class="site-content" role="main">
								<h2><?php the_title(); ?></h2> 
								<?php if($inline_image){?>			
								<p><img src="<?= $inline_image[0]; ?>" alt="<?php the_title(); ?>" /></p>
								<?php } ?>		
								
								
							</div><!-- #content -->
						</div><!-- #primary -->
	 
						
					<div class="si_purpose">	
						<?php if( $purpose ) { ?>
						<h4>Purpose</h4>
						<p><?= $purpose; ?></p>
							<?php } ?>
							<?php if( $scope ) { ?>
						<h4>Scope</h4>
						<p><?= $scope ?></p>
							<?php } ?>
							<?php if( $responsibility ) { ?>
						<h4>Responsibility</h4>
						<p><?= $responsibility; ?></p>
						<?php } ?>
					</div>
 
					<div class="si_descr">
					<?php
						if (have_rows('stages_of_procedure')):
							while (have_rows('stages_of_procedure')) : the_row(); ?>
							<h3><?= get_sub_field('stage_steps'); ?></h3>
							<p><?= get_sub_field('stage_content'); ?></p>
					<?php
							endwhile;
						endif;
					?>
					<p><?= $desc; ?></p>
					<?php get_sidebar( 'content' ); ?>
					</div>
				</div>
			</section>
<?php
			//<!--   -- - - - - ---- - -  ---------   -- - - - - ---- - -  -->
			//<!--   -- - - - - ---- - -  GRID POST   -- - - - - ---- - -  -->
			//<!--   -- - - - - ---- - -  ---------   -- - - - - ---- - -  -->
?>				
			<section class="grid_post content_same_height">
				<div class="g_section_title">
					<h3>Associated resources</h3>
					<div class="btn btn_action_maxmin btn_action_max" id="g_maximize">Maximize</div>
				</div>
			<div class="grid_wrapper associated-resources">
				<div id="container" class="grid_post">
			<?php
			$i = 0;
			if (have_rows('associated_resources')):
				while (have_rows('associated_resources')) : the_row();
					$priority = get_sub_field('priority');
					$year = get_the_date("Y");
					$month = get_the_date("M");
					$day = get_the_date('d');
					$dateR = get_the_date('d m y');
						?>
						<?php if($i++ != 1){ ?>
						<?php if ($priority): ?>
							<?php include 'common/associaded_resources.php'; ?>
						<?php endif; ?>
						<?php } ?>
				<?php endwhile; ?>
			<?php endif; ?>
			<?php
				wp_reset_query();
				wp_reset_postdata();
			?>	
				</div>
				</div>
			</section>
		</div>	
<?php endwhile; ?>
<?php
	wp_reset_query();
	wp_reset_postdata();
?>
	</article>
	</div><!-- #content -->
	</div><!-- #primary -->
	
<script>
	 var n = $( ".grid_wrapper .g_item" ).length;	
	 console.log(n);
	 if (n < 1){
		$('#content_wrapper').addClass('no_grid');
	 }
</script>


<?php
get_footer();
