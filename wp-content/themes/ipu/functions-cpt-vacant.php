<?php
add_action( 'init', 'register_cpt_vacant' );

function register_cpt_vacant() {

	$labels = array( 
		'name' => _x( 'Vacant', 'vacant' ),
		'singular_name' => _x( 'Vacant', 'vacant' ),
		'add_new' => _x( 'Add a New Vacant', 'vacant' ),
		'add_new_item' => _x( 'Add New Vacant', 'vacant' ),
		'edit_item' => _x( 'Edit Vacant', 'vacant' ),
		'new_item' => _x( 'New Vacant', 'vacant' ),
		'view_item' => _x( 'View Vacant', 'vacant' ),
		'search_items' => _x( 'Search vacant', 'vacant' ),
		'not_found' => _x( 'No Vacant found', 'vacant' ),
		'not_found_in_trash' => _x( 'No Vacant found in Trash', 'vacant' ),
		'parent_item_colon' => _x( 'Parent:', 'vacant' ),
		'menu_name' => _x( 'Vacant', 'vacant' ),
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

	register_post_type( 'vacant', $args );
}

?>