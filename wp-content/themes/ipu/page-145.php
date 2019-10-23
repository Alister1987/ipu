<?php
/**
 Template Name: New Contract Landing [145]
 * Template for Home - Dashboard
 *
 * @package WordPress
 * @subpackage IPU
 * @since Twenty Fourteen 1.0
 */
get_header();

$current_user = wp_get_current_user();
$url = get_field('avatar', 'user_'.$current_user->ID);
$profile_img = $url['url'];
$bio = get_field('bio', 'user_'.$current_user->ID);

?>

<style>
	.a-resources {width: 100%; margin-bottom: 20px;}
	.a-resources li {border: solid 1px #ccc; padding: 10px; width: 25%; display: inline; float: left; margin-right: 10px}

	.left{
		position: absolute;
		left: 0px;
		width: 240px;
		color: white;
		z-index: 1000;
	}
	.last-entry li{background-color: #222;
				   border: solid 1px;
				   margin-right: 20px;}
	</style>
	<article id="content_wrapper">
	<aside class="sidebar two_column">
		<?php
		/*******************************
		 *			Left Col
		 *******************************/
		?>

		<div class="sb_txt">
			<?php while (have_posts()): the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; ?>
		</div>

	</aside>
	<div class="content lp_content eight_column">
		<div class="box_wrapper box_w_green box_huge box_two_column">
		<div class="box_inside">
			<h3>
				<?php echo get_field('new_contract_title'); ?>
			</h3>
			<div class="box_content">
				<?php echo get_field('new_contract_text'); ?>
			</div>
		</div>
		</div>
	</div>
</article>
<?php
get_footer();
