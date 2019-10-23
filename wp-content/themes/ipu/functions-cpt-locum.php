<?php
add_action( 'init', 'register_cpt_locum' );

function register_cpt_locum() {

	$labels = array( 
		'name' => _x( 'Locum', 'locum' ),
		'singular_name' => _x( 'Locum', 'locum' ),
		'add_new' => _x( 'Add a New Locum', 'locum' ),
		'add_new_item' => _x( 'Add New Locum', 'locum' ),
		'edit_item' => _x( 'Edit Locum', 'locum' ),
		'new_item' => _x( 'New Locum', 'locum' ),
		'view_item' => _x( 'View Locum', 'locum' ),
		'search_items' => _x( 'Search Locum', 'locum' ),
		'not_found' => _x( 'No Locum found', 'locum' ),
		'not_found_in_trash' => _x( 'No Locum found in Trash', 'locum' ),
		'parent_item_colon' => _x( 'Parent:', 'locum' ),
		'menu_name' => _x( 'Locum', 'locum' ),
	);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		
		'supports' => array( 'title', 'revisions', 'editor', 'author' ),
		'taxonomies' => array('post_tag'),
		'show_in_menu' => true,
		'show_ui' => true,
		'public' => true,
		
		'menu_icon' => 'dashicons-businessman',
		'exclude_from_search' => false,
		'show_in_nav_menus' => false,
		'publicly_queryable' => true,
		'has_archive' => false,
		'can_export' => true,
		'query_var' => true,
		'rewrite' => true
	);

	register_post_type( 'locum', $args );
}

?>