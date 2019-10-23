<?php
/**
 * Template for Comm - Dashboard
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
		<h3>Latest Activities</h3>
		<div class="sb_txt">
			<?php while (have_posts()): the_post(); ?>	
				<?php the_content(); ?>
			<?php endwhile; ?>
		</div>

		<?php if(get_field('read_more')) {?>
		<h3>Read More</h3>
		<div class="sb_txt">
			<?php echo get_field('read_more'); ?>
		</div>
		<?php } ?>

	</aside>	
	<div class="content lp_content eight_column">
		<section class="lp_timeline">


			<?php
			$args = array(
				'posts_per_page' => -1,
				'post_type' => getIPUResourcesList(),
				'orderby' => 'modified',
				'order' => 'DESC',
                'meta_query' => array(
                    array(
                        'key' => 'ipu_section',
                        'value' => get_the_ID(),
                        'compare' => '='
                    )
                )
			);
			?>
			<?php
			$query = new WP_Query($args);
			while ($query->have_posts()) :
				$query->the_post();
				$fields = get_fields();
				$title_content = $fields["title"];
                if(!$title_content) $title_content = get_the_title();
				$content = $fields["short_description"];
				$files = $fields["files"];
				//$main_user = $fields["main_user"];
				$type = get_post_type();
				$id = $myPost->post_date;
				$attachment_id = get_field('files');
				$post_type = get_post_type();
				$file_url = wp_get_attachment_url($attachment_id);
				$file_title = get_the_title($attachment_id);
				$filetype = wp_check_filetype($file_title);
				$newfilename = wp_unique_filename($file_url, $file_title);
				?>
				<?php if (($type == "sop") || ($type == "article") || ($type == "faq") || ($type == "file")) { ?>
							
						<div class="tl_item_wrapper">
							<div class="tl_item tl_item_<?= $type; ?> tl_item_new">
								<div class="tl_date">
									<span class="tl_day"><?= get_the_date("d", $id); ?></span>
									<span class="tl_month"><?= get_the_date("M", $id); ?></span>
								</div>	
								<div class="tl_iconbar">
									<span class="icon"></span>
								</div>	
								
								<a href="<?= get_permalink(); ?>" title="<?= $title_content; ?>">
									<div class="tl_txt">
										<div class="gi_data_category_wrapper">
											<div class="gi_data_category"><?= $post_type; ?></div>
										</div>									
										<h4><?= $title_content; ?></h4>
										<p><?= $content; ?>
										</p>
<!--										<span class="btn_tl">Read</span>-->
									</div>	
								</a>						
							</div>
						</div>

					
				<?php }
				?>
			<?php endwhile; ?>
			<?php
				wp_reset_query();
				wp_reset_postdata();
			?>		
			<div class="btn btn_grey btn_action_go loadMore">Load more</div>
		</section>


		<section class="lp_sidebar">
			<?php include 'common/section_admin.php' ;?>	
		</section>

		
	</div>
</article>
<?php
get_footer();
