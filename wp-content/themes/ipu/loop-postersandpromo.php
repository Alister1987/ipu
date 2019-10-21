<?php
    $fileId = get_field('upload_file');

    $fileIcon = explode('.', $viewFile);

    if(count($fileIcon) > 0) {
        $fileIcon = $fileIcon[count($fileIcon) - 1];
        $fileIcon = strtolower($fileIcon);
    } else {
        $fileIcon = '';
    }

    $fileSize = ipu_calculate_file_size($fileId);
	$def = 'img/antibiotic.jpg';
	$link = get_page_link($article->ID);
	$link_letter = $fields["image"];
	$picture = wp_get_attachment_image_src($link_letter, 'full', true);
	$defaultPicture = wp_get_attachment_image_src($link, 'full', true);
	$type = get_post_type();


		$color = get_field('color') . ' ' . '!important';

		if($color == '#ffffff !important') {
			$text_color = '#5b5a68 !important';
		}
?>


<div class="item g_item gi_poster gi_<?php echo $post_type ?> <?php echo $giCatClasses ?>" data-time="<?= $date; ?>" data-category="<?= $post_type; ?>">
	<a href="<?= $viewFile; ?>" title="<?= $categorylbl; ?> - read" target="_blank">
        <?php
            $fields = get_fields();
            $priority = $fields["priority"];
       ?>
		<?php if( $picture[0] != $defaultPicture[0] ) { ?>
			<div class="gi_cover_picture">
				<img src="<?= $picture[0];?>" alt="IPU" class="logo_header">
			</div>
		<?php } ?>
		<span class="gi_wrapper_content">
			<div class="gi_data_wrapper">
				<div class="gi_data"  >
			        <h4 class="gi_title"  >
			            <div class="ellipsis_text">
			                <span><?= get_the_title(); ?></span>
			            </div>
		    	    </h4>
				</div>

				<div class="gi_data_sidebar">
					<div class="gi_data_sidebar_icon gi_icon_<?= $fileIcon ?>"></div>
					<div class="gi_data_sidebar_data"><?= $fileSize ?></div>

				</div>
			</div>
<!--
			<div class="gi_content">
				<span class="gi_content_txt">
					<?= $shortDesc; ?>
				</span>
			</div>	 -->
			<div class="gi_action_hover"><i>Download</i></div>
		</span>
	</a>
</div>
