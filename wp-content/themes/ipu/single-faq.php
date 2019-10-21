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
<article id="content_wrapper">
<?php
/**
 * Left column
 * */
?>
	
<aside class="sidebar sb_single_item sb_single_article two_column">
<?php
while (have_posts()) : the_post();
	$fields = get_fields();

	$title = $fields["title"];
	$shortDesc = $fields["short_description"];
	$date = $dateR = get_the_date('d M Y');
	$author_id = get_the_author_meta('ID');
	$author_role = get_field('user_role', 'user_' . $author_id);
	$downloadFAQ  = wp_get_attachment_url(get_post_meta(get_the_ID(), 'files', true));
	?>		
			<div class="sb_wrapper sb_wrapper_stickit">


				<div class="sb_txt"><?= $shortDesc; ?> </div>
				<span class="sb_date"><?= $date; ?></span>
			</div>
		<?php endwhile; ?>

		<?php
		wp_reset_query();
		wp_reset_postdata();
		?>

		<a class="btn btn_si_download" target="_blank" href="<?= $downloadFAQ; ?>" title="Download this FAQ">Download this FAQ</a>
	</aside>	

	<div class="content si_content si_content_faq eight_column">

		<section class="si_txt content_same_height">
			<div class="si_section_title">
				<h3><?= $post_type; ?></h3>
				<div class="btn btn_action_maxmin btn_action_max" id="si_maximize">Maximize</div>
			</div>
			<div class="si_section_content">
				<div class="si_purpose">
					<?php
					while (have_posts()) : the_post();
						$fields = get_fields();

						$title = $fields["title"];
						$shortDesc = $fields["short_description"];
						$desc = $fields["description"];

						$image_id = get_post_thumbnail_id();
						$image_url = wp_get_attachment_image_src($image_id, 'large', true);
						$inline_image = wp_get_attachment_image_src(get_field('picture'), 'medium');
						?>		 

						<div id="primary" class="content-area">
							<div id="content" class="site-content" role="main">
								<h2><?php the_title(); ?></h2> 
								<?php if($inline_image){?>			
								<p><img src="<?= $inline_image[0]; ?>" alt="<?php the_title(); ?>" /></p>
								<?php } ?>		
							</div><!-- #content -->
						</div><!-- #primary -->
					<?php endwhile; ?>
					<?php
					wp_reset_query();
					wp_reset_postdata();
					?>
				</div>

				<div class="si_summary">
					<h4>Summary</h4>

					<ul>
						<?php
						if (have_rows('content')):
							while (have_rows('content')) : the_row();
								$title = get_sub_field('title');
								?>
								<li><a href="#<?= $title; ?>"><?= $title; ?></a></li>

							<?php endwhile; ?>
						<?php endif; ?>
						<?php
						wp_reset_query();
						wp_reset_postdata();
						?>
					</ul>
				</div>

				<div class="si_descr" id="si_descr_faq">
					<?php
					if (have_rows('content')):
						while (have_rows('content')) : the_row();
							$title = get_sub_field('title');
							$paragraph = get_sub_field('paragraph');
							?>
							<span class="sia_txt_section" id="<?= $title; ?>">
								<h4><b>Q</b> <?= $title; ?></h4>
								<?= $paragraph; ?>
							</span>
						<?php endwhile; ?>
					<?php endif; ?>
					<?php
					wp_reset_query();
					wp_reset_postdata();
					?>
					<?php get_sidebar( 'content' ); ?>
				</div>
			</div>
		</section>

		<section class="grid_post content_same_height">
			<div class="g_section_title">
				<h3>Associated resources</h3>
				<div class="btn btn_action_maxmin btn_action_max" id="g_maximize">Maximize</div>
			</div>

			<div class="grid_wrapper associated-resources">
				<div id="container" class="grid_post">
				<?php
				$i = 0;
				if (have_rows('related_documents')):
					while (have_rows('related_documents')) : the_row();
						$priority = get_sub_field('documents');
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
</article>
<script>
	//to do
	var n = $( ".grid_wrapper .g_item" ).length;	
	 console.log(n);
	  if (n < 1){
		$('#content_wrapper').addClass('no_grid');
	 }
</script>
<?php
get_footer();
