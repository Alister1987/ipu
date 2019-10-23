<?php
add_action( 'init', 'register_cpt_commitee' );

function register_cpt_commitee() {

	$labels = array( 
		'name' => _x( 'Commitee', 'commitee' ),
		'singular_name' => _x( 'Commitee', 'commitee' ),
		'add_new' => _x( 'Add a New Commitee', 'commitee' ),
		'add_new_item' => _x( 'Add New Commitee', 'commitee' ),
		'edit_item' => _x( 'Edit Commitee', 'commitee' ),
		'new_item' => _x( 'New Commitee', 'commitee' ),
		'view_item' => _x( 'View Commitee', 'commitee' ),
		'search_items' => _x( 'Search commitee', 'commitee' ),
		'not_found' => _x( 'No Commitee found', 'commitee' ),
		'not_found_in_trash' => _x( 'No Commitee found in Trash', 'commitee' ),
		'parent_item_colon' => _x( 'Parent:', 'commitee' ),
		'menu_name' => _x( 'Commitee', 'commitee' ),
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

	register_post_type( 'commitee', $args );
}

?>