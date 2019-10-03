<?php
$downloadFile = wp_get_attachment_url(get_post_meta(get_the_ID(), 'file', true));
$fileId = get_post_meta(get_the_ID(), 'file', true);

if($downloadFile == '') {
    $downloadFile = wp_get_attachment_url($fields['file']);
    $fileId = $fields['file'];
}

$fileIcon = explode('.', $downloadFile);

if(count($fileIcon) > 0) {
    $fileIcon = $fileIcon[count($fileIcon) - 1];
    $fileIcon = strtolower($fileIcon);
} else {
    $fileIcon = '';
}
$fileSize = ipu_calculate_file_size($fileId);


$color = get_field('color') . ' ' . '!important';

		if($color == '#ffffff !important') {
			$text_color = '#5b5a68 !important';
		}


?>
<div class="item g_item gi_<?php echo $post_type ?> <?php echo $giCatClasses ?>" data-time="<?= $date; ?>" data-category="<?= $post_type; ?>">
	<a href="<?= $downloadFile; ?>" title="<?= $categorylbl; ?>" target="_blank">
        <?php
            $fields = get_fields();
            $priority = $fields["priority"];
       ?>
		<div class="gi_data_wrapper">
			<div class="gi_data"  >
<!-- 				<div class="gi_data_category"><?=$post_type;?></div>
 -->				<span class="gi_data_date"><?= get_the_date("d M y"); ?></span>
				<h4 class="gi_title"  >
					<div class="ellipsis_text">
						<span><?php the_title() ?></span>
					</div>
				</h4>
				<span class="gi_author">
				<?= $fields['author'] ?>
				</span>
			</div>

			<div class="gi_data_sidebar">
				<div class="gi_data_sidebar_icon gi_icon_<?= $fileIcon ?>"></div>
				<div class="gi_data_sidebar_data"><?= $fileSize ?></div>

			</div>
		</div>

<!-- 		<div class="gi_content">
			<span class="gi_content_txt">
				<div class="ellipsis_text">
					<span><?= $shortDesc; ?></span>
				</div>
			</span>
		</div>  -->
		<?php if ($fileIcon != 'pdf'){?>
            <div class="gi_action_hover"><i>Download</i></div>
		<?php } else{ ?>
            <div class="gi_action_hover"><i>View</i></div>
		<?php } ?>
	</a>
</div>
