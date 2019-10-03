<?php
add_action( 'init', 'register_cpt_review' );

function register_cpt_review() {

	$labels = array( 
		'name' => _x( 'Ipu Review', 'review' ),
		'singular_name' => _x( 'Ipu Review', 'reviews' ),
		'add_new' => _x( 'Add a New Review', 'reviews' ),
		'add_new_item' => _x( 'Add New Review', 'reviews' ),
		'edit_item' => _x( 'Edit Review', 'reviews' ),
		'new_item' => _x( 'New Review', 'reviews' ),
		'view_item' => _x( 'View Review', 'reviews' ),
		'search_items' => _x( 'Search Review', 'reviews' ),
		'not_found' => _x( 'No Review found', 'reviews' ),
		'not_found_in_trash' => _x( 'No Review found in Trash', 'reviews' ),
		'parent_item_colon' => _x( 'Parent:', 'reviews' ),
		'menu_name' => _x( 'Ipu Review', 'reviews' ),
	);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		
		'supports' => array( 'title', 'revisions', 'editor', 'author' ),
		'taxonomies' => array('post_tag' ),
		'show_in_menu' => true,
		'show_ui' => true,
		'public' => true,
		
		'menu_icon' => 'dashicons-media-default',
		'exclude_from_search' => false,
		'show_in_nav_menus' => false,
		'publicly_queryable' => true,
		'has_archive' => false,
		'can_export' => true,
		'query_var' => true,
		'rewrite' => true
	);

	register_post_type( 'review', $args );
}

?>