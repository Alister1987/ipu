<?php
	$image = get_field('picture');
	$logo = get_field('logo');
    $shortDesc = get_field('short_description');
?>

<div class="item g_item gi_supplier <?php echo $giCatClasses ?> <?= $post_type; ?>" data-time="<?= get_post_time(); ?>" data-category="<?= $post_type; ?> gi_<?php echo $post_type ?> <?php echo $giCatClasses ?>">
	<a href="<?= get_permalink(); ?>" title="<?php the_title(); ?> - read">
		<div class="gi_data_img" style="<?php if($image['url']){?> background: url('<?= $image;?> ');<?php }?>">
			<div class="gi_data_img_overlay">
				<div class="gi_data">
					<div class="gi_data_category"><?= $post_type; ?></div>
					<span class="gi_data_date"><?= get_the_date("d M Y"); ?></span>
				</div>
				<div class="gi_avatar" style="<?php if($logo['url']){?> background: url('<?=$logo;?> ');<?php }?>">
				</div>
			</div>
		</div>

		<div class="gi_content">
			<h4 class="gi_subtitle">
				<div class="ellipsis_text">
					<span><?= $offer; ?></span>
				</div>
			</h4>
			<h4 class="gi_title">
				<div class="ellipsis_text">
					<span><?php the_title(); ?></span>
				</div>
			</h4>
			<p class="gi_supplier">
				<?php if (!empty($fields['author'])) { ?>
					By the <?= $fields['author']; ?>
				<?php } ?>
			</p>
			<div class="gi_content_txt">
				<div class="ellipsis_text">
					<span><?= $shortDesc; ?></span>
				</div>
			</div>
		</div>
		<div class="gi_action_hover"><i>Read</i></div>
	</a>
</div>
