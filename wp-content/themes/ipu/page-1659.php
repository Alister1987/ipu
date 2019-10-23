<?php
/**
 * The Template for MEMBERSHIP – non members
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

				$repeater = 'left_column_aside';
				$download_b = 'button';

				$loopCount = 0;

				if (get_field($repeater)):
					while (have_rows($repeater)) : the_row();
						//$title = get_sub_field('title');
						$title = get_sub_field('title');
						$content = get_sub_field('content');
						
						$attachment_id = get_sub_field('file');
						$file_url = wp_get_attachment_url($attachment_id);
						$file_title = get_the_title($attachment_id);

						$url = get_sub_field('url');

						if($attachment_id)
						{
							$hasFile = true;
						}
						else
						{
							$hasFile = false;
						}

						if ($loopCount > 0)
						{
							?>
							<br /><br />
							<?php
						}
						?>
						
						<?php if(!empty($title)){?>
							<h3><?=$title;?></h3>
						<?php } ?>

						<p class="sb_txt"><?=$content;?></p>

						<?php	
						if ($hasFile)
						{ ?>			
							<a href="<?= $file_url; ?>" target="_blank" class="btn btn_action_dowload_green" title="Download form">Download</a>
							<p class="sb_txt"> </p>
							<a href="<?= get_permalink(4127);?>" class="btn btn_action_dowload_green">Apply now</a>
						<?php } else { 
							if($url)
							{
								?>
								<a href="<?= $url?>" class="btn btn_action_dowload_green">Apply now</a>
								<?php
							}
						} ?>

						<?php
						if (get_field($download_b)):
							while (have_rows($download_b)) : the_row();

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

						$loopCount++;
					endwhile;
				endif;
				wp_reset_query();
				wp_reset_postdata();

				?>



			</div>
		</aside>

		<div class="content lp_content eight_column mk_membership_content">

		<section class="mk_benefit" id="benefits">
				<div class="box_wrapper box_w_green">
					<div class="box_inside">
					 <?php

						$left_content_first = 'left_col';
						$download = 'button';

						if (get_field($left_content_first)):
							while (have_rows($left_content_first)) : the_row();
								//$title = get_sub_field('title');
								$title = get_sub_field('title');
								$subtitle = get_sub_field('subtitle');
								$content = get_sub_field('content');
								?>
								<h4><?=$subtitle?></h4>
								<h3><?=$title?></h3>
								<div class="box_content">
									<span class="box_list_nb">
										   <?=$content;?>
									</span>
								</div>

								<?php
								if (get_field($download)):
									while (have_rows($download)) : the_row();

										$title = get_sub_field('title');
										$address = get_sub_field('address');

										?>
										<p><?= $title; ?></p>
										<a href='<?=$address;?>'><?= $title; ?></a>
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
				</div>
				<div class="box_wrapper box_img_green">
					<div class="box_inside">
						<?php

				$right_col = 'right_col';
				$download_btn = 'button_reg';

				if (get_field($right_col)):
					while (have_rows($right_col)) : the_row();
						//$title = get_sub_field('title');
						$title = get_sub_field('title');
						$subtitle = get_sub_field('subtitle');
						$content = get_sub_field('content');
						$titlebtn = get_sub_field('title');
						$linkbtn = get_sub_field('content');
						$download_btn = get_sub_field('button_reg');
						?>
						<h4><?=$subtitle?></h4>
						<h3><?=$title?></h3>


						<div class="box_content">  <?=$content;?></div>
						<div class="box_action">
							   <a href="<?=$download_btn;?>" class="btn btn_si_download_grey">Apply now</a>
						</div>






					</div>
						<?php

					endwhile;
				endif;
				wp_reset_query();
				wp_reset_postdata();

				?>
			</div>

		</section>






		<section class="mk_numberz">
				<?php
				$members_legend_first = 'members_legend_first';
				if (get_field($members_legend_first)):
					while (have_rows($members_legend_first)) : the_row();
						$left = get_sub_field('left');
						$right = get_sub_field('right');
						?>
						<p><i><?= $left;?></i> <?=$right;?></p>
						<?php
					endwhile;
				endif;
				wp_reset_query();
				wp_reset_postdata();
				?>

				<?php
				$members_legend_second = 'members_legend_second';
				if (get_field($members_legend_second)):
					while (have_rows($members_legend_second)) : the_row();
						$left = get_sub_field('left');
						$right = get_sub_field('right');
						?>
						<p><i><?= $left;?></i> <?=$right;?></p>
						<?php
					endwhile;
				endif;
				wp_reset_query();
				wp_reset_postdata();
				?>
			</section>

			<section class="mk_benefit mk_fee" id="application">
				<div class="box_wrapper box_w_purple">
					<div class="box_inside">



				<?php

				$right_content_l = 'right_column_last_boxes';
				$table = 'table';

				if (get_field($right_content_l)):
					while (have_rows($right_content_l)) : the_row();
						//$title = get_sub_field('title');
						$title = get_sub_field('title');
						$subtitle = get_sub_field('subtitle');
						$content_top = get_sub_field('content_top');

						?>

						<h4><?=$subtitle?></h4>
						<h3><?=$title?></h3>



								<?php
					endwhile;
				endif;
				wp_reset_query();
				wp_reset_postdata();

				?>
						<div class="box_content">
								<p><?=$content_top;?></p>
									<span class="fee_table_wrapper">
										<div class="fee_table_header">
									<div class="fee_c_1">Membership</div>
									<div class="fee_c_2">Subscription</div>
									<div class="fee_c_3">VAT</div>
									<div class="fee_c_4">Total</div>
								</div>
									<?php

				$prices = 'prices';


				if (get_field($prices)):
					while (have_rows($prices)) : the_row();
						//$title = get_sub_field('title');
						$membership = get_sub_field('membership');
						$subscription = get_sub_field('subscription');
						$vat = get_sub_field('vat');
						$total = get_sub_field('total');

						?>


<!--								<div class="fee_table_header">
									<div class="fee_c_1">Membership</div>
									<div class="fee_c_2">Subscription</div>
									<div class="fee_c_3">VAT</div>
									<div class="fee_c_4">Total</div>
								</div>-->
								<div class="fee_table_row">
									<div class="fee_c_1"><?=$membership;?></div>
									<div class="fee_c_2"><?=$subscription;?></div>
									<div class="fee_c_3"><?=$vat;?></div>
									<div class="fee_c_4"><?=$total;?></div>
								</div>



								<?php
					endwhile;
				endif;
				wp_reset_query();
				wp_reset_postdata();

				?>

								</span>
						<p><?= get_field('small_description');?></p>
									</div>
					</div>
				</div>
				<div class="box_wrapper box_img_purple">
					<div class="box_inside">
						<?php

				$right_column_last_boxes_right= 'right_column_last_boxes_right';
				$btn_right = 'button';

				if (get_field($right_column_last_boxes_right)):
					while (have_rows($right_column_last_boxes_right)) : the_row();
						//$title = get_sub_field('title');
						$title = get_sub_field('title');
						$subtitle = get_sub_field('subtitle');
						$content = get_sub_field('content_top');
						$downloadbtn = get_sub_field('button_reg');
						$secondDownloadBtnAttachmentId = get_sub_field('second_button_reg');
						if ($secondDownloadBtnAttachmentId) {
						    $secondDownloadBtnAttachmentUrl = wp_get_attachment_url($secondDownloadBtnAttachmentId);
						}
						?>
						<h4><?=$subtitle?></h4>
						<h3><?=$title?></h3>
						<div class="box_content">

							 <?=$content;?>

						</div>

						<div class="box_action">
							<a href="<?=$downloadbtn;?>" target="_blank" class="btn btn_si_download_grey">Proprietor Brochure</a>
						</div>

						<?php
						    if ($secondDownloadBtnAttachmentUrl) {
						?>
						<div class="box_action">
							<a href="<?=$secondDownloadBtnAttachmentUrl;?>" target="_blank" class="btn btn_si_download_grey">Employee Brochure</a>
						</div>
						<?php
						    }
						?>

						<?php
						if (get_field($btn_right)):
							while (have_rows($btn_right)) : the_row();

								$title = get_sub_field('title');
								$address = get_sub_field('address');

								?>
								<p><?= $title; ?></p>
								<a href='<?=$address;?>'><?= $title; ?></a>
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
				</div>
			</section>

			<section class="mk_numberz">
				<p><?= get_field('members_legend_last');?></p>
			</section>

		</div>

	</article>




















<?php
get_footer();
