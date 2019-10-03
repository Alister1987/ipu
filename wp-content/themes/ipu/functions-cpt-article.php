<?php
add_action( 'init', 'register_cpt_article' );

function register_cpt_article() {

	$labels = array( 
		'name' => _x( 'Articles', 'article' ),
		'singular_name' => _x( 'Article', 'articles' ),
		'add_new' => _x( 'Add a New Article', 'articles' ),
		'add_new_item' => _x( 'Add New Article', 'articles' ),
		'edit_item' => _x( 'Edit Article', 'articles' ),
		'new_item' => _x( 'New Article', 'articles' ),
		'view_item' => _x( 'View Article', 'articles' ),
		'search_items' => _x( 'Search article', 'articles' ),
		'not_found' => _x( 'No Article found', 'articles' ),
		'not_found_in_trash' => _x( 'No Article found in Trash', 'articles' ),
		'parent_item_colon' => _x( 'Parent:', 'articles' ),
		'menu_name' => _x( 'Articles', 'articles' ),
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

	register_post_type( 'article', $args );
}

?>