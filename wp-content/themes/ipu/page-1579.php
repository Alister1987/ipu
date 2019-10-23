<?php
/**
 * The Template for ABOUT IPU - GENERAL INFORMATION
 *
 * @package WordPress
 * @subpackage IPU
 * @since Twenty Fourteen 1.0
 */
get_header();
?>

<article id="content_wrapper">
	<aside class="sidebar two_column sb_mk_about">


		<?php
		/*		 * **********************************
		 * 			LEFT COLUMN
		 * ********************************** */
		$repeater = 'left_column';
		$button = 'button';

		if (get_field($repeater)):
			while (have_rows($repeater)) : the_row();
				$title = get_sub_field('title');
				$description = get_sub_field('description');
				?>
				<div class="sb_wrapper sb_wrapper_stickit">
					<h3><?= $title; ?></h3>		
					<div class="sb_txt"><?= $description; ?></div>

					<?php
					if (have_rows($button)):
						while (have_rows($button)) : the_row();
							$title = get_sub_field('title');
							$attachment_id = get_sub_field('file');
							$file_url = wp_get_attachment_url($attachment_id);
							$file_title = get_the_title($attachment_id);
							?>
							<a href="<?= $file_url; ?>" target="_blank" class="btn btn_action_dowload_green" title="<?= $title; ?>"><?= $title; ?></a>

							<?php
						endwhile;
					endif;
					wp_reset_query();
					wp_reset_postdata();
					?>
				</div>


				<?php
			endwhile;
		endif;

		wp_reset_query();
		wp_reset_postdata();

		/*		 * **********************************
		 * 			LEFT COLUMN END
		 * ********************************** */
		?>




	</aside>	

	<div class="content lp_content eight_column mk_about_content">

		<section class="mk_about_more">
			<div class="box_wrapper box_w_green box_huge box_two_column">	

				<?php
				/*				 * **********************************
				 * 			RIGHT COLUMN
				 * ********************************** */
//$repeater = 'left_column';
//$button = 'button';
//first section

				while (have_posts()): the_post();
					$fields = get_fields();
					$title = $fields["title"];
					$subtitle = $fields["subtitle"];
					$logo = wp_get_attachment_image_src(get_field('logo'), 'medium');
					$quote = $fields["quote"];
					$content = $fields["content"];
					$short_description = $fields["short_description"];
					$subtitle_article = $fields["subtitle_article"];
					?>

					<div class="box_inside">	
						<h4><?= $subtitle; ?></h4>
						<h3><?= $title; ?></h3>
						<div class="box_quote">
							<div class="box_quote_img">
								<img class="logo_header" alt="IPU" src="<?= $logo[0]; ?>">
							</div>
							<i><?= $quote; ?></i>
						</div>	

						<div class="box_content">
	<?= $content; ?>
						</div>		
					</div>

	<!--		<p> <?= $short_description; ?></p>-->
	<!--		<p><?= $subtitle_article; ?></p>-->
	<?php
endwhile;
wp_reset_query();
wp_reset_postdata();
?>



			</div>					
		</section>
<?php

			$featureDefault = site_url() . '/wp-includes/images/media/default.png';
			$image_id = get_post_thumbnail_id();
			$image_url = wp_get_attachment_image_src($image_id, 'full', true);
			$feature = $image_url[0];
			?>
		<section class="mk_about_fancy">
			
			<?php if($feature != $featureDefault){?>
				<div class="mk_about_fancy_img" style="background:url('<?= $feature; ?>')"></div>	
			<?php }else{ ?>
				<div class="mk_about_fancy_img"></div>	
			<?php }?>
	 		
		</section>

		<section class="mk_about_commitee">
			<div class="box_wrapper box_w_purple box_huge">	
				<div class="box_inside">	
					<h4>Hoy I'm the subtitle</h4>
					<h3>The title goes here</h3>
					<div class="box_content">

<?php
//Commitees section
$commitees = 'commitees';
if (get_field($commitees)):
	while (have_rows($commitees)) : the_row();
		$title = get_sub_field('title');
		$description = get_sub_field('content');
		?>


								<div class="box_sub_content">
									<h5><?= $title; ?></h5>
									<p><?= $description; ?></p>
								</div>


		<?php
	endwhile;
endif;
wp_reset_query();
wp_reset_postdata();
?>


					</div>		
				</div>				
			</div>					

			<div class="mk_about_executive">
				<div class="mk_about_executive_wrapper">	
<?php
$people = 'people';
if (get_field($people)):
	while (have_rows($people)) : the_row();
		$first_name = get_sub_field('first_name');
		$last_name = get_sub_field('last_name');
		$occpupation = get_sub_field('occupation');
		$description = get_sub_field('description');
		$picture = wp_get_attachment_image_src(get_sub_field('picture'), 'medium');
		?>
							<div class="mk_about_executive_member">	
								<div class="mk_about_executive_avatar">	
									<span class="cc_avatar_wrapper">
										<div class="cc_avatar" style="background-image:url('<?= $picture[0]; ?>')"></div>
									</span>
									<span class="cc_first_name"><?= $first_name; ?></span>
									<span class="cc_last_name"><?= $last_name; ?></span>
									<span class="cc_function"><?= $occpupation; ?></span>
								</div>
								<div class="mk_about_executive_content">	
									<p><?= $description; ?></p>
								</div>
							</div>	
		<?php
	endwhile;
endif;
wp_reset_query();
wp_reset_postdata();
?>
				</div>	
			</div>		

		</section>

	</div>
</article>
<?php
get_footer();

