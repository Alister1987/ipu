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
		<div class="gi_data"  >
			<?php// showCounter(); ?>
		</div>
		<h4 class="gi_title"  >
			<div class="ellipsis_text">
				<span><?php the_title(); ?></span>
			</div>
		</h4>
	<!-- 	<div class="gi_content">
			<div class="ellipsis_text">
				<span class="gi_content_txt">
					<span><?= $shortDesc; ?></span>
				</span>
			</div>
		</div> -->
		<div class="gi_action_hover"><i>Read</i></div>
	</a>
</div>
