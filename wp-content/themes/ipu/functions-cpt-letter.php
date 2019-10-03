<?php
add_action( 'init', 'register_cpt_letter' );

function register_cpt_letter() {

	$labels = array( 
		'name' => _x( 'Letter', 'letter' ),
		'singular_name' => _x( 'Letter', 'letter' ),
		'add_new' => _x( 'Add a New Letter', 'letter' ),
		'add_new_item' => _x( 'Add New Letter', 'letter' ),
		'edit_item' => _x( 'Edit Letter', 'letter' ),
		'new_item' => _x( 'New Letter', 'letter' ),
		'view_item' => _x( 'View Letter', 'letter' ),
		'search_items' => _x( 'Search Letter', 'letter' ),
		'not_found' => _x( 'No Letter found', 'letter' ),
		'not_found_in_trash' => _x( 'No Letter found in Trash', 'letter' ),
		'parent_item_colon' => _x( 'Parent:', 'letter' ),
		'menu_name' => _x( 'Letter', 'letter' ),
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

	register_post_type( 'letter', $args );
}

?>