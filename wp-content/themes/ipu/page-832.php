<?php
/**
 * The Template for Campaigns page ---old template
 *
 * @package WordPress
 * @subpackage IPU
 * @since Twenty Fourteen 1.0
 */
get_header();
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
 
	$shortDesc = get_field('short_description', 832);
?>

<article id="content_wrapper">
	<aside class="sidebar sb_filters two_column">
 
		<?php if(!empty($shortDesc)){?>
			<div class="sb_txt"><?= $shortDesc; ?></div>
		<?php } ?>
		<h3>Past Campaigns</h3>
 
	</aside>
	
	<div class="content lp_content eight_column lp_event content_adcampaign">
		<section class="furst_publication ">
			<?php
				/******
				 * slider content
				 ******/
			?>
			<div class="slider_event">
				<a class="unslider-arrow next"></a>				
				<ul>
		<?php 		
				if (have_rows('slider')):
					while (have_rows('slider')) : the_row();
						$title = get_sub_field('title_link');
						$subtitle = get_sub_field('subtitle');
						$link = get_sub_field('link');
						$defaultPicture = wp_get_attachment_image_src($linkdef, 'full', true);
						$picture = get_sub_field('picture');
						$logo = wp_get_attachment_image_src($picture, 'full', true);
					
			?>
					
		
					
					<?php
						//event content
					?>
					<?php if($defaultPicture[0] != $logo[0] ){?>
						<li class="slide_event" style="background-image: url('<?=$logo[0];?>');">
					<?php }else{?>
						<li class="slide_event">
					<?php }?>
							<a href='<?=$link;?>' title='<?= $title ;?>' class='btn btn_video' ><?= $title ;?></a>		
						</li>
							<?php
					endwhile;  
				endif;
			?> 
					<?php
						wp_reset_query();
						wp_reset_postdata();
					?>
				</ul>
			</div>
		</section>
		<?php
			/******
			 * slider content end
			 ******/
		?>	
				
		
		
		
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
							<div class="box_action">
								<a href="<?=$file;?>" class="btn " title="Report 2013x">Download the Leaflet</a>	
							</div>

						<?php
								endwhile;  
							endif;
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
					$file = wp_get_attachment_url( get_sub_field('file'), true);
		?>

			<div class="box_wrapper box_turquoise square box_h_equal">	
				<div class="box_inside">				
					<h4><?= $subtitle ;?></h4>
					<h3><?= $title ;?></h3>
					<div class="box_content">
						<?= $textlbl ;?>
					</div>
					<div class="box_action">
						<a href="<?=$file;?>" class="btn">Download</a>	
					</div>	
				</div>
			</div>

		<?php
				endwhile;  
			endif;
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



