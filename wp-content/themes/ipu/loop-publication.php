<?php
    $downloadFile = wp_get_attachment_url(get_post_meta(get_the_ID(), 'files', true));
    $fileId = get_post_meta(get_the_ID(), 'files', true);

    $metatitle = get_post_meta(get_the_ID(), 'title', true);

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
    $associatedFileOne = wp_get_attachment_url(get_post_meta(get_the_ID(), 'associated_file_one', true));
    $associatedFileTwo = wp_get_attachment_url(get_post_meta(get_the_ID(), 'associated_file_two', true));

    $postPage = $wp_query->get_queried_object();
    $pagename = $postPage->post_name;
?>

<?php if($pagename == 'gm') { ?>
<div class="item g_item gi_review <?php echo $giCatClasses ?>" data-time="<?= $date; ?>" data-category="<?= $post_type; ?>" style="width: calc(25% - 14px);">
    <a href="<?=$downloadFile;?>" target="_blank" title="<?= $title; ?>">
        <div class="gi_data_sidebar_img">
            <div class="gi_data_date">
                <span class="gi_data_month"><?= get_the_date("M"); ?></span>
                <span class="gi_data_year"><?= get_the_date("y"); ?></span>
            </div>
        </div>	<!-- end  -->

        <div class="gi_data_wrapper">
            <div class="gi_data">
                <h4 class="gi_title" style="padding: 0 60px; margin-top: 20px;">
                    <div class="ellipsis_text">
                        <span><?php the_title(); ?></span>
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
    </a>
    <?php if( $associatedFileOne || $associatedFileTwo ) { ?>
            <div class="gi_download_links" style="
                <?php if( $associatedFileOne && $associatedFileTwo ) { ?>
                    top: -76px;
                    right: -21px;
                <?php } else { ?>
                    top: -46px;
                    right: -21px;
                <?php } ?>
            ">
            <?php if( $associatedFileOne ) { ?>
                <a class="gi_download_link" href="<?=$associatedFileOne;?>" target="_blank" style="font-size: 7pt;">
                    <?=basename($associatedFileOne);?>
                </a>
            <?php } ?>
            <?php if( $associatedFileTwo ) { ?>
                <a class="gi_download_link" href="<?=$associatedFileTwo;?>" target="_blank" style="font-size: 7pt;">
                    <?=basename($associatedFileTwo);?>
                </a>
            <?php } ?>
        </div>
    <?php } ?>
</div>

<?php } else { ?>
    <div class="item g_item gi_review <?php echo $giCatClasses ?>" data-time="<?= $date; ?>" data-category="<?= $post_type; ?>" >
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
                   $link_letter = $fields["display_image"];
                   $picture = wp_get_attachment_image_src($link_letter, 'medium');
                   $defaultPicture = wp_get_attachment_image_src($link, 'medium');
                ?>

               <?php if( $picture[0] ) { ?>
                   <div class="gi_cover_picture" style="background-image: url('<?= $picture[0]; ?>');"></div>
               <?php } ?>

    			<div class="gi_data_wrapper" style="width: 43% !important;">
    				<div class="gi_data">
    			        <h4 class="gi_title">
    			            <div class="ellipsis_text" style="overflow: visible;">
    			                <span><?php the_title(); ?></span>
    			            </div>
    			        </h4>
    	                <h5 class="gi_subtitle">
    	                    <div class="ellipsis_text">
    	                        <span><?php echo $fields['subtitle'];?></span>
    	                    </div>
    	                </h5>
    					<div class="gi_action_hover"><i>Download</i></div>
    				</div>
    			</div>
    		</div>
    	</a>
        <?php if( $associatedFileOne || $associatedFileTwo ) { ?>
            <?php if($picture[0]) { ?>
                <div class="gi_download_links" style="
                    <?php if( $associatedFileOne && $associatedFileTwo ) { ?>
                        top: -76px;
                        right: -352px;
                    <?php } else { ?>
                        top: -46px;
                        right: -352px;
                     <?php } ?>
                ">
            <?php } else { ?>
                <div class="gi_download_links" style="
                    <?php if( $associatedFileOne && $associatedFileTwo ) { ?>
                        top: -76px;
                        right: -30px;
                    <?php } else { ?>
                        top: -46px;
                        right: -30px;
                    <?php } ?>
                ">
            <?php } ?>
                <?php if( $associatedFileOne ) { ?>
                    <a class="gi_download_link" href="<?=$associatedFileOne;?>" target="_blank">
                        <?=basename($associatedFileOne);?>
                    </a>
                <?php } ?>
                <?php if( $associatedFileTwo ) { ?>
                    <a class="gi_download_link" href="<?=$associatedFileTwo;?>" target="_blank">
                        <?=basename($associatedFileTwo);?>
                    </a>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
<?php } ?>
