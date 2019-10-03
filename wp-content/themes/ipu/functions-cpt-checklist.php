<?php
add_action( 'init', 'register_cpt_checklist' );

function register_cpt_checklist() {

	$labels = array( 
		'name' => _x( 'Checklists', 'checklist' ),
		'singular_name' => _x( 'Checklist', 'checklists' ),
		'add_new' => _x( 'Add a New Checklist', 'checklists' ),
		'add_new_item' => _x( 'Add New Checklist', 'checklists' ),
		'edit_item' => _x( 'Edit Checklist', 'checklists' ),
		'new_item' => _x( 'New Checklist', 'checklists' ),
		'view_item' => _x( 'View Checklist', 'checklists' ),
		'search_items' => _x( 'Search checklist', 'checklists' ),
		'not_found' => _x( 'No Checklist found', 'checklists' ),
		'not_found_in_trash' => _x( 'No Checklist found in Trash', 'checklists' ),
		'parent_item_colon' => _x( 'Parent:', 'checklists' ),
		'menu_name' => _x( 'Checklists', 'checklists' ),
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

	register_post_type( 'checklist', $args );
}

?>