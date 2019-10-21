<?php
add_action( 'init', 'register_cpt_publication' );

function register_cpt_publication() {

	$labels = array( 
		'name' => _x( 'Publications', 'publication' ),
		'singular_name' => _x( 'Publications', 'publication' ),
		'add_new' => _x( 'Add a New Publications', 'publication' ),
		'add_new_item' => _x( 'Add New Publications', 'publication' ),
		'edit_item' => _x( 'Edit Publications', 'publication' ),
		'new_item' => _x( 'New Publications', 'publication' ),
		'view_item' => _x( 'View Publications', 'publication' ),
		'search_items' => _x( 'Search Publications', 'publication' ),
		'not_found' => _x( 'No Publications found', 'publication' ),
		'not_found_in_trash' => _x( 'No Publications found in Trash', 'publication' ),
		'parent_item_colon' => _x( 'Parent:', 'publication' ),
		'menu_name' => _x( 'Publications', 'publication' ),
	);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		
		'supports' => array( 'title', 'revisions', 'editor', 'author' ),
		'taxonomies' => array('post_tag'),
		'show_in_menu' => true,
		'show_ui' => true,
		'public' => true,
		
		'menu_icon' => 'dashicons-id-alt',
		'exclude_from_search' => false,
		'show_in_nav_menus' => false,
		'publicly_queryable' => true,
		'has_archive' => false,
		'can_export' => true,
		'query_var' => true,
		'rewrite' => true
	);

	register_post_type( 'publication', $args );
}

?>