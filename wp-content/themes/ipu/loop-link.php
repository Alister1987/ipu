<?php
		$color = get_field('color') . ' ' . '!important';

		if($color == '#ffffff !important') {
			$text_color = '#5b5a68 !important';
		}

 ?>

<div class="item g_item gi_<?php echo $post_type ?> <?php echo $giCatClasses ?>" data-time="<?= $date; ?>" data-category="<?= $post_type; ?>">
	<?php
		$link = get_field('link_address');
	?>
	<a href="<?= $link; ?>" title="<?= $categorylbl; ?>" target="_blank">
		<div class="gi_data"   >
<!-- 			<span class="gi_data_date"><?= get_the_date("d"); ?> <?= get_the_date("M"); ?> <?= get_the_date("y"); ?></span>
 -->		</div>
        <h4 class="gi_title"  >
            <div class="ellipsis_text">
                <span><?= $title; ?></span>
            </div>
        </h4>
<!-- 		<div class="gi_content">
	        <h6 class="gi_content_txt">
	            <div class="ellipsis_text">
	                <span><?= $shortDesc; ?></span>
	             </div>
	        </h6>
		</div> -->
		<div class="gi_action_hover"><i><?= $link; ?></i></div>
	</a>
</div>
