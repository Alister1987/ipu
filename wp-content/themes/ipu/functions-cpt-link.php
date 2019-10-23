<?php
add_action( 'init', 'register_cpt_link' );

function register_cpt_link() {

	$labels = array( 
		'name' => _x( 'Links', 'link' ),
		'singular_name' => _x( 'Link', 'links' ),
		'add_new' => _x( 'Add a New Link', 'links' ),
		'add_new_item' => _x( 'Add New Link', 'links' ),
		'edit_item' => _x( 'Edit Link', 'links' ),
		'new_item' => _x( 'New Link', 'links' ),
		'view_item' => _x( 'View Link', 'links' ),
		'search_items' => _x( 'Search Link', 'links' ),
		'not_found' => _x( 'No Link found', 'links' ),
		'not_found_in_trash' => _x( 'No Link found in Trash', 'links' ),
		'parent_item_colon' => _x( 'Parent:', 'links' ),
		'menu_name' => _x( 'Links', 'links' ),
	);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		
		'supports' => array( 'title', 'revisions', 'editor', 'author' ),
		'taxonomies' => array( 'post_tag' ),
		'show_in_menu' => true,
		'show_ui' => true,
		'public' => true,
		
		'menu_icon' => 'dashicons-editor-unlink',
		'exclude_from_search' => false,
		'show_in_nav_menus' => false,
		'publicly_queryable' => true,
		'has_archive' => false,
		'can_export' => true,
		'query_var' => true,
		'rewrite' => true
	);

	register_post_type( 'link', $args );
}

?>