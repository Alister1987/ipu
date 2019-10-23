<?php
    $downloadFile = wp_get_attachment_url(get_post_meta(get_the_ID(), 'file', true));
/*
<div class="item g_item gi_<?php echo $post_type ?> <?php echo $giCatClasses ?>" data-time="<?= $date; ?>" data-category="<?= $post_type; ?>">
TO DO (review)
</div>
 */

$color = get_field('color') . ' ' . '!important';

		if($color == '#ffffff !important') {
			$text_color = '#5b5a68 !important';
		}



?>
<div class="item g_item gi_<?php echo $post_type ?> <?php echo $giCatClasses ?>" data-time="<?= $date; ?>" data-category="<?= $post_type; ?>">
	<a href="<?=$downloadFile;?>" target="_blank" title="<?= $title; ?>">
		<div class="gi_event_img_wrapper"> 	<!-- if the event got a picture -->
			<div class="gi_data_sidebar_img">
				<div class="gi_data_date">
					<span class="gi_data_month"><?= get_the_date("M"); ?></span>
					<span class="gi_data_year"><?= get_the_date("y"); ?></span>
				</div>
			</div>	<!-- end  -->

                        <?php
                                $link = get_page_link($article->ID);
                                $link_letter = $fields["picture"];
                                $picture = wp_get_attachment_image_src($link_letter, 'medium', true);
                                $defaultPicture = wp_get_attachment_image_src($link, 'medium', true);
                        ?>

                        <?php if( $picture[0] != $defaultPicture[0] ) { ?>
                            <div class="gi_cover_picture"  style="background-image: url('<?= $picture[0]; ?>');">
                            </div>
                        <?php } else { ?>
                            <div class="gi_cover_picture">
                            </div>
                        <?php } ?>

			<div class="gi_data_wrapper">
				<div class="gi_data"  >
					<div class="gi_data_category"><?=$post_type;?></div>
			        <h4 class="gi_title">
			            <div class="ellipsis_text">
			                <span><?= $title; ?></span>
			            </div>
			        </h4>
	                <h5 class="gi_subtitle">
	                    <div class="ellipsis_text">
	                        <span><?=$fields['subtitle'];?></span>
	                    </div>
	                </h5>
					<div class="gi_action_hover"><i>Download</i></div>
				</div>
			</div>
		</div>
	</a>
</div>
