<div class="item g_item gi_person gi_locum gi_<?= $category; ?> gi_<?=$day;?> gi_<?php echo $post_type ?> <?php echo $giCatClasses ?>" data-time="<?= $date; ?>" data-category="<?= $post_type; ?>">
	<div class="gi_data">
					<div class="gi_data_category">locum</div>
						<span class="gi_data_date"><?=$date;?></span>
					</div>
					<div class="gi_info">
						<div class="gi_info_location"><?=$address;?></div>
						<span class="gi_info_skills"><?=$domain;?></span>
					</div>
					<div class="gi_week">
						<div class="giw_day <?php if (($day == 'monday')){?> giw_day_ok <?=$day;?><?php } ?>">m</div>
						<div class="giw_day <?php if (($day == 'tuesday')){?> giw_day_ok <?=$day;?> <?php } ?>">t</div>
						<div class="giw_day <?php if (($day == 'wednsday')){?> giw_day_ok <?=$day;?> <?php } ?>">w</div>
						<div class="giw_day <?php if (($day == 'thursday')){?> giw_day_ok <?=$day;?> <?php } ?>">t</div>
						<div class="giw_day <?php if (($day == 'friday')){?> giw_day_ok <?=$day;?> <?php } ?>">f</div>
						<div class="giw_day <?php if (($day == 'saturday')){?> giw_day_ok <?=$day;?> <?php } ?>">s</div>
						<div class="giw_day <?php if (($day == 'sunday')){?> giw_day_ok <?=$day;?> <?php } ?>">s</div>
					</div>		
			
							<?php
				if (have_rows('personal_details')):
					while (have_rows('personal_details')) : the_row();
						$first_name = get_sub_field('first_name');
						$last_name = get_sub_field('last_name');
						$short_description = get_sub_field('short_description');
						$email = get_sub_field('email');
						$phone = get_sub_field('phone');
						?>
						
			 
					<div class="gi_content">
						<div class="gi_firstname"><?= $first_name; ?></div>
						<div class="gi_surname"><?= $last_name; ?></div>				
						<div class="gi_job"><?= $short_description; ?></div>
					
					<div class="gi_action_wrapper">	
						<a class="gi_btn gi_email" href="mailto:<?=$email;?>"><?=$email;?></a>
						<a class="gi_btn gi_phone" href="tel://<?= $phone; ?>"><?= $phone; ?></a>
					</div>		
						
						<?php
						//event content
						?>
						<?php
					endwhile;
				endif;
				?> 
</div>

