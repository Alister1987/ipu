<?php
		$color = get_field('color') . ' ' . '!important';

		if($color == '#ffffff !important') {
			$text_color = '#5b5a68 !important';
		}
?>

<div class="item g_item_equal g_item gi_<?php echo $post_type ?> <?php echo $giCatClasses ?> <?= $ipuCat; ?>" data-time="<?= $date; ?>" data-category="<?= $post_type; ?>">
    <a href="<?= get_permalink(); ?>" title="<?= $categorylbl; ?>">
        <?php
            $fields = get_fields();
            $priority = $fields["priority"];
       ?>
		<div class="gi_data"  >
<!--			<span class="gi_data_date"><?= get_the_date("d M y"); ?></span>-->
		</div>
		<h4 class="gi_title"  >
			<div class="ellipsis_text">
				<span><?php the_title(); ?></span>
			</div>
		</h4>
<!-- 		<div class="gi_content">
			<span class="gi_content_txt">
				<div class="ellipsis_text">
					<span><?= $shortDesc; ?></span>
				</div>
			</span>
		</div> -->
<!-- 		<div class="gi_action_hover"><i>Read</i></div>
 -->	</a>
</div>