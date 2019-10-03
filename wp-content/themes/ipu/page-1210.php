<?php
/**
 * The Template for ABOUT IPU - Communication – non member
 *
 * @package WordPress
 * @subpackage IPU
 * @since Twenty Fourteen 1.0
 */
get_header();
?>


<article id="content_wrapper">
		<aside class="sidebar two_column sb_mk_about sb_mk_comm">
			<div class="sb_wrapper">
				<h3>Rate card</h3>
				<p class="sb_txt"><?= get_field('left_content', 1210); ?></p>

					<?php
						//Commitees section
						$buttonLeft = 'button';
						if (get_field($buttonLeft)):
							while (have_rows($buttonLeft)) : the_row();
								$title = get_sub_field('title');
								$attachment_id = get_sub_field('file');
								$file = wp_get_attachment_url($attachment_id);
							//	$location = get_sub_field('location');
								?>


									<a target="_blank" href="<?=$file;?>" class="btn btn_action_dowload_turquoise">Download</a>
								<?php
							endwhile;
						endif;
						wp_reset_query();
						wp_reset_postdata();
					?>



			</div>
			<div class="sb_wrapper sb_wrapper_n2">

			<?php
				//Commitees section
				$yearbook = 'yearbook';
				if (get_field($yearbook)):
					while (have_rows($yearbook)) : the_row();
						$title = get_sub_field('title');
						$content = get_sub_field('content');
						$btnTitle = get_sub_field('button_title');
						$attachment_id = get_sub_field('file');
						$file = wp_get_attachment_url($attachment_id);
					//	$location = get_sub_field('location');
						?>

			<h3><?=$title;?></h3>
				<div class="sb_txt"><?=$content;?></div>
				<a target="_blank" href="<?=$file;?>" class="btn btn_action_order_purple">Download</a>

						<?php
					endwhile;
				endif;
				wp_reset_query();
				wp_reset_postdata();
			?>



			</div>
		</aside>

		<div class="content lp_content eight_column mk_comm_content">

			<section class="furst_publication f_review">
				<div class="box_wrapper box_turquoise box_review">
					<div class="box_inside">
						<div class="ipu_review_logo_alt"></div>
						<?php
			/************************************
			 *			RIGHT COLUMN
			 ************************************/
			//$repeater = 'left_column';
			//$button = 'button';

			//first section

				while (have_posts()): the_post();
					$fields = get_fields();
					$title = $fields["title"];

					$subtitle = $fields["subtitle"];
					//$logo = wp_get_attachment_image_src(get_field('logo'), 'medium');
					//$quote = $fields["quote"];
					$content = $fields["content"];
					//$short_description = $fields["short_description"];
					//$subtitle_article = $fields["subtitle_article"];
					//$title;
					?>

						<h4><?=$subtitle;?></h4>
						<div class="box_content">
							<p><?= $content; ?></p>
						</div>

						<div class="box_action">
<!-- 												<a href="#" class="btn btn_action_order_w">Subscribe now</a>
 -->											</div>

					<?php
				endwhile;
			wp_reset_query();
			wp_reset_postdata();
			?>










					</div>
				</div>
				<section class="content_commitee">

					<section class="tab_wrapper">
						<ul class="tabs">

							<?php
						//Commitees section
							$boxes = 'campaign_boxes';
							//$button = 'button';
							$y=0;
							if (get_field($boxes)):
								while (have_rows($boxes)) : the_row();
									$year = get_sub_field('year');

						?>
								<li><a href="#tab<?=$y;?>"><?=$year;?></a></li>
						<?php $y++; ?>
					<?php
				endwhile;
			endif;
			wp_reset_query();
			wp_reset_postdata();
		?>


						</ul>

						<div class="clr"></div>

						<section class="block">

						<?php
						//Commitees section
							$box = 'campaign_boxes';
							$button = 'button';
							$i=0;
							if (get_field($box)):
								while (have_rows($box)) : the_row();
									$title = get_sub_field('title');
									$subtitle = get_sub_field('subtitle');
									$content = get_sub_field('content');
						?>
							<article id="tab<?= $i; ?>">
								<div class="left-content">
									<h4><?= $subtitle; ?></h4>
									<h3><?= $title; ?></h3>
									<div class="box_content">
										<?= $content; ?>
									</div>
								<?php
									if (get_field($button)):
										while (have_rows($button)) : the_row();
											$title = get_sub_field('title');
											$link = get_sub_field('link');
											?>
												<div class="box_action">
													<a target="_blank" href="<?= $link; ?>" class="btn btn_action_dowload_purple"><?= $title; ?></a>
												</div>


									<?php
										endwhile;
									endif;
										wp_reset_query();
										wp_reset_postdata();
									?>
									<?php $i++; ?>
								</div>
							</article>
					<?php
				endwhile;
			endif;
			wp_reset_query();
			wp_reset_postdata();
		?>






<!--							<article id="tab2" style="display: none;">
								<div class="left-content">
									<h4>IPU EXECUTIVE COMITTEE</h4>
									<h3>2014 Annual Report</h3>
									<div class="box_content">
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse iaculis eros at libero euismod fringilla eget viverra arcu.
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse iaculis eros at libero euismod fringilla eget viverra arcu.
									</div>
									<div class="box_action">
										<a href="#" class="btn btn_action_dowload_purple">Download</a>
									</div>
								</div>
							</article>
							<article id="tab3" style="display: none;">
								<div class="left-content">
									<h4>IPU EXECUTIVE COMITTEE</h4>
									<h3>2014 Annual Report</h3>
									<div class="box_content">
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse iaculis eros at libero euismod fringilla eget viverra arcu.
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse iaculis eros at libero euismod fringilla eget viverra arcu.
									</div>
									<div class="box_action">
										<a href="#" class="btn btn_action_dowload_purple">Download</a>
									</div>
								</div>
							</article>
							<article id="tab4" style="display: none;">
								<div class="left-content">
									<h4>IPU EXECUTIVE COMITTEE</h4>
									<h3>2014 Annual Report</h3>
									<div class="box_content">
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse iaculis eros at libero euismod fringilla eget viverra arcu.
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse iaculis eros at libero euismod fringilla eget viverra arcu.
									</div>
									<div class="box_action">
										<a href="#" class="btn btn_action_dowload_purple">Download</a>
									</div>
								</div>
							</article>
							<article id="tab5" style="display: none;">
								<div class="left-content">
									<h4>IPU EXECUTIVE COMITTEE</h4>
									<h3>2014 Annual Report</h3>
									<div class="box_content">
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse iaculis eros at libero euismod fringilla eget viverra arcu.
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse iaculis eros at libero euismod fringilla eget viverra arcu.
									</div>
									<div class="box_action">
										<a href="#" class="btn btn_action_dowload_purple">Download</a>
									</div>
								</div>
							</article>
							<article id="tab6" style="display: none;">
								<div class="left-content">
									<h4>IPU EXECUTIVE COMITTEE</h4>
									<h3>2014 Annual Report</h3>
									<div class="box_content">
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse iaculis eros at libero euismod fringilla eget viverra arcu.
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse iaculis eros at libero euismod fringilla eget viverra arcu.
									</div>
									<div class="box_action">
										<a href="#" class="btn btn_action_dowload_purple">Download</a>
									</div>
								</div>
							</article>-->



						</section>
					</section>

				</section>

			</section>






  		<div class="sort">
			<div class="btn_sort_wrapper">
				<span>Sort by</span>
				<?php include_once 'common/sortby.php'; ?>
			</div>
		</div>
			<script type="text/javascript" >
				jQuery(document).ready(function($) {

					var data = {
						'action': 'elaborate_members'
					};

					jQuery.post(ajaxurl, data, function(response) {
						$('#loader').fadeOut('slow',function(){
							$('#container').isotope( 'insert', $(response) );
						})
					});
				});
			</script>
	<div class="grid_wrapper">
		<div id="loader" class='uil-cube-css' style='-webkit-transform:scale(0.6)'><div></div><div></div><div></div><div></div></div>
		<div id="container" class=" grid_post">
			<?php
				/*******************************
				 * main content
				 ******************************/
			?>
			<?php

	/*	$args = array(
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

				   $downloadFile = wp_get_attachment_url(get_post_meta(get_the_ID(), 'file', true));
				*/?><!--



		 		<?php /*if ($post_type == 'review') {  */?>
					<?php /*include(get_query_template('loop-'.$post_type)) */?>
				<?php /*} */?>


			<?php /*if($display == 'yes') { */?>

				<?php /*if ($post_type == 'article') {  */?>
					<?php /*include(get_query_template('loop-'.$post_type)) */?>
				<?php /*} */?>
				<?php /*if ($post_type == 'file') { */?>
					<?php /*include(get_query_template('loop-'.$post_type)) */?>
				<?php /*} */?>

			<?php /*} */?>
						<?php
/*							////////////     Filters    //////////////
						*/?>
						<script>
							<?php /*if($post_type): */?>
								var n<?/*= $post_type; */?> = $('#container' + ' .gi_<?/*= $post_type; */?>').length;

								var s<?/*= $post_type; */?> = $('<span />',{
									class:'<?/*= $post_type; */?> sbf_filter_counter' ,
									html: n<?/*= $post_type; */?>
								});

								s<?/*= $post_type; */?>.appendTo('#<?/*= $post_type; */?>');
							<?php /*endif; */?>
						</script>

				<?php
/*
				endwhile;
				*/?>
			--><?php
/*				wp_reset_query();
				wp_reset_postdata();
			*/?>
		</div>
</div>




		</div>
	</article>

<script>
	$(function(){
	  $('ul.tabs li:first').addClass('active');
	  $('.block article').hide();
	  $('.block article:first').show();
	  $('ul.tabs li').on('click',function(){
		$('ul.tabs li').removeClass('active');
		$(this).addClass('active')
		$('.block article').hide();
		var activeTab = $(this).find('a').attr('href');
		$(activeTab).show();
		return false;
	  });
	})
</script>
<?php
get_footer();
