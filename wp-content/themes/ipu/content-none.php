
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
	</aside>	

	<div class="content si_content si_content_faq eight_column">

		<section class="si_txt content_same_height">
 
			<div class="si_section_content">
				<div class="si_purpose">
 <div class="page-content">
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

	<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'twentyfourteen' ), admin_url( 'post-new.php' ) ); ?></p>

	<?php elseif ( is_search() ) : ?>

	<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'twentyfourteen' ); ?></p>
	<?php get_search_form(); ?>

	<?php else : ?>

	<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'twentyfourteen' ); ?></p>
	<?php get_search_form(); ?>

	<?php endif; ?>
</div><!-- .page-content -->
				</div>
 
 
			</div>
		</section>

	 
	</div>
</article>

<?php
get_footer();
