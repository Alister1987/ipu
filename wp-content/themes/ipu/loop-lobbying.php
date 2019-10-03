<div class="item g_item gi_person gi_<?= $category; ?> gi_<?= $region; ?> <?= $post_type; ?> gi_<?php echo $post_type ?> <?php echo $giCatClasses ?>" data-time="<?= $date; ?>" data-category="<?= $post_type; ?>">

	<div class="gi_data">
		<div class="gi_data_category"><?php echo get_field('category') == 'senator' ? 'Senator' : 'TD' ?></div>
        
        <?php
            $regions = array(
                "midwestern" => "Mid Western Region",
                "eastern" => " Eastern Region",
                "northwestern" => " North Western Region",
                "northestern" => " North Eastern Region",
                "southeastern" => " South Eastern Region",
                "western" => " Western Region",
                "southern" => " Southern Region",
                "midlands" => " Midlands Region"
            );
        ?>
        
		<div class="gi_data_location"><?php echo $regions[get_field('region')] ?></div>
	</div>
    <?php $contact = get_field('contact'); $contact = $contact[0]; ?>
	<div class="gi_content">
		<div class="gi_firstname"><?= $first_name; ?></div>
		<div class="gi_surname"><?= $last_name; ?></div>				
		<div class="gi_job"><?= $function; ?></div>
		<p class="gi_content_txt">
			<?php echo $contact['address']; ?>
		</p>	

	</div>		
		<?php
	if (have_rows('contact')):
		while (have_rows('contact')) : the_row();
			$email = get_sub_field('email');
			$phone = get_sub_field('phone');
			?>
			<div class="gi_action_wrapper">
				<a class="gi_btn gi_email" href="mailto:<?= $email; ?>"><?= $email; ?></a>
				<a class="gi_btn gi_phone" href="tel://<?= $phone; ?>"><?= $phone; ?></a>
			</div>
			<?php endwhile; ?>
	<?php endif; ?>
	<?php
	wp_reset_query();
	wp_reset_postdata();
	?>
</div>


