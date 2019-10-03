<?php
add_action( 'init', 'register_cpt_lobbying' );

function register_cpt_lobbying() {

	$labels = array( 
		'name' => _x( 'Lobbying', 'lobbying' ),
		'singular_name' => _x( 'Lobbying', 'lobbying' ),
		'add_new' => _x( 'Add a New Lobbying', 'lobbying' ),
		'add_new_item' => _x( 'Add New Lobbying', 'lobbying' ),
		'edit_item' => _x( 'Edit Lobbying', 'lobbying' ),
		'new_item' => _x( 'New Lobbying', 'lobbying' ),
		'view_item' => _x( 'View Lobbying', 'lobbying' ),
		'search_items' => _x( 'Search Lobbying', 'lobbying' ),
		'not_found' => _x( 'No Lobbying found', 'lobbying' ),
		'not_found_in_trash' => _x( 'No Lobbying found in Trash', 'lobbying' ),
		'parent_item_colon' => _x( 'Parent:', 'lobbying' ),
		'menu_name' => _x( 'Lobbying', 'lobbying' ),
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

	register_post_type( 'lobbying', $args );
}

?>