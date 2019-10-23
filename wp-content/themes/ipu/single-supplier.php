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


	<aside class="sidebar sb_single_item sb_single_article two_column sb_supplier">
				<?php
		while (have_posts()) : the_post();
			$fields = get_fields();

			$title = $fields["title"];
			$shortDesc = $fields["short_description"];
			$author_id = get_the_author_meta('ID');


			$image = get_field('picture');
			$logo = get_field('logo');
			$author = $fields["author"];
		//	$author_ro = get_field('author');

			$evDate = get_field('date');
			$year = date( 'Y', strtotime( $evDate ) );
			$month = date( 'M', strtotime( $evDate ) );
			$day = date( 'd', strtotime( $evDate ) );
			$time = date( 'H:i', strtotime( $evDate ) );

			$attachment_id = get_field('file');
			$file_url = wp_get_attachment_url($attachment_id);


			?>
			<div class="sb_wrapper sb_wrapper_stickit">
				<div class="sia_avatar_wrapper">
					<div class="sia_avatar" <?php if(!empty($logo)){?> style="background-image: url('<?= $logo; ?>')"<?php } ?>></div>
				</div>
				<span class="sia_name"><b><?=$author;?></b></span>


					<?php
				//contact details
				if (have_rows('contact')):
					while (have_rows('contact')) : the_row();

						$address = get_sub_field('address');
						$email = get_sub_field('email');
						$phone = get_sub_field('phone');
						$website = get_sub_field('website');
						?>

						<span class="se_info_address">
							<?= $address['address']; ?>
						</span>
						<span class="se_info_contact">
							<a href="mailto:<?= $email; ?>"><?= $email; ?></a>
							<a href="tel://<?= $phone; ?>"><?= $phone; ?></a>
							<a href="href://<?= $website; ?>"><?= $website; ?></a>
						</span>

					<?php endwhile; ?>
				<?php endif; ?>

				<?php if(!empty($file_url)){?>
					<a target="_blank" href="<?=$file_url;?>" class="btn btn_action_dowload_purple_solid">Further Information</a>
				<?php } ?>
			</div>

			<?php endwhile; ?>

		<?php
		wp_reset_query();
		wp_reset_postdata();
		?>
		</aside>







	<div class="content si_content eight_column si_supplier ">
<?php
				/*				 * *****************************
				 * main content
				 * **************************** */
				?>
				<?php
				while (have_posts()) : the_post();
					$fields = get_fields();

					$select = $fields["category"];
					$fieldz = get_field_object('category');
					$value = get_field('category');
					$categorylbl = $fieldz['choices'][$value];

					//update
					$author = $fields["author"];
					$offer = $fields["offer"];
					$shortDesc = $fields["short_description"];
					$largeDesc = $fields["description"];
					$image = get_field('picture');
					$logo = get_field('logo');
					foreach ($select as $selected) {
						$category = $selected;
					}
					?>
			<section class="si_txt">

				<div class="si_section_title">
					<h3><?= $post_type; ?></h3>
				</div>

				<div class="si_section_title_supplier">
					<h3><?= $offer; ?></h3>
					<h2><?php the_title(); ?></h2>
				</div>

				<div class="si_supplier_wrapper">
					<div class="si_supplier_img" <?php if(!empty($image)){?> style="background-image: url('<?= $image; ?>')"<?php } ?>></div>
					<div class="si_section_content">
						<section class="si_descr_full">
						<?= $largeDesc; ?>
						</section>
					</div>
				</div>
			</section>

			<?php
endwhile;
?>
			<?php
			wp_reset_query();
			wp_reset_postdata();
			?>
		</div>


<!--	<div class="content si_content se_content eight_column">

		<section class=" content_same_height">

			<div id=" " class=" grid_post">
				<?php
				/*				 * *****************************
				 * main content
				 * **************************** */
				?>
				<?php
				while (have_posts()) : the_post();
					$fields = get_fields();

					$select = $fields["category"];
					$fieldz = get_field_object('category');
					$value = get_field('category');
					$categorylbl = $fieldz['choices'][$value];

					//update
					$author = $fields["author"];
					$offer = $fields["offer"];
					$shortDesc = $fields["short_description"];
					$largeDesc = $fields["description"];
					$bg_picture = wp_get_attachment_image_src(get_field('picture'), 'medium');
					$logo = wp_get_attachment_image_src(get_field('logo'), 'medium');
					foreach ($select as $selected) {
						$category = $selected;
						//$categorylbl = $label;
					}
					?>



					<div class="gi_data_category name"><?= $post_type; ?></div>



				</div>

				<img src="<?= $bg_picture[0]; ?>" />

				<div class="gi_cover_picture" style="<?php if ($bg_picture[0]) { ?> background: url('<?= $bg_picture[0]; ?> ');<?php } ?>">

				</div>

				<h4 class="gi_title"><?= $offer; ?></h4>
				<h4 class="gi_title"><?php the_title(); ?></h4>
				<span class="gi_author">
	<?php if (!empty($author)) { ?>
						By the <?= $author; ?>
					<?php } ?>
				</span>

				<span class="gi_content_txt">
	<?= $shortDesc; ?>
				</span>
				<span class="gi_content_txt">
	<?= $largeDesc; ?>
				</span>



	<?php
endwhile;
?>
			<?php
			wp_reset_query();
			wp_reset_postdata();
			?>
	</div>-->


		</section>




	</div>
</article>


<?php
//get_sidebar();
get_footer();
