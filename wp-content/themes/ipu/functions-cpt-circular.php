<?php
add_action( 'init', 'register_cpt_circular' );

function register_cpt_circular() {

	$labels = array( 
		'name' => _x( 'Circular', 'circular' ),
		'singular_name' => _x( 'Circular', 'circular' ),
		'add_new' => _x( 'Add a New Circular', 'circular' ),
		'add_new_item' => _x( 'Add New Circular', 'circular' ),
		'edit_item' => _x( 'Edit Circular', 'circular' ),
		'new_item' => _x( 'New Circular', 'circular' ),
		'view_item' => _x( 'View Circular', 'circular' ),
		'search_items' => _x( 'Search Circular', 'circular' ),
		'not_found' => _x( 'No Circular found', 'circular' ),
		'not_found_in_trash' => _x( 'No Circular found in Trash', 'circular' ),
		'parent_item_colon' => _x( 'Parent:', 'circular' ),
		'menu_name' => _x( 'Circular', 'circular' ),
	);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		
		'supports' => array( 'title', 'revisions', 'editor', 'author' ),
		'taxonomies' => array('post_tag'),
		'show_in_menu' => true,
		'show_ui' => true,
		'public' => true,
		
		'menu_icon' => 'dashicons-media-document',
		'exclude_from_search' => false,
		'show_in_nav_menus' => false,
		'publicly_queryable' => true,
		'has_archive' => false,
		'can_export' => true,
		'query_var' => true,
		'rewrite' => true
	);

	register_post_type( 'circular', $args );
}

?>