<?php
/**
 * The Template for Lobbying
 *
 * @package WordPress
 * @subpackage IPU
 * @since Twenty Fourteen 1.0
 */
get_header();
?>
<style>

	/* End: Recommended Isotope styles */

.sbf_filter input{
	display: none;
}
.sbf_filter label{
		padding: 10px 101px 10px 0px;
	}
.sb_filters .sbf_filtergroup .sbf_filter .sbf_filter_counter{
	display: none;
}



</style>

<?php
	$shortDesc = get_field('short_description', 834);
?>

<article id="content_wrapper">
	<aside class="sidebar sb_filters two_column">

		<?php if(!empty($shortDesc)){?>
			<div class="sb_txt"><?= $shortDesc; ?></div>
		<?php } ?>


		<h3><?php echo get_option( 'dropdown_text_name' )?></h3>


		<div id="filters" class="sbf_filtergroup" data-group="filter">
<!--			<div class="sbf_filter sbf_filter_active"><input type="checkbox" value=".item" id="item" class="all"><label for="item">All</label></div>-->
			<div class="sbf_filter" id="article"> <input type="checkbox" name="gi_article" value=".gi_article" id="gi_article"><label for="gi_article">Article</label></div>
			<div class="sbf_filter" id="review"> <input type="checkbox" name="gi_review" value=".gi_review" id="gi_review"><label for="gi_review">Review</label></div>
			<div class="sbf_filter" id="file"> <input type="checkbox" name="gi_file" value=".gi_file" id="gi_file"><label for="gi_file">Submission</label></div>
		</div>
	</aside>




<div class="content lp_content eight_column">

	<section class="furst_publication">
				<div class="box_wrapper box_w_turquoise box_review">
					<div class="box_inside">
						<div class="ipu_review_logo"></div>
			 <?php
					if (have_rows('left_content')):
						while (have_rows('left_content')) : the_row();
							$logo = wp_get_attachment_image_src(get_sub_field('logo'), 'medium');
							$title = get_sub_field('title');
							$subtitle = get_sub_field('subtitle');
							$content = get_sub_field('content');
							?>

						<h4><?=$subtitle; ?></h4>
						<div class="box_content">
							  <?=$content; ?>
						</div>


						<?php endwhile; ?>
					<?php endif; ?>
					<?php
					wp_reset_query();
					wp_reset_postdata();
					?>


					</div>
				</div>
				<div class="box_wrapper box_g_purple">
					<div class="box_inside">
						<?php
					if (have_rows('right_content')):
						while (have_rows('right_content')) : the_row();
							$title = get_sub_field('title');
							$subtitle = get_sub_field('subtitle');
							$content = get_sub_field('content');
						?>
						<h4><?=$subtitle; ?></h4>
						<h3><?=$title; ?></h3>
						<div class="box_content">
							<?=$content;?>
						</div>
						<div class="box_action">

							<?php
							if (have_rows('reports')):
								while (have_rows('reports')) : the_row();
									$title = get_sub_field('name');
									$file = wp_get_attachment_url(get_sub_field('file'), 'medium');

								?>
							<a href="<?=$file;?>" target="_blank" class="btn btn_action_dowload_purple" title="<?=$title;?>"><?=$title;?></a>
								<?php endwhile; ?>
							<?php endif; ?>
							<?php
							wp_reset_query();
							wp_reset_postdata();
							?>

						</div>

						<?php endwhile; ?>
					<?php endif; ?>
					<?php
					wp_reset_query();
					wp_reset_postdata();
					?>
					</div>
				</div>

			</section>


  		<div class="sort">
			<div class="btn_sort_wrapper">
				<span>Sort by</span>
				<?php include_once 'common/sortby.php'; ?>
			</div>
		</div>
	<div class="grid_wrapper">
		<div id="container" class=" grid_post">
			<?php
				/*******************************
				 * main content
				 ******************************/
			?>
			<?php
		$args = array(
		'posts_per_page' => -1,
		'post_type' => array('article', 'file', 'review'),
		'orderby' => 'date',
		'order' => 'DESC'
	);

			$query = new WP_Query($args);
			while ($query->have_posts()) :
				$query->the_post();
				$fields = get_fields();
 				$category = $fields["category"];
 				$fieldz = get_field_object('category');
 				$value = get_field('category');
 				$categorylbl = $fieldz['choices'][$value];

				//update
				$first_name = $fields["first_name"];
				$last_name = $fields["last_name"];
				$function = $fields["function"];
				$location = $fields["location"];
				//$select = $fields["category"];
				$select = $fields["region"];

				$author = $fields["author"];
				$offer = $fields["offer"];
				//$shortDesc = $fields["short_description"];
				$bg_picture = wp_get_attachment_image_src(get_field('picture'), 'medium');
				$logo = wp_get_attachment_image_src(get_field('logo'), 'medium');

				//update
					$date = get_field('date');
					$year = date( 'Y', strtotime( $date ) );
					$month = date( 'M', strtotime( $date ) );
					$day = date( 'd', strtotime( $date ) );
				  $title = $fields["title"];
				  $subtitle = $fields["subtitle"];
				  $shortdescription = $fields["short_description"];



				$file = wp_get_attachment_url(get_post_meta(get_the_ID(), 'file', true));
				$associated_file_one = wp_get_attachment_url(get_post_meta(get_the_ID(), 'associated_file_one', true));
				$associated_file_two = wp_get_attachment_url(get_post_meta(get_the_ID(), 'associated_file_two', true));


				foreach($select as $selected){
					$region = $selected;
					//$categorylbl = $label;
				}



				$display = $fields["display_on_review"];
				$title = $fields["title"];
				$categorytxt = $fields["category"];
				$fieldz = get_field_object('category');
				$value = get_field('category');
				$categorylbl = $fieldz['choices'][$value];
				$shortDesc = $fields["short_description"];
				$attachment_id = get_field('upload_file');

				$viewFile = wp_get_attachment_url($attachment_id);
				$post_type = get_post_type();

				$id = get_the_ID();
				$attachment_picture = get_field('picture');
				$picture = wp_get_attachment_image_src($attachment_picture, 'medium', true);
				$defaultPicture = wp_get_attachment_image_src($id, 'medium', true);


				?>



		 		<?php if ($post_type == 'review') {  ?>
			<div class="item g_item gi_purple gi_review">

					<div class="gi_event_img_wrapper"> 	<!-- if the event got a picture -->
						<div class="gi_data_sidebar_img">
							<div class="gi_data_date">
								<span class="gi_data_month"><?=$month;?></span>
								<span class="gi_data_year"><?=$day;?></span>
							</div>
						</div>	<!-- end  -->

						<?php if( $picture[0] != $defaultPicture[0] ) { ?>
							<div class="gi_cover_picture" style="background: url('<?= $picture[0]; ?>') no-repeat; background-size: cover;"></div>
						<?php } else { ?>
							<div class="gi_cover_picture"></div>
						<?php } ?>


						<div class="gi_data_wrapper">
							<div class="gi_data">
								<div class="gi_data_category"><?=$post_type;?></div>
								<h4 class="gi_title"><?=$title;?></h4>
								<h5 class="gi_subtitle"><?=$subtitle;?></h5>
								<h4 class="gi_content_txt">
									 <?=$shortdescription;?>
								</h4>
								<a href="<?=$file;?>" class="gi_btn">Download</a>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>


			<?php if($display == 'yes') { ?>

				<?php if ($post_type == 'article') {  ?>
					<div class="item g_item gi_article gi_<?= $category; ?>" data-time="<?= $date; ?>" data-category="<?= $post_type; ?>">
						<div class="gi_cover_picture"></div>
						<div class="gi_data_wrapper">
							<div class="gi_data_sidebar">
								<div class="gi_data_date">
									<span class="gi_data_day"><?= get_the_date("d"); ?></span>
									<span class="gi_data_month"><?= get_the_date("M"); ?></span>
								</div>
							</div>
							<div class="gi_data">
								<div class="gi_data_category"><?= $post_type; ?></div>
								<?php// showCounter(); ?>
								<h4 class="gi_title">
									<?php the_title(); ?>
								</h4>
								<span class="gi_author">
									<?php if (!empty($author)) { ?>
										By <?= $author; ?>
									<?php } ?>
								</span>
							</div>
						</div>
						<div class="gi_content">
							<span class="gi_content_txt">
								<?= $shortDesc; ?>
							</span>
						</div>
						<a href="<?php the_permalink(); ?>" class="gi_btn" title="<?= $categorylbl; ?> - view">View</a>
					</div>
				<?php } ?>
				<?php if ($post_type == 'file') { ?>
					<?php
						$downloadFile = wp_get_attachment_url(get_post_meta(get_the_ID(), 'files', true));
					?>
					<div class="item g_item gi_file gi_<?= $category; ?>"  data-time="<?= $date; ?>" data-category="<?= $post_type; ?>" >
						<div class="gi_data_wrapper">
							<div class="gi_data">
								<div class="gi_data_category" data-category="<?= $post_type; ?>"><?= $post_type; ?></div>
								<span class="gi_data_date"><?= get_the_date("d M y"); ?></span>
								<h4 class="gi_title">
									<?php the_title(); ?>
								</h4>
							</div>
							<div class="gi_data_sidebar">
								<div class="gi_data_sidebar_icon"></div>
								<div class="gi_data_sidebar_data">533kb</div>

							</div>
						</div>

						<div class="gi_content">
							<span class="gi_content_txt">
								<?= $shortDesc; ?>
							</span>
						</div>
						<a href="<?= $downloadFile; ?>" class="gi_btn" title="<?= $title; ?> - read">Download</a>
					</div>
				<?php } ?>

			<?php } ?>
						<?php
							////////////     Filters    //////////////
						?>
						<script>
							<?php if($post_type): ?>
								var n<?= $post_type; ?> = $('#container' + ' .gi_<?= $post_type; ?>').length;

								var s<?= $post_type; ?> = $('<span />',{
									class:'<?= $post_type; ?> sbf_filter_counter' ,
									html: n<?= $post_type; ?>
								});

								s<?= $post_type; ?>.appendTo('#<?= $post_type; ?>');
							<?php endif; ?>
						</script>

				<?php

				endwhile;
				?>
			<?php
				wp_reset_query();
				wp_reset_postdata();
			?>
		</div>
</div>

	</div>
</article>
<script>
	//filters counter
	//move-
	$('.sbf_filter_counter').addClass('remove');
	$('.remove:last-child').addClass('last');
	$('.last:last-child').removeClass('remove');
	$('.remove').remove();

	$('.sbf_filter_counter').css('visibility','visible');
</script>
<?php
get_footer();
