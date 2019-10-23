	<?php
	$main_user = get_field('main_user');
	$id = $main_user['ID'];
	$defaultPicture = wp_get_attachment_image_src($id, 'full', true);			
	$fname = $main_user['user_firstname'];
	$lname = $main_user['user_lastname'];
	$desc = $main_user['user_description'];
	$url = get_field('avatar', 'user_'.$id);
	$profile_img = $url['url'];
	
	//*******************
	//main_user update...
	//*******************	
	foreach ($main_user as $user){
		$email = get_post_field('email_address', $user);
		$personal_details = get_post_field('personal_details', $user);
		
		$userDesc = get_post_field('bio', $user);
		$avatarTemp = get_post_field('image', $user);
		$avatar = wp_get_attachment_image_src($avatarTemp, 'full', true);		
		$pagetitle = get_post($user);
		$title = $pagetitle->post_title;

		?>
	
		<div class="lp_who">
		<div class="lpw_item">
			<div class="lpw_avatar_wrapper  ">
				<?php if( !empty($avatar[0]) && ($avatar[0] != $defaultPicture[0]) ) { ?>
					<div class="lpw_avatar" style="background-image:url('<?= $avatar[0]; ?>')"></div>
				<?php } else { ?>
				<div class="lpw_avatar"></div>
				<?php } ?>	
				<?php //the_title($user); ?>
	
			</div>
			<div class="lpw_txt">
				<span class="lpw_name">
					<?= $title; ?> 
				</span>
				<span class="lpw_description"><?= $userDesc; ?></span>
				<a href="<?= get_permalink(751); ?>" class="btn btn_grey btn_action_go" title="<?php the_title();?>">Contact information</li></a>
			</div>	
		</div>
	</div>
	<?php
	}
	?>

 