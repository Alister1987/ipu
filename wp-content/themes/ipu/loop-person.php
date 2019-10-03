<?php
$link_letter = $fields["image"];
$picture = wp_get_attachment_image_src($link_letter, 'full', true);
$cats = $fields['category'];
$id = get_the_ID();
$defaultPicture = wp_get_attachment_image_src($linkdef, 'full', true);

$pageid = get_post_meta($id, 'ipu_page', true);

 
?>



<div class=" item g_item gi_person gi_<?= $color; ?> gi_<?= $category; ?> gi_<?php echo $post_type ?> <?php echo $giCatClasses ?> <?php if($pageid == '751'){?>gi_staff<?php } ?>


	<?php 
	 $taxonomies = get_the_terms($post->ipu_page, 'ipu_resource_category' );
	 foreach($taxonomies as $taxn) {
		 if(in_array($taxn->term_id, $giCategoryList)) {
	?>
		gi_<?php echo $taxn->name; ?>
	<?php
		 }
	 }
	?>

  " data-time="<?= $date; ?>" data-category="<?= $post_type; ?>">
	<div class="gi_data">
	<?php 
	 $taxonomies = get_the_terms($post->ipu_page, 'ipu_resource_category' );
	 foreach($taxonomies as $taxn) {
		 if(in_array($taxn->term_id, $giCategoryList)) {
	?>
		<div class="gi_data_category gi_person_category"><?php echo $taxn->name; ?></div>
	<?php
		 }
	 }
	?>

	

	</div>
	<div class="gi_content">
		<?php if( $picture[0] != $defaultPicture[0] ) { ?>
				<div class="gi_avatar" <?php if($picture[0]){ ?>style="background: url('<?= $picture[0]; ?>');" <?php } ?>></div>
			<?php }else{ ?>
				<div class="gi_avatar"></div>
			<?php } ?>
		<?php
			if (have_rows('personal_details')):
				while (have_rows('personal_details')) : the_row();
					$first_name = get_sub_field('first_name');
					$last_name = get_sub_field('last_name');
					$function = get_sub_field('function');
					?>
					<div class="gi_firstname"><?= $first_name; ?></div>
					<div class="gi_surname"><?= $last_name; ?></div>				
					<div class="gi_job"><?= $function; ?></div>
					<?php
					//event content
					?>
					<div class="gi_action_wrapper">
					<a class="gi_btn gi_email" href="mailto:<?=$fields['email_address'];?>"><?=$fields['email_address'];?></a>
						<?php if(!empty($fields['contact_number'])){?>
							<a class="gi_btn gi_phone" href='tel://<?= $fields['contact_number']; ?>' title='<?= $fields['contact_number']; ?>'><?= $fields['contact_number']; ?></a>		
						<?php } ?>
					</div>
						<?php
				endwhile;
			endif;
			?> 		
	</div>									
</div>	