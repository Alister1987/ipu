jQuery(function() {	
	// initialise masonry
	var $container = jQuery('#grid');
	$container.masonry({
		itemSelector: '.tile'
	});

	var $toggleButtons = jQuery('.wh_filter .btn');
	var $tiles = jQuery('#grid .tile');

	// disable toggle buttons if there are no posts with that subcategory
	$toggleButtons.not('.filter_all').addClass('btn_disabled');
	$toggleButtons.each(function() {
		var $btn = jQuery(this);
		var btnCategory = $btn.attr('id').replace('toggler_', '');
		$tiles.each(function() {
			var $tile = jQuery(this);
			if($tile.hasClass(btnCategory)) {
				$btn.removeClass('btn_disabled');
				return false;
			}
		});
	});


	// add event listeners to the filter buttons
	$toggleButtons.on('click', function() {
		var $btn = jQuery(this);
		var btnCategory = $btn.attr('id').replace('toggler_', '');
		if($btn.hasClass('filter_all') || $btn.hasClass('active_btn_'+btnCategory)) { // show all tiles
			$toggleButtons.removeClass('active_btn_art active_btn_business active_btn_charity active_btn_pub active_btn_sport active_btn_education active_btn_miscellaneous');
			$tiles.show().addClass('tile');
			for(i=0;i<3;i++) {
				if($tiles) { jQuery($tiles[i]).addClass('shown'); }
			}
		} else {
			// update btn style
			$toggleButtons.removeClass('active_btn_art active_btn_business active_btn_charity active_btn_pub active_btn_sport active_btn_education active_btn_miscellaneous');
			$btn.addClass('active_btn_'+btnCategory);
			// hide / show relevant tiles
			jQuery('.'+btnCategory).show().addClass('shown tile');
			$tiles.not('.'+btnCategory).hide().removeClass('shown tile');
			
		}
		// update layout
		$container.masonry('reloadItems');
		$container.masonry();
	});
});