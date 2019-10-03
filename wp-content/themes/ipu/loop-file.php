<?php
$downloadFile = wp_get_attachment_url(get_post_meta(get_the_ID(), 'files', true));
$fileId = get_post_meta(get_the_ID(), 'files', true);

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
$selectedColor = get_field('color');


//csv mod
if(strtolower(pathinfo($downloadFile, PATHINFO_EXTENSION)) == "csv"){
	$downloadFile = get_the_permalink(get_the_ID());

}

$target = "_self";

$new_tab = get_post_meta(get_the_ID(), 'new_tab', true);

if($new_tab == '' || $new_tab == true) {
	$target = "_blank";
}
?>

<div class="item g_item gi_<?php echo $post_type ?> <?php echo $giCatClasses ?> gi_file_<?=$fileIcon;?>"  data-time="<?= $date; ?>" data-category="<?= $post_type; ?>" >
    <a href="<?= $downloadFile; ?>" title="<?= $categorylbl; ?>" target="<?php echo $target ?>">
		<?php
		$fields = get_fields();
		$priority = $fields["priority"];
		?>
        <div class="gi_data_wrapper">
            <div class="gi_data" <?php if($selectedColor) { ?> style="background-color: <?php echo $selectedColor; ?>" <?php } ?>>
                <!-- 				<div class="gi_data_category" data-category="<?= $post_type; ?>"><?= $post_type; ?></div>
 -->				<h4 class="gi_title"  >
                    <div class="ellipsis_text_file">
                        <span><?php the_title(); ?></span>
                    </div>
                </h4>
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
		</div> -->
		<?php if ($fileIcon != 'pdf'){?>
            <!--             <div class="gi_action_hover"><i>Download</i></div>
			 -->		<?php } else{ ?>
            <!--             <div class="gi_action_hover"><i>View</i></div>
			 -->		<?php } ?>
    </a>
</div>
