<?php
add_action( 'init', 'register_cpt_sop' );

function register_cpt_sop() {

	$labels = array( 
		'name' => _x( 'Sops', 'sop' ),
		'singular_name' => _x( 'Sops', 'sops' ),
		'add_new' => _x( 'Add a New Sops', 'sops' ),
		'add_new_item' => _x( 'Add New Sops', 'sops' ),
		'edit_item' => _x( 'Edit Sops', 'sops' ),
		'new_item' => _x( 'New Sops', 'sops' ),
		'view_item' => _x( 'View Sops', 'sops' ),
		'search_items' => _x( 'Search sop', 'sops' ),
		'not_found' => _x( 'No Sops found', 'sops' ),
		'not_found_in_trash' => _x( 'No Sops found in Trash', 'sops' ),
		'parent_item_colon' => _x( 'Parent:', 'sops' ),
		'menu_name' => _x( 'Sops', 'sops' ),
	);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		
		'supports' => array( 'title', 'revisions', 'editor', 'author' ),
		'taxonomies' => array('post_tag' ),
		'show_in_menu' => true,
		'show_ui' => true,
		'public' => true,
		
		'menu_icon' => 'dashicons-format-status',
		'exclude_from_search' => false,
		'show_in_nav_menus' => false,
		'publicly_queryable' => true,
		'has_archive' => false,
		'can_export' => true,
		'query_var' => true,
		'rewrite' => true
	);

	register_post_type( 'sop', $args );
}

?>