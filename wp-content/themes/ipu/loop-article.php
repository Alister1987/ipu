<?php
        $color = get_field('color') . ' ' . '!important';

        if($color == '#ffffff !important') {
            $text_color = '#5b5a68 !important';
        }
?>

<div class="item g_item gi_<?php echo $post_type ?> <?php echo $giCatClasses ?>" data-time="<?= $date; ?>" data-category="<?= $post_type; ?>">
	<a href="<?= get_permalink(); ?>" title="<?= $categorylbl; ?>">
        <?php
            $fields = get_fields();
            $priority = $fields["priority"];
       ?>
    	<?php
    		$link = get_page_link($article->ID);
    		$link_letter = $fields["picture"];
    		$picture = wp_get_attachment_image_src($link_letter, 'medium', true);
    		$defaultPicture = wp_get_attachment_image_src($link, 'medium', true);
    	?>

        <?php if( $picture[0] != $defaultPicture[0] ) { ?>
			<div class="gi_cover_picture" style="background-image: url('<?= $picture[0]; ?>');"></div>
		<?php } ?>

        <span class="gi_wrapper_content">
            <div class="gi_data_wrapper">
                <div class="gi_data_sidebar">
                </div>
                <div class="gi_data"  >
                    <?php showCounter(); ?>
                    <span class="gi_data_date"><?= get_the_date("d M y"); ?></span>
                    <h4 class="gi_title"  >
                        <div class="ellipsis_text">
                            <span><?php the_title(); ?></span>
                        </div>
                    </h4>
                    <!-- <span class="gi_author">
                        <?php if (!empty($author)) { ?>
                            By <?= $author; ?>
                        <?php } ?>
                    </span> -->
                </div>
            </div>
            <div class="gi_action_hover"><i>Read</i></div>
        </span>
	</a>
</div>
