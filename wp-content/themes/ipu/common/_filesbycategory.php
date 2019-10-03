
				
<?php if ($post_type == 'article') { ?>
	<div class="item g_item gi_article xx" data-time="<?= $date; ?>" data-category="<?= $post_type; ?>">
		<div class="gi_cover_picture"></div>
		<div class="gi_data_wrapper">		
			<div class="gi_data_sidebar">
				<div class="gi_data_date">
					<span class="gi_data_day"><?= get_the_date("d"); ?></span>
					<span class="gi_data_month"><?= get_the_date("M"); ?></span>
				</div>	
			</div>			
			<div class="gi_data">
				<div class="gi_data_category"><?= $post_type; ?> </div>
				<?php showCounter(); ?>
				<h4 class="gi_title">
					<?php the_title(); ?>
				</h4>	
				<span class="gi_author">
					<?php if (!empty($author)) { ?>
						By <?= $author; ?>
					<?php } ?>
				</span>				
			</div>
		</div>
		<div class="gi_content">
			<span class="gi_content_txt">
				<?= $shortDesc; ?>
			</span>
		</div>	
		<a href="<?php the_permalink(); ?>" class="gi_btn" title="<?= $categorylbl; ?> - view">View</a>	
	</div>
<?php } ?>

<?php if ($post_type == 'faq') { ?>
	<div class="item g_item gi_faq " data-time="<?= $date; ?>" data-category="<?= $post_type; ?>">
		<div class="gi_data">
			<div class="gi_data_category" data-category="<?= $post_type; ?>"><?= $post_type; ?></div>
			<?php showCounter(); ?>
			<span class="gi_data_date"><?= get_the_date("d M y"); ?></span>
		</div>
		<h4 class="gi_title">
			<?php the_title(); ?>
		</h4>
		<div class="gi_content">
			<span class="gi_content_txt"><?= $shortDesc; ?></span>
		</div>	
		<a href="<?php the_permalink(); ?>" class="gi_btn" title="<?= $title; ?> - read">Read</a>			
	</div>
<?php } ?>

<?php if ($post_type == 'file') { ?>
	<?php
		$downloadFile = wp_get_attachment_url(get_post_meta(get_the_ID(), 'files', true));
	?>
	<div class="item g_item gi_file"  data-time="<?= $date; ?>" data-category="<?= $post_type; ?>" >
		<div class="gi_data_wrapper">		
			<div class="gi_data">
				<div class="gi_data_category" data-category="<?= $post_type; ?>"><?= $post_type; ?></div>
				<span class="gi_data_date"><?= get_the_date("d M y"); ?></span>
				<h4 class="gi_title">
					<?php the_title(); ?>
				</h4>				
			</div>
			<div class="gi_data_sidebar">
				<div class="gi_data_sidebar_icon"></div>
				<div class="gi_data_sidebar_data">533kb</div>

			</div>
		</div>

		<div class="gi_content">
			<span class="gi_content_txt">
				<?= $shortDesc; ?>
			</span>
		</div>	
		<a href="<?= $downloadFile; ?>" class="gi_btn" title="<?= $title; ?> - read">Download</a>		
	</div>
<?php } ?>


<?php
if ($post_type == 'sop') {
	$purpose = $fields["purpose"];
	$scope = $fields["scope"];
	$responsibility = $fields["responsibility"];
	?>
	<div class="item brick g_item gi_sop" data-state="move"  data-time="<?= $date; ?>"  data-category="<?= $post_type; ?>">
		<div class="gi_data">
			<div class="gi_data_category" data-category="<?= $post_type; ?>"><?= $post_type; ?></div>
			<span class="gi_data_date"><?= get_the_date("d M y"); ?></span>
		</div>
		<h4 class="gi_title">
	<?php the_title(); ?>
		</h4>
		<!--							<div class="gi_content_picture"></div>-->
		<div class="gi_content">
	<?php if ($purpose) { ?>
				<p class="gi_content_title">Purpose</p>
				<span class="gi_content_txt"><?= $purpose; ?></span>
			<?php } ?>
	<?php if ($scope) { ?>
				<p class="gi_content_title">Scope</p>
				<span class="gi_content_txt"><?= $scope ?></span>
			<?php } ?>
	<?php if ($responsibility) { ?>
				<p class="gi_content_title">Responsibility</p>
				<span class="gi_content_txt"><?= $responsibility; ?></span>
	<?php } ?>

		</div>	
		<a href="<?= get_permalink(); ?>" class="gi_btn" title="<?= $categorylbl; ?> - read">Read</a>

	</div>
<?php } ?>


<?php if ($post_type == 'guideline') { ?>
	<div class="item g_item gi_link"  data-time="<?= $date; ?>"  data-category="<?= $post_type; ?>">
		<div class="gi_data">
			<div class="gi_data_category" data-category="<?= $post_type; ?>">Guideline</div>
			<span class="gi_data_date"><?= get_the_date("d M y"); ?></span>
		</div>
		<h4 class="gi_title">
	<?php the_title(); ?>
		</h4>
		<div class="gi_content">
			<span class="gi_content_txt">
	<?= $shortDesc; ?>
			</span>
		</div>	
		<a href="<?php the_permalink(); ?>" class="gi_btn"><?php the_title(); ?></a>

	</div>
<?php } ?>

<?php

//	foreach ($priority as $poster) {  
//		$post_type = $poster->post_type;
//		$post_title = $poster->post_title;
//		$def = 'img/antibiotic.jpg';
//	
//		$link = ($poster->ID);
//		
//		$title = get_the_title($poster->ID);
//		
//		
//		$linkdef = get_page_link($poster->ID);
//		$link_letter = $poster->image;
//		
//		} 
	?>
<?php 
$link_file = $fields["upload_file"];
$short_description = $fields["short_description"];
$files = wp_get_attachment_url(get_post_meta($link_file, 'files', true));

$link_letter = $fields["image"];
$picture = wp_get_attachment_image_src($link_letter, 'full', true);
$defaultPicture = wp_get_attachment_image_src($linkdef, 'full', true);
$def = 'img/antibiotic.jpg';


?>
	<?php if ($post_type == 'postersandpromo') { 
		?>
		<div class="g_item gi_poster">
			<?php if( $picture[0] != $defaultPicture[0] ) { ?>
				<div class="gi_cover_picture">
					<img src="<?= $picture[0];?>" alt="IPU" class="logo_header">
				</div>
			<?php } else { ?>
				<div class="gi_cover_picture">
					<img src="<?php bloginfo('template_directory'); ?>/<?=$def;?>" alt="IPU" class="logo_header">
				</div>
			<?php } ?>	
			<div class="gi_data_wrapper">		
				<div class="gi_data">
					<div class="gi_data_category">Poster</div>
					<span class="gi_data_date"><?= $dateR; ?></span>
					<h4 class="gi_title">
						<?=$post_title;?>
					</h4>				
				</div>

				<div class="gi_data_sidebar">
					<div class="gi_data_sidebar_icon"></div>
					<div class="gi_data_sidebar_data">533kb</div>
				</div>
			</div>

			<div class="gi_content">
				<span class="gi_content_txt">
					<?= $short_description; ?>
				</span>
			</div>	
		<a href="<?= wp_get_attachment_url($link_file); ?>" class="gi_btn" title="<?= $post_title; ?> - download file">Download</a>		
		</div>
	<?php } ?>


