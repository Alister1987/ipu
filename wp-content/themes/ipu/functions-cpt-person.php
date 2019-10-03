<?php
add_action( 'init', 'register_cpt_person' );

function register_cpt_person() {

	$labels = array( 
		'name' => _x( 'Persons', 'person' ),
		'singular_name' => _x( 'Person', 'person' ),
		'add_new' => _x( 'Add a new Person', 'person' ),
		'add_new_item' => _x( 'Add new Person', 'person' ),
		'edit_item' => _x( 'Edit Person', 'person' ),
		'new_item' => _x( 'New Person', 'person' ),
		'view_item' => _x( 'View Person', 'person' ),
		'search_items' => _x( 'Search Persons', 'person' ),
		'not_found' => _x( 'No Person found', 'person' ),
		'not_found_in_trash' => _x( 'No Person found in Trash', 'person' ),
		'parent_item_colon' => _x( 'Parent:', 'person' ),
		'menu_name' => _x( 'Persons', 'person' ),
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

	register_post_type( 'person', $args );
}

?>