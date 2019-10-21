<div class="item g_item gi_page gi_<?php echo $post_type ?> <?php echo $giCatClasses ?>" data-time="<?= $date; ?>" data-category="<?= $post_type; ?>">
	<a href="<?php the_permalink(); ?>">		
		<div class="gi_data">
			<div class="gi_data_category"><?= $post_type ?></div>
			<p><?php the_title() ?></p>						
		</div>	
		<div class="gi_action_hover"><i>Read</i></div>
	</a>	
</div>