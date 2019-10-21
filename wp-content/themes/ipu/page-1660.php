<?php
/**
 * The Template for Product File – non members
 *
 * @package WordPress
 * @subpackage IPU
 * @since Twenty Fourteen 1.0
 */
get_header();
?>

<article id="content_wrapper">
		<aside class="sidebar two_column sb_mk_about">
			<div class="sb_wrapper sb_wrapper_stickit">		
				<div class="sb_txt"><?=get_field('left_description');?></div>		
			</div>
		</aside>	

		<div class="content lp_content eight_column mk_membership_content mk_productfile">
		
			<div class="box_wrapper box_w_green box_huge box_two_column">	
				<div class="box_inside">	
					<h4><?=get_field('subtitle');?></h4>
					<h3><?=get_field('title');?></h3>
					<div class="box_content">
						<p><?=get_field('content');?></p>				 
					</div>		
				</div>
			</div>

				
				
					<?php
						/************************************
						 *			LEFT COLUMN
						 ************************************/
						$repeater = 'product_file';
						//$button = 'button';
						//$description = get_sub_field('description');
						if (get_field($repeater)):
							while (have_rows($repeater)) : the_row();
								$title = get_sub_field('title');
								$subtitle = get_sub_field('subtitle');
								$description = get_sub_field('content');
								$attachment_id = get_sub_field('file');
								$file_url = wp_get_attachment_url($attachment_id);
								?>
					<div class="box_wrapper box_h_equal">
						<div class="box_inside">
							<h4><?=$subtitle;?></h4>
							<h3><?=$title;?></h3>
							<div class="box_content">
								<?= $description; ?>
							</div>
							<div class="box_action">
								<a href="<?= $file_url; ?>" class="btn">Download</a>	
							</div>
						</div>
					</div>	
								<?php
								wp_reset_query();
								wp_reset_postdata();
							endwhile;
						endif;

						wp_reset_query();
						wp_reset_postdata();

						/************************************
						 *			LEFT COLUMN END
						 ************************************/
						?>						
			
		
			
<!--			<div class="box_wrapper box_g_purple">	
				<div class="box_inside">	
					<h4>Hoy I'm the subtitle</h4>
					<h3>The title goes here</h3>
					<div class="box_content">
						The Review of Community Pharmacy in Ireland is a report prepared on behalf of the IPU. It gives detailed information on community pharmacy and data is collected from members of the IPU for the report. Click bellow to view the report from 2012 and 2013.
					</div>
					<div class="box_action">
						<a href="#" class="btn">Download</a>	
					</div>		
				</div>
			</div>-->

<!--
			<div class="box_wrapper box_w_green">	
				<div class="box_inside">	
					<h4>Hoy I'm the subtitle</h4>
					<h3>The title goes here</h3>
					<div class="box_content">
						The Review of Community Pharmacy in Ireland is a report prepared on behalf of the IPU. It gives detailed information on community pharmacy and data is collected from members of the IPU for the report. Click bellow to view the report from 2012 and 2013.
					</div>
					<div class="box_action">
						<a href="#" class="btn">Download</a>	
					</div>							
				</div>
			</div>	
			
			<div class="box_wrapper box_purple">	
				<div class="box_inside">	
					<h4>Hoy I'm the subtitle</h4>
					<h3>The title goes here</h3>
					<div class="box_content">
						The Review of Community Pharmacy in Ireland is a report prepared on behalf of the IPU. It gives detailed information on community pharmacy and data is collected from members of the IPU for the report. Click bellow to view the report from 2012 and 2013.
					</div>
					<div class="box_action">
						<a href="#" class="btn">Download</a>	
					</div>		
				</div>
			</div>		-->
		</div>
	</article>
 
<script>
	$('.mk_membership_content .box_wrapper:nth-child(2)').addClass('box_green');
	$('.mk_membership_content .box_wrapper:nth-child(3)').addClass('box_g_purple');
	$('.mk_membership_content .box_wrapper:nth-child(4)').addClass('box_w_green');
	$('.mk_membership_content .box_wrapper:last-child').addClass('box_purple');
	
</script>
<?php
get_footer();

