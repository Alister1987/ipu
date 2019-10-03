<?php
add_action( 'init', 'register_cpt_faq' );

function register_cpt_faq() {

	$labels = array( 
		'name' => _x( 'FAQs', 'faq' ),
		'singular_name' => _x( 'FAQs', 'faqs' ),
		'add_new' => _x( 'Add a New FAQs', 'faqs' ),
		'add_new_item' => _x( 'Add New FAQs', 'faqs' ),
		'edit_item' => _x( 'Edit FAQs', 'faqs' ),
		'new_item' => _x( 'New FAQs', 'faqs' ),
		'view_item' => _x( 'View FAQs', 'faqs' ),
		'search_items' => _x( 'Search FAQs', 'faqs' ),
		'not_found' => _x( 'No Faq FAQs', 'faqs' ),
		'not_found_in_trash' => _x( 'No Faq found in Trash', 'faqs' ),
		'parent_item_colon' => _x( 'Parent:', 'faqs' ),
		'menu_name' => _x( 'FAQs', 'faqs' ),
	);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		
		'supports' => array( 'title', 'revisions', 'editor', 'author' ),
		'taxonomies' => array('post_tag' ),
		'show_in_menu' => true,
		'show_ui' => true,
		'public' => true,
		
		'menu_icon' => 'dashicons-book',
		'exclude_from_search' => false,
		'show_in_nav_menus' => false,
		'publicly_queryable' => true,
		'has_archive' => false,
		'can_export' => true,
		'query_var' => true,
		'rewrite' => true
	);

	register_post_type( 'faq', $args );
}

?>