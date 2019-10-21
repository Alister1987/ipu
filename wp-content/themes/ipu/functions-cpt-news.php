<?php
add_action( 'init', 'register_cpt_news' );

function register_cpt_news() {

	$labels = array( 
		'name' => _x( 'News', 'news' ),
		'singular_name' => _x( 'News', 'news' ),
		'add_new' => _x( 'Add a New News', 'news' ),
		'add_new_item' => _x( 'Add New News', 'news' ),
		'edit_item' => _x( 'Edit News', 'news' ),
		'new_item' => _x( 'New News', 'news' ),
		'view_item' => _x( 'View News', 'news' ),
		'search_items' => _x( 'Search News', 'news' ),
		'not_found' => _x( 'No News found', 'news' ),
		'not_found_in_trash' => _x( 'No News found in Trash', 'news' ),
		'parent_item_colon' => _x( 'Parent:', 'news' ),
		'menu_name' => _x( 'News', 'news' ),
	);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		
		'supports' => array( 'title', 'revisions', 'editor', 'author' ),
		'taxonomies' => array('post_tag' ),
		'show_in_menu' => true,
		'show_ui' => true,
		'public' => true,
		
		'menu_icon' => 'dashicons-megaphone',
		'exclude_from_search' => false,
		'show_in_nav_menus' => false,
		'publicly_queryable' => true,
		'has_archive' => false,
		'can_export' => true,
		'query_var' => true,
		'rewrite' => true
	);

	register_post_type( 'news', $args );
}

?>