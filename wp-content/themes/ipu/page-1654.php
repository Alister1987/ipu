<?php
/**
 * The Template for Pharmacy in ireland – non members
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
				
				$repeater = 'left_content_first';
				$download = 'button';

				if (get_field($repeater)):
					while (have_rows($repeater)) : the_row();
						//$title = get_sub_field('title');
						$title = get_sub_field('title');
						$content = get_sub_field('content');
						?>
				<?php if(!empty($title)){?>
					<h3><?=$title;?></h3>
				<?php } ?>
						<p class="sb_txt"><?=$content;?></p>
						 
						 
						<?php
						if (get_field($download)):
							while (have_rows($download)) : the_row();

								$title = get_sub_field('title');
								$attachment_id = get_sub_field('file');
								$file = wp_get_attachment_url($attachment_id);
								?>
								<p><?= $title; ?></p>
								<a href='<?=$file;?>'><?= $title; ?></a>
								<?php
							endwhile;
						endif;
						wp_reset_query();
						wp_reset_postdata();
					endwhile;
				endif;
				wp_reset_query();
				wp_reset_postdata();

				?>
				
			</div>
		</aside>	

		<div class="content lp_content eight_column mk_pharmacy_content">
		
			<section class="mk_about_services">
				<div class="box_wrapper box_w_green box_huge">	
					<div class="box_inside">	
						
						<?php
								$main_content = 'main_content';
	 ?>
							<?php
								//Commitees section
									//$button = 'button';
									if (get_field($main_content)):
										while (have_rows($main_content)) : the_row();
											$title = get_sub_field('title');
											$subtitle = get_sub_field('subtitle');
											$content = get_sub_field('content');
											$link_title = get_sub_field('link_title');
											$link_address = get_sub_field('link_address');
											$logo = wp_get_attachment_image_src(get_sub_field('logo'), 'medium');
											//$attachment_id = get_sub_field('file');
											//$file = wp_get_attachment_url($attachment_id);
										//	$location = get_sub_field('location');

											?>
						
							<h4><?=$subtitle;?></h4>
						<h3><?=$title;?></h3>
						
						<div class="box_content">
						  	<?=$content;?>
						</div>	 
 
											<?php
										endwhile;
									endif;
									wp_reset_query();
									wp_reset_postdata();
								?>
						
					</div>
				</div>	

				<div class="rsb_wrapper">	
				<?php
				$green_box = 'green_box_content';
				if (get_field($green_box)):
					while (have_rows($green_box)) : the_row();
						//$title = get_sub_field('title');
						$title = get_sub_field('title');
						$subtitle = get_sub_field('subtitle');
						$content = get_sub_field('description');
						?>
					<div class="rsb_txt">		
						<h3><?=$title;?></h3>
						<p><?=$content;?></p>	
					</div>
					<?php
					endwhile;
				endif;
				wp_reset_query();
				wp_reset_postdata();

				?>
 				
				</div>
									
			</section>

			<section class="mk_about_fancy">
				<div class="mk_about_fancy_img"></div>			
			</section>

			<section class="mk_about_services mk_about_schemes">
				<div class="box_wrapper box_w_purple box_huge">	
					<div class="box_inside">	
						<?php
						$title = get_field('second_title');
						$subtitle = get_field('second_subtitle');
						?>
				<?php if(!empty($title)){?>
						<h4><?=$title;?></h4>
						
				<?php } ?>
						<h3><?=$subtitle;?></h3>
						
									 
						<ul class="box_content" >
							
				
						 
						 
							
							<?php
							if (get_field('second_content_box')):
								while (have_rows('second_content_box')) : the_row();
									$title = get_sub_field('title');
									$content = get_sub_field('content');
									?>
							 <li class="box_sub_content">
								 <h5><?= $title; ?></h5>
										<?= $content ;?>
								 
							 </li>
								 
									<?php
								endwhile;
							endif;
							wp_reset_query();
							wp_reset_postdata();?>
										
						 		</ul>
		 
								
								
								
					
				 		
					</div>
				</div>	

				<div class="rsb_wrapper">	
				<?php
				$purple_box = 'purple_box';
				if (get_field($purple_box)):
					while (have_rows($purple_box)) : the_row();
						//$title = get_sub_field('title');
						$title = get_sub_field('title');
						//$subtitle = get_sub_field('subtitle');
						$content = get_sub_field('description');
						?>
					<div class="rsb_txt">		
						<h3><?=$title;?></h3>
						<p><?=$content;?></p>	
					</div>
					<?php
					endwhile;
				endif;
				wp_reset_query();
				wp_reset_postdata();

				?>
						
				</div>
									
			</section>

			<section class="mk_about_services mk_about_school">
				<div class="box_wrapper box_g_blue box_huge">	
					<div class="box_inside">	
						<?php
//			$page = 'categoryhsecontact';
//				$subpage = 'schemess';
//				
//				if (get_field($page)):
//						while (have_rows($page)) : the_row();
//							if (have_rows($subpage)):
//								while (have_rows($subpage)) : the_row();
//								$select = get_sub_field('select');
//								$display = get_sub_field('display');
//								$id = $post->ID;
?>
						
						
						<?php
				
				$bottom_text = 'bottom_text';
				$buttons = 'buttons';

				if (get_field($bottom_text)):
					while (have_rows($bottom_text)) : the_row();
						//$title = get_sub_field('title');
						$title = get_sub_field('title');
						$subtitle = get_sub_field('subtitle');
						$content = get_sub_field('content');
						?>
						<h4><?=$subtitle;?></h4>
						<h3><?=$title;?></h3>
						
						<div class="box_content">
							<?=$content;?>
						</div>
						
					<?php
					endwhile;
				endif;
				wp_reset_query();
				wp_reset_postdata();

				?>
								
							<?php
						if (get_field('bottom_text_buttons')):
							while (have_rows('bottom_text_buttons')) : the_row();

								$title = get_sub_field('title_link');
								$address = get_sub_field('address_link');
								 
							?>
								<div class="box_action">
									<a href="<?=$address;?>" class="btn btn_action_link_blue" target="_blank"><?=$title;?>2xx</a>
								</div>	
								<?php
							endwhile;
						endif;
						wp_reset_query();
						wp_reset_postdata();
				?>
					</div>
				</div>	

				<div class="rsb_wrapper">	
			<?php
				$dark_box = 'dark_box';
				if (get_field($dark_box)):
					while (have_rows($dark_box)) : the_row();
						//$title = get_sub_field('title');
						$title = get_sub_field('title');
						//$subtitle = get_sub_field('subtitle');
						$content = get_sub_field('description');
						?>
					<div class="rsb_txt">		
						<h3><?=$title;?></h3>
						<p><?=$content;?></p>	
					</div>
					<?php
					endwhile;
				endif;
				wp_reset_query();
				wp_reset_postdata();

				?>
					<a href="#" class="btn btn_action_link_w">Trinity College Dublin </a>
						
				</div>							
			</section>

		</div>
	</article>


 


 
		 
<?php
get_footer();

