<?php
add_action( 'init', 'register_cpt_event' );

function register_cpt_event() {

	$labels = array( 
		'name' => _x( 'Events', 'events' ),
		'singular_name' => _x( 'Event', 'events' ),
		'add_new' => _x( 'Add a New Event', 'events' ),
		'add_new_item' => _x( 'Add New Event', 'events' ),
		'edit_item' => _x( 'Edit Event', 'events' ),
		'new_item' => _x( 'New Event', 'events' ),
		'view_item' => _x( 'View Event', 'events' ),
		'search_items' => _x( 'Search Event', 'events' ),
		'not_found' => _x( 'No Event found', 'events' ),
		'not_found_in_trash' => _x( 'No Event found in Trash', 'events' ),
		'parent_item_colon' => _x( 'Parent:', 'events' ),
		'menu_name' => _x( 'Events', 'events' ),
	);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		
		'supports' => array( 'title', 'revisions', 'editor', 'author' ),
		'taxonomies' => array('post_tag'),
		'show_in_menu' => true,
		'show_ui' => true,
		'public' => true,
		
		'menu_icon' => 'dashicons-admin-post',
		'exclude_from_search' => false,
		'show_in_nav_menus' => false,
		'publicly_queryable' => true,
		'has_archive' => false,
		'can_export' => true,
		'query_var' => true,
		'rewrite' => true
	);

	register_post_type( 'event', $args );
}

?>