<?php
    $link_letter = $fields['file'];
    $shortDesc = $fields['short_description'];
    $title = get_the_title();
    $pdf = wp_get_attachment_url($link_letter);
    $author = $post->author;
    // var_dump($fields);exit;

    $fileIcon = explode('.', $pdf);

    if(count($fileIcon) > 0) {
        $fileIcon = $fileIcon[count($fileIcon) - 1];
        $fileIcon = strtolower($fileIcon);
    } else {
        $fileIcon = '';
    }


    $color = get_field('color') . ' ' . '!important';

        if($color == '#ffffff !important') {
            $text_color = '#5b5a68 !important';
        }


?>

<div class="item g_item gi_<?php echo $post_type ?> <?php echo $giCatClasses ?>" data-time="<?= $date; ?>" data-category="<?= $post_type; ?>">
    <?php
    $fileSize = ipu_calculate_file_size($fields['file']);
    ?>
	<a href="<?= wp_get_attachment_url($link_letter); ?>" title="<?= $categorylbl; ?>" target="_blank">
        <?php
            $fields = get_fields();
            $priority = $fields["priority"];
       ?>
    <div class="gi_data_wrapper">
        <div class="gi_data"  >
<!--             <div class="gi_data_category"><?= $post_type; ?></div>
 -->            <h4 class="gi_title"   >
                <div class="ellipsis_text">
                    <span><?= $title; ?></span>
                </div>
            </h4>
            <?php if(!empty($author)){?>
                <span class="gi_author">
                    By <?=$author;?>
                </span>
            <?php } ?>
        </div>
        <div class="gi_data_sidebar">
            <div class="gi_data_sidebar_icon gi_icon_<?= $fileIcon ?>"></div>
            <div class="gi_data_sidebar_data"><?= $fileSize ? $fileSize : 'No File' ?> </div>

        </div>
    </div>
<!--     <div class="gi_content">
        <span class="gi_content_txt">
            <div class="ellipsis_text">
                <span><?= $shortDesc; ?></span>
            </div>
        </span>
    </div>   -->
		<?php if ($fileIcon != 'pdf'){?>
            <div class="gi_action_hover"><i>Download</i></div>
		<?php } else{ ?>
            <div class="gi_action_hover"><i>View</i></div>
		<?php } ?>
	</a>
</div>
