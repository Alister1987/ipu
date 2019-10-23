<?php
add_action( 'init', 'register_cpt_guideline' );

function register_cpt_guideline() {

	$labels = array( 
		'name' => _x( 'Guidelines', 'guideline' ),
		'singular_name' => _x( 'Guideline', 'guidelines' ),
		'add_new' => _x( 'Add a New Guideline', 'guidelines' ),
		'add_new_item' => _x( 'Add New Guideline', 'guidelines' ),
		'edit_item' => _x( 'Edit Guideline', 'guidelines' ),
		'new_item' => _x( 'New Guideline', 'guidelines' ),
		'view_item' => _x( 'View Guideline', 'guidelines' ),
		'search_items' => _x( 'Search guideline', 'guidelines' ),
		'not_found' => _x( 'No Guideline found', 'guidelines' ),
		'not_found_in_trash' => _x( 'No Guideline found in Trash', 'guidelines' ),
		'parent_item_colon' => _x( 'Parent:', 'guidelines' ),
		'menu_name' => _x( 'Guidelines', 'guidelines' ),
	);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		
		'supports' => array( 'title', 'revisions', 'editor', 'author' ),
		'taxonomies' => array('post_tag' ),
		'show_in_menu' => true,
		'show_ui' => true,
		'public' => true,
		
		'menu_icon' => 'dashicons-screenoptions',
		'exclude_from_search' => false,
		'show_in_nav_menus' => false,
		'publicly_queryable' => true,
		'has_archive' => false,
		'can_export' => true,
		'query_var' => true,
		'rewrite' => true
	);

	register_post_type( 'guideline', $args );
}

?>