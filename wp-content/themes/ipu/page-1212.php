<?php
/**
 * The Template for ABOUT IPU - GENERAL INFORMATION
 *
 * @package WordPress
 * @subpackage IPU
 * @since Twenty Fourteen 1.0
 */
get_header();
?>
<div class='left'>
<?php
/************************************
 *			LEFT COLUMN
 ************************************/
$repeater = 'left_column';
$button = 'button';
$description = get_sub_field('description');
if (get_field($repeater)):
	while (have_rows($repeater)) : the_row();
		//$title = get_sub_field('title');
		$description = get_sub_field('description');
		$attachment_id = get_sub_field('file');
		$file_url = wp_get_attachment_url($attachment_id);
		 
		?>
		<h1><?= $file_url; ?></h1><br/>
		<p><?= $description; ?></p>
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
		
</div>
<div class='right'>
		
		<div class='first'>
			<?php
			/************************************
			 *			RIGHT COLUMN
			 ************************************/
			//$repeater = 'left_column';
			//$button = 'button';

			//first section

				while (have_posts()): the_post(); 
					$fields = get_fields();
					$title = $fields["title"];
					//$subtitle = $fields["subtitle"];
					//$logo = wp_get_attachment_image_src(get_field('logo'), 'medium');
					//$quote = $fields["quote"];
					$content = $fields["content"];
					//$short_description = $fields["short_description"];
					//$subtitle_article = $fields["subtitle_article"];
					?>
				 
					<h1><?= $title; ?></h1><br/>
					<p><?= $content; ?></p>
					<?php
				endwhile;
			wp_reset_query();
			wp_reset_postdata();
			?>
		</div>


	<div class='second'>
		<?php
		//Commitees section
			$address = 'address';
			if (get_field($address)):
				while (have_rows($address)) : the_row();
					$title = get_sub_field('title');
					$location = get_sub_field('location');
					$phone = get_sub_field('phone');
					$fax = get_sub_field('fax');
					$email = get_sub_field('email');
					$open_hours = get_sub_field('open');
				//	$location = get_sub_field('location');
					
					?>
					<h1><?= $title; ?></h1><br/>
					<p><?= $phone; ?></p>
					<p><?= $fax; ?></p>
					<p><?= $email; ?></p>
					<p><?= $open_hours; ?></p>
					<p><?= $location['location']; ?></p>
					<?php
				endwhile;
			endif;
			wp_reset_query();
			wp_reset_postdata();
		?>
	</div>

	<div class='right-section-people'>

		<?php
		$info = 'information';
		if (get_field($info)):
			while (have_rows($info)) : the_row();
				$title = get_sub_field('title');
				$phone = get_sub_field('phone');
				$fax = get_sub_field('fax');
				$email = get_sub_field('email');
		 
				?>
				 
				<h1><?= $title; ?></h1><br/>
				<h2><?= $phone; ?></h2><br/>
				<h2><?= $fax; ?></h2><br/>
				<h2><?= $email; ?></h2>

				 <?php
			endwhile;
		endif;
		wp_reset_query();
		wp_reset_postdata();


	/************************************
	 *			RIGHT COLUMN END
	 ************************************/
	?>

	</div>
					
</div>	
					
					
					----
					
					
					
					just some contente
					
					
					------
<?php
get_footer();

