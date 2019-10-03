<?php
add_action( 'init', 'register_cpt_adcampaign' );

function register_cpt_adcampaign() {

	$labels = array( 
		'name' => _x( 'Ad Campaign', 'adcampaign' ),
		'singular_name' => _x( 'Ad Campaign', 'adcampaign' ),
		'add_new' => _x( 'Add a New Campaign', 'adcampaign' ),
		'add_new_item' => _x( 'Add New Campaign', 'adcampaign' ),
		'edit_item' => _x( 'Edit Campaign', 'adcampaign' ),
		'new_item' => _x( 'New Campaign', 'adcampaign' ),
		'view_item' => _x( 'View Campaign', 'adcampaign' ),
		'search_items' => _x( 'Search Campaign', 'adcampaign' ),
		'not_found' => _x( 'No Campaign found', 'adcampaign' ),
		'not_found_in_trash' => _x( 'No Campaign found in Trash', 'adcampaign' ),
		'parent_item_colon' => _x( 'Parent:', 'adcampaign' ),
		'menu_name' => _x( 'Ad Campaign', 'adcampaign' ),
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

	register_post_type( 'adcampaign', $args );
}

?>