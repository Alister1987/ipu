<?php
		$color = get_field('color') . ' ' . '!important';

		if($color == '#ffffff !important') {
			$text_color = '#5b5a68 !important';
		}
?>

<div class="item g_item gi_page gi_<?php echo $post_type ?> <?php echo $giCatClasses ?>" data-time="<?= $date; ?>" data-category="<?= $post_type; ?>" style="background-color: <?php echo $color; ?>">
	<a href="<?php the_permalink(); ?>">
		<div class="gi_data"  >
			<div class="gi_data_category"><?= $post_type ?></div>
	        <div class="gi_title" style="background-color:<?php echo $color; ?>; color: <?php echo $text_color; ?>">
	            <div class="ellipsis_text">
	                <p><?php the_title() ?></p>
	            </div>
	        </div>
		</div>
		<div class="gi_action_hover"><i>Read</i></div>
	</a>
</div>
