<?php
/**
 * The Template for Contact page - non members
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
			<?php
			/**********************************
			 * 			LEFT COLUMN
			 * ********************************/
			$repeater = 'left_column';
			$button = 'button';
			$description = get_sub_field('description');
			if (get_field($repeater)):
				while (have_rows($repeater)) : the_row();
					$description = get_sub_field('description');
					$attachment_id = get_sub_field('file');
					$file_url = wp_get_attachment_url($attachment_id);
					?>
					<div class="sb_txt"><?= $description; ?></div>

<!--					<a href="<?= $file_url; ?>" class="btn btn_action_dowload_purple">Download</a>-->
					<?php
					wp_reset_query();
					wp_reset_postdata();
				endwhile;
			endif;

			wp_reset_query();
			wp_reset_postdata();

			/**********************************
			 * 			LEFT COLUMN END
			 * ********************************/
			?>	 
		</div>
	</aside>	
		<div class="content lp_content eight_column mk_contact_content">
			<section class="mk_contact">
				<div class="box_wrapper box_w_purple">	
					<div class="box_inside">	
						<h4>Contact</h4>	
					<?php
						/************************************
						 *			RIGHT COLUMN
						 ************************************/
							while (have_posts()): the_post(); 
								$fields = get_fields();
								$title = $fields["title"];
								$content = $fields["content"];
								?>
								<h3><?= $title; ?></h3>
								<div class="box_content">
									<p><?= $content; ?></p>
								</div>	
								<?php
							endwhile;
							wp_reset_query();
							wp_reset_postdata();
					?>				
					</div>		
				</div>	
				
				<div class="mk_contact_form">	
					<?= do_shortcode('[contact-form-7 id="4024" title="Contact us"]');?>
				</div>	
			</section>		
			


			<section class="mk_info">
				<div class="box_wrapper box_w_blue box_huge">	
					<div class="box_inside">	
						<h4><?= get_field('information_subtitle'); ?></h4>
						<h3><?= get_field('information_title'); ?></h3>
						<div class="box_content">
							<div class="box_content_left full-width">	
								
<?php 
// Get repeater value
$infos = get_field('information');

// Obtain list of columns
foreach ($infos as $key => $row) {
	$title[$key] = $row['title'];
	$phone[$key] = $row['phone'];
	$fax[$key] = $row['fax'];
	$email[$key] = $row['email'];
}

// Sort the data by restaurant name column, ascending
array_multisort($title, SORT_ASC, $infos);
//print_r($repeateri);
// Display newly orded columns
// Unsure if this is the optimal way to do this...
foreach( $infos as $row ) { 
	//print_r($row['title']);
	?>					
								
	<div class="box_sub_content">
		<h5><?php echo $row['title']; ?></h5>
		<div class="contact_details"><b>Tel</b> <?php echo $row['phone']; ?></div>		
		<div class="contact_details"><b>Fax</b> <?php echo $row['fax']; ?></div>
		<div class="contact_details"><b>Email</b> <a href="mailto:<?php echo $row['email']; ?>"><?php echo $row['email']; ?></a></div>
	</div>				
<?php } ?>
								
								
								
								<?php
//								$info = 'information';
//								if (get_field($info)):
//									while (have_rows($info)) : the_row();
//										$title = get_sub_field('title');
//										$phone = get_sub_field('phone');
//										$fax = get_sub_field('fax');
//										$email = get_sub_field('email');
										?>
<!--										<div class="box_sub_content">
											<h5><?php // echo $title; ?></h5>
											<div class="contact_details"><b>Tel</b> <?php// echo $phone; ?></div>		
											<div class="contact_details"><b>Tel</b> <?php// echo $fax; ?></div>
											<div class="contact_details"><b>Email</b> <a href="mailto:<?php //echo $email; ?>"><?php// echo $email; ?></a></div>
										</div>-->
										<?php
//									endwhile;
//								endif;
								wp_reset_query();
								wp_reset_postdata();
								/***********************************
								 * 			RIGHT COLUMN END
								 ***********************************/
								?>
							</div>	
						</div>
					</div>						
				</div>
			</section>

			<section class="mk_map_wrapper">
				<div class="mk_map">	
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d19075.747841732802!2d-6.284945944994017!3d53.29905573112077!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48670b93b6dbf977%3A0x92ff365fdae33d69!2sIrish+Pharmacy+Union!5e0!3m2!1sen!2sie!4v1420539953870" width="100%" height="500" frameborder="0" style="border:0"></iframe>
				</div>	
				<div class="box_wrapper box_g_green">	
					<div class="box_inside">	 
					<?php
						//Location Informations
						$address = 'address';
						if (get_field($address)):
							while (have_rows($address)) : the_row();
								$title = get_sub_field('title');
								$location = get_sub_field('location');
								$phone = get_sub_field('phone');
								$fax = get_sub_field('fax');
								$email = get_sub_field('email');
								$open_hours = get_sub_field('open');
								$applyNow = get_sub_field('button_apply');
								?>
									<h3><?= $title; ?></h3>
									<div class="box_content">
										<div class="box_sub_content">
											<p><?= $location['address']; ?></p>
										</div>	
										<div class="box_sub_content">
											<div class="contact_details"><b>Tel</b> <?= $phone; ?></div>		
											<div class="contact_details"><b>Fax</b> <?= $fax; ?></div>
											<div class="contact_details"><b>Open</b> <?= $open_hours; ?></div>
										</div>	
									</div>
<!--									<div class="box_action">
										<a href="<?=$applyNow;?>" class="btn btn_si_download_grey" target="_blank">Apply now!</a>	
									</div>	-->
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

