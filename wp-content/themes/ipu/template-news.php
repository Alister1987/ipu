<?php
/**
Template Name: News
 *
 * @package WordPress
 * @subpackage IPU
 * @since Twenty Fourteen 1.0
 */
get_header();
?>
<?php
$post_type = get_post_type();
$args = array(
	'posts_per_page' => -1,
	'post_type' => 'news',
	'orderby' => 'date',
	'order' => 'DESC'
);


$shortDesc = get_field('short_description', 830);
$id = get_the_ID();
?>



	<article id="content_wrapper" class="page-<?=$id;?>">
		<?php
		/**
		 * Left column
		 * */
		?>
		<aside class="sidebar sb_news">
			<?php
			while (have_posts()) : the_post();
				$fields = get_fields();

				$title = $fields["title"];
				$shortDesc = $fields["short_description"];
				$post_date = get_the_modified_date('d, M, Y');

				$image_id = get_post_thumbnail_id();
				$image_url = wp_get_attachment_image_src($image_id, 'large', true);
				$avatar = wp_get_attachment_image_src(get_field('avatar'), 'medium');
				$author = $fields["author"];
				$author_role = get_field('author_role');

				?>
				<div class="sb_wrapper sb_wrapper_stickit">
					<div class="sb_txt"><?=$shortDesc;?></div>
				</div>
				<div id="welcomeDiv"  style="display:none;" class="answer_list" > WELCOME</div>
			<?php endwhile; ?>

			<?php
			wp_reset_query();
			wp_reset_postdata();
			?>

			<?php// include 'common/section_admin.php' ;?>
		</aside>

		<div class="content lp_content news_content eight_column">
			<section>
				<div class="si_section_content">
					<div id="tabs">
						<ul class="n_content_same_height">
							<?php
							$query = new WP_Query($args);
							while ($query->have_posts()) :
								//$counter = 1;
								$query->the_post();
								$fields = get_fields();
								$title = $fields["title"];
								$category = $fields["category"];
								$fieldz = get_field_object('category');
								$value = get_field('category');
								$categorylbl = $fieldz['choices'][$value];
								$shortDesc = $fields["short_description"];
								$viewLink = $fields["sop_link"];
								$post_type = get_post_type();
								$dateDay = get_the_modified_date('d');
								$dateMonth = get_the_modified_date('M');
								$author_id = get_the_author_meta('ID');
								$date = get_the_modified_date("dmY");
								$id = get_the_ID();

								$color = '';
								if($category == 'newsletter'){
									$color = 'n_turquoise';
								}elseif($category == 'gm'){
									$color = 'n_blue';
								}elseif($category == 'notefromthesg'){
									$color = 'n_purple';
								}elseif($category == 'pressrelease'){
									$color = 'n_green';
								}
								?>
								<li class="news_item_wrapper red <?=$color;?>">
									<!-- n_turquoise, n_blue, n_green, n_purple, depending of the category of the news -->
									<a class='news-holder' href="#tab-<?= $id ;?>">
										<div class="n_data">
											<span class="n_data_day"><?php echo $dateDay ?></span>
											<span class="n_data_month"><?php echo $dateMonth ?></span>
										</div>
										<div class="n_content">
<!--											<div class="n_cat_wrapper">-->
<!--												<span class="n_cat">--><?//=$categorylbl;?><!--</span>-->
<!--											</div>-->
											<span class="n_title"><?php the_title();?></span>
											<span class="n_shortDesc"><?=$shortDesc;?></span>
										</div>
									</a>
								</li>
								<?php
							endwhile;
							wp_reset_query();
							wp_reset_postdata();
							?>
							<li class="load_more_news_items_li"><div class="btn btn_grey btn_action_go load_more_news_items">Load more</div></li>
						</ul>
						<div id="news-mobile-popup" style="display: none">
							<div id="news-mobile-popup-close"></div>
							<div id="news-mobile-popup-content"></div>
						</div>

						<script type='text/javascript'>
							$(document).ready(function () {

								$("#news-mobile-popup-close").click(function () {
									$("#news-mobile-popup").fadeOut();
									$(".member_footer").fadeIn();
									$( "body").css("overflow","scroll")
									$("#header_scroll").fadeIn();
								})

								$(".news_content").on("click","a.news-holder",function () {
									if($( window ).width() <= 768){
										$( "body").css("overflow","hidden")
										$("#news-mobile-popup").fadeIn();
										$(".member_footer").fadeOut();
										$("#header_scroll").fadeOut();
										$($(this).attr("href")).show();
										$("#news-mobile-popup-content").html($($(this).attr("href")).html());
									}else{
										// lets load appropriate resources
										$(".section-tab").hide();
										$(".section-"+$(this).attr("href").replace("#", "")).show();
										$(window).resize();
									}
								});
							});
						</script>

						<div class="right-container n_content_same_height">
							<div class="right_wrapper">
								<?php
								$resources = array();
								$query2 = new WP_Query($args);
								$isFirst = true;
								while ($query2->have_posts()) :
									//$counter = 1;
									$query2->the_post();
									$fields = get_fields();
									$title = $fields["title"];
									$category = $fields["category"];
									$fieldz = get_field_object('category');
									$value = get_field('category');
									$categorylbl = $fieldz['choices'][$value];
									$shortDesc = $fields["short_description"];
									$viewLink = $fields["sop_link"];
									$post_type = get_post_type();
									$date = get_the_date("dmY");

									$assocResources = $fields['current_issues'];
									if(count($assocResources) > 0) {
										$assocResources = $assocResources[0];
										$assocResources = $assocResources['current_issues_elements'];
									}
									$resources[] = array(
										'id' => $id,
										'resources' => $assocResources
									);
									?>
									<div class="g_section_title section-tab section-tab-<?= $id ;?>" style='<?= !$isFirst ? "display: none" : "" ?>'>
										<h3>News</h3>
										<?php if(count($assocResources) > 0) { ?>
											<p id="total_associated_resources"><span><?= count($assocResources) ?></span> associated resources</p>
										<?php } else { ?>
											<p>No associated resources</p>
										<?php } ?>
										<div class="btn btn_action_maxmin btn_action_max" id="n_maximize">Maximize</div>
									</div>
									<div id="tab-<?= $id ;?>">
										<div class="box_wrapper box_huge">
											<div class="box_inside">
												<h3><?php the_title(); ?></h3>
												<div class="box_content">
													<?php the_content(); ?>
												</div>
											</div>
										</div>
									</div>
									<?php
									$isFirst = false;
								endwhile;
								wp_reset_query();
								wp_reset_postdata();
								?>
							</div>


							<div class="grid_post content_same_height">

								<?php if (have_rows('current_issues')): ?>
								<div class="grid_wrapper">


									<?php
									$isFirst = true;
									for($i = 0; $i < count($resources); $i++) {
										$res = $resources[$i];

										$associated = $res['resources'];
										$id = $res['id'];

										?>
										<div class="section-tab section-tab-<?= $id ;?>" style='<?= !$isFirst ? "display: none" : "" ?>'>
											<?php

											for($j = 0; $j < count($associated); $j++) {
												$post = $associated[$j];
												setup_postdata($post);

												$fields = get_fields();
												$title = $fields["title"];
												$shortDesc = $fields["short_description"];
												$attachment_id = get_field('upload_file');
												$viewFile = wp_get_attachment_url($attachment_id);
												$post_type = get_post_type();
												$date = get_the_date();

												$categorytxtList = ipu_get_custom_field('ipu_categories');

												$giCategoryList = explode(',',$categorytxtList);
												$giCatClasses = implode(' gi_', $giCategoryList);
												$giCatClasses = 'gi_'.$giCatClasses;

												include(get_query_template('loop-'.$post_type));

											}
											$isFirst = false;

											?>

										</div>

									<?php } ?>

									<?php endif; ?>
									<?php
									wp_reset_query();
									wp_reset_postdata();
									?>

								</div>
							</div>
						</div>
					</div>
				</div>
			</section>


		</div>
	</article>

	<script>
		$('#tabs')
			.tabs()
			.addClass('ui-tabs-vertical ui-helper-clearfix');
	</script>
<?php
//get_sidebar();
get_footer();
