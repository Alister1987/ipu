<div class="item g_item gi_person gi_vacant gi_<?= $category; ?> gi_<?= $position; ?> gi_<?php echo $post_type ?> <?php echo $giCatClasses ?>" data-time="<?= $date; ?>" data-category="<?= $post_type; ?>">

		<div class="gi_data">
			<div class="gi_data_category">vacant</div>
			<span class="gi_data_date"><?=$date;?></span>
		</div>
		<?php
		if (have_rows('contact')):
			while (have_rows('contact')) : the_row();
				$first_name = get_sub_field('first_name');
				$last_name = get_sub_field('last_name');
				//$short_description = get_sub_field('short_description');
				//update
				$address = get_sub_field('address');
				$company = get_sub_field('company');
				$contact_name = get_sub_field('contact_person_name');
				?>


				<div class="gi_info">
					<div class="gi_info_location"><?= $address; ?></div>
					<span class="gi_info_skills"><?= $company; ?></span>
					<span class="gi_info_contact"><?= $contact_name; ?></span>
				</div>
	<?php
	//event content
	?>


	<?php
endwhile;
endif;
?> 
		<?php
		wp_reset_query();
		wp_reset_postdata();
		?>




		<div class="gi_content">
			 
			<div class="gi_firstname"><?= $fields['short_description']; ?></div>
			<!---<div class="gi_surname"><?= $fields['email']; ?></div>				
			<div class="gi_job"><?=$fields['phone'];?></div>--->
		</div>	
		<div class="gi_action_wrapper">	
			<a class="gi_btn gi_email" href="mailto:<?= $fields['email']; ?>"><?= $fields['email']; ?></a>
			<a class="gi_btn gi_phone" href="tel://<?= $fields['phone']; ?>"><?= $fields['phone']; ?></a>
		</div>
	</div>