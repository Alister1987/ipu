<?php
/**
Template Name: Ad Campaign
 *
 * @package WordPress
 * @subpackage IPU
 * @since Twenty Fourteen 1.0
 */
get_header(); ?>
<?php
  //$order = "&order=ASC";
//  if ($_POST['select'] == 'title') { $order = "title";  }
//  if ($_POST['select'] == 'date') { $order = "post_date";  }
//  if ($_POST['select'] == 'popular') { $order = "rand";  }
?>

<style>

	/* End: Recommended Isotope styles */

	#filters .sbf_filter input{
		display: none;
	}
	#filters .sbf_filter label{
		padding: 10px 101px 10px 0px;
	}
.sb_filters .sbf_filtergroup .sbf_filter .sbf_filter_counter{
	visibility: hidden;
}

</style>

<?php
    global $post;

	$shortDesc = get_field('short_description', $post->ID)
;    $currPostId = $post->ID;
?>

<article id="content_wrapper">
	<aside class="sidebar sb_filters two_column">

		<?php if(!empty($shortDesc)){?>
			<div class="sb_txt"><?= $shortDesc; ?></div>
		<?php } ?>
        <?php
            $query = new WP_Query(array(
                'post_type'  => 'page',  /* overrides default 'post' */
                'meta_key'   => '_wp_page_template',
                'meta_value' => 'template-ad-campaign.php'
            ));

            if($query->post_count > 1 && is_page(4288) === false) {
                  ?>
                          <h3>Past Campaigns</h3>

                          <?php

                              if ( $query->have_posts() ) :
                                  while ( $query->have_posts() ) : $query->the_post();
                                      if(get_the_ID() != $currPostId) {
                                      ?>
                                          <a target="_self" href="<?php the_permalink() ?>" class="btn btn_action_register" title="<?php the_title() ?>"><?php the_title() ?></a>
                                      <?php
                                      }
                                  endwhile;
                              endif;
                      }

            wp_reset_postdata();
        ?>



	</aside>

	<div class="content lp_content eight_column lp_event content_adcampaign">

	<section class="furst_publication">

		<div class="box_wrapper box_w_green box_huge box_two_column">
					<div class="box_inside">
									<?php
			if (have_rows('content')):
				while (have_rows('content')) : the_row();
					$title = get_sub_field('title');
					$subtitle = get_sub_field('subtitle');
					$textlbl = get_sub_field('textlbl');
					//$counter = count( $priority );
						$file = wp_get_attachment_url(get_sub_field('file'), true);

				 ?>
					<h4><?= $subtitle ;?></h4>
				<h3><?= $title ;?></h3>
						<div class="box_content">
							   <?= $textlbl ;?>
						</div>
						<?php if($file) { ?>
						<div class="box_action">
							<a target="_blank" href="<?=$file;?>" class="btn " title="Report 2013x">Download the Leaflet</a>
						</div>
							<?php }
				endwhile;
			endif;
		?>
										<?php
					wp_reset_query();
					wp_reset_postdata();
				?>
					</div>

				</div>




	</section>

			<?php
			if (have_rows('news')):
				while (have_rows('news')) : the_row();
					$title = get_sub_field('title');
					$subtitle = get_sub_field('subtitle');
					$link = get_sub_field('link');
					$contentt = get_sub_field('content');
					$file = wp_get_attachment_url( get_sub_field('file'), true);
		?>
		<div class="box_wrapper box_turquoise square box_h_equal">
					<div class="box_inside">

						<h4><?= $subtitle ;?></h4>
						<h3><?= $title ;?></h3>
						<div class="box_content">
							<?= $contentt ;?>
						</div>
						<?php if($file) { ?>
						<div class="box_action">
							<a target="_blank" href="<?=$file;?>" class="btn">Download</a>
						</div>
						<?php } ?>
					</div>
				</div>
			<?php
				endwhile;
			endif;
		?>
						<?php
					wp_reset_query();
					wp_reset_postdata();
				?>

		<?php
//			if (have_rows('news')):
//				while (have_rows('news')) : the_row();
//					$title = get_sub_field('title');
//					$subtitle = get_sub_field('subtitle');
//					$link = get_sub_field('link');
		?>
<!--				<h3><?= $title ;?></h3>
				<p><?= $subtitle ;?></p>
				<p><?= $textlbl ;?></p>-->
		<?php
//				endwhile;
//			endif;
		?>




		</div>

</article>

<script>
	$('.content .box_wrapper.box_turquoise:nth-child(4)').removeClass('box_turquoise');
	$('.content .box_wrapper.square:nth-child(4)').addClass('box_blue');

	$('.content .box_wrapper.box_turquoise:nth-child(5)').removeClass('box_turquoise');
	$('.content .box_wrapper.square:nth-child(5)').addClass('box_img_green');


		$('.content .box_wrapper.box_turquoise:nth-child(6)').removeClass('box_turquoise');
	$('.content .box_wrapper.square:nth-child(6)').addClass('box_img_purple');

	//$('.box_wrapper:nth-child(2)').addClass('box_blue');
	//$('.box_wrapper:nth-child(2)').addClass('box_blue');
</script>
<?php
get_footer();
