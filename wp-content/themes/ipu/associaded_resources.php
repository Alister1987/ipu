<?php foreach ($priority as $article) { ?>
	<?php
	$post_type = $article->post_type;
	$post_title = $article->post_type;
	$link = get_page_link($article->ID);
	//  $title = get_page_title())
	//$author = the_field('author', $article->ID);
 //	print_r($article->ID);
	
//	print_r( $article->author);
	?>
	<?php if ($post_type == 'article') {
		
		 
		
		?>
		<div class="g_item gi_article <?= $post_type; ?>">
			<div class="gi_cover_picture"></div>
			<div class="gi_data_wrapper">		
				<div class="gi_data_sidebar">
					<div class="gi_data_date">
						<span class="gi_data_day"><?= $day; ?></span>
						<span class="gi_data_month"><?= $month; ?></span>
					</div>	
				</div>			
				<div class="gi_data">
					<div class="gi_data_category"><?= $post_type; ?></div>
					<div class="gi_data_number">42</div>
					<h4 class="gi_title">
						<?= $article->post_title; ?>
						<?php //	print_r($article); ?>
					</h4>	
					<span class="gi_author">
						By <?= $author; ?>
					</span>				
				</div>
			</div>
			<div class="gi_content">
				<span class="gi_content_txt">
					<?= $article->short_description; ?>
				</span>
			</div>	
			<a href="<?= $link; ?>" class="gi_btn" title="<?= $article->title; ?>">View</a>	
		</div>
	<?php } ?>
<?php } ?>


<?php foreach ($priority as $sop) { ?>
	<?php
	$post_type = $sop->post_type;
	$link = get_page_link($sop->ID);
	$purpose = $sop->purpose;
	$scope = $sop->scope;
	$responsibility = $sop->responsibility;
	
	?>
	<?php if ($post_type == 'sop') { ?>
		<div class="g_item gi_sop">
			<div class="gi_data">
				<div class="gi_data_category"><?= $post_type; ?></div>
				<span class="gi_data_date"><?= $dateR; ?></span>
			</div>
			<h4 class="gi_title">
				<?= $sop->title; ?>
			</h4>
<!--			<div class="gi_content_picture"></div>-->
			<div class="gi_content">
			<?php if( $purpose ) { ?>
				<p class="gi_content_title">Purpose</p>
				<span class="gi_content_txt"><?= $purpose; ?></span>
			<?php } ?>
			<?php if( $scope ) { ?>
				<p class="gi_content_title">Scope</p>
				<span class="gi_content_txt"><?= $scope; ?></span>
			<?php } ?>
			<?php if( $responsibility ) { ?>
				<p class="gi_content_title">Responsibility</p>
				<span class="gi_content_txt"><?= $responsibility; ?></span>
			<?php } ?>
			</div>	
			<a href="<?= $link; ?>" class="gi_btn">Read</a>
		</div>
	<?php } ?>
<?php } ?>


<?php foreach ($priority as $guideline) { ?>
	<?php
	$post_type = $guideline->post_type;
	$link = get_page_link($guideline->ID);
	?>
	<?php if ($post_type == 'guideline') { ?>
		<div class="g_item gi_guideline">
			<div class="gi_data">
				<div class="gi_data_category"><?= $post_type; ?></div>
				<div class="gi_data_number">42</div>
				<span class="gi_data_date"><?= $dateR; ?></span>
			</div>
			<h4 class="gi_title">
				<?= $guideline->title; ?>
			</h4>
			<div class="gi_content">
				<span class="gi_content_txt">
					<?= $guideline->short_description; ?>
				</span>
			</div>	
			<a href="<?= $link; ?>" class="gi_btn">Read</a>
		</div>
	<?php } ?>
<?php } ?>

<?php foreach ($priority as $faq) { ?>
	<?php
	$post_type = $faq->post_type;
	$link = get_page_link($faq->ID);
	$title = get_the_title($faq->ID);
	?>
	<?php if ($post_type == 'faq') { ?>
		<div class="g_item gi_faq">
			<div class="gi_data">
				<div class="gi_data_category"><?= $post_type; ?></div>
				<div class="gi_data_number">42</div>
				<span class="gi_data_date"><?= $dateR; ?></span>
			</div>
			<h4 class="gi_title">
				<?= $title; ?>
			</h4>
			<div class="gi_content">
				<span class="gi_content_txt"><?= $faq->short_description; ?></span>
			</div>	
			<a href="<?= $link; ?>" class="gi_btn" title="<?= $faq->title; ?>">Read</a>	
		</div>
	<?php } ?>
<?php } ?>


<?php foreach ($priority as $files) { ?>
	<?php
	$post_type = $files->post_type;
	//$title = $files->post_title; 
	//$title = the_title($files->post_title);
	$link = ($files->ID);

	$link_file = $files->files;
	$title = get_the_title($files->ID);
	$pdf = wp_get_attachment_url($link_file);
	// $downF =  get_permalink( $files->ID );
	?>
	<?php
	if ($post_type == 'file') {
		//$downloadFile = wp_get_attachment_url(get_post_meta(get_the_ID(), 'files', true));
		//$title = get_field('')

		$pdf = wp_get_attachment_url(get_post_meta($link_file, 'files', true));
		//print_r($pdf);
		?>

		<div class="g_item gi_file">
			<div class="gi_data_wrapper">		
				<div class="gi_data">
					<div class="gi_data_category"><?= $post_type; ?></div>
					<span class="gi_data_date"><?= $dateR; ?></span>
					<h4 class="gi_title">
						<?= $title; ?>
					</h4>				
				</div>

				<div class="gi_data_sidebar">
					<div class="gi_data_sidebar_icon"></div>
					<div class="gi_data_sidebar_data">533kb</div>

				</div>
			</div>

			<div class="gi_content">
				<span class="gi_content_txt">
		<?= $files->short_description; ?>
		<?= wp_get_attachment_metadata($link_file); ?>
		<?= wp_get_attachment_metadata($link_file, $unfiltered = true); ?>
				</span>
			</div>	
			<a href="<?= wp_get_attachment_url($link_file); ?>" class="gi_btn" title="<?= $pdf; ?>">Download</a>		
		</div>
	<?php } ?>
<?php } ?>
