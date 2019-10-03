<?php
add_action( 'init', 'register_cpt_course' );

function register_cpt_course() {

	$labels = array( 
		'name' => _x( 'Courses', 'courses' ),
		'singular_name' => _x( 'Course', 'courses' ),
		'add_new' => _x( 'Add a New Course', 'courses' ),
		'add_new_item' => _x( 'Add New Course', 'courses' ),
		'edit_item' => _x( 'Edit Course', 'courses' ),
		'new_item' => _x( 'New Course', 'courses' ),
		'view_item' => _x( 'View Course', 'courses' ),
		'search_items' => _x( 'Search Course', 'courses' ),
		'not_found' => _x( 'No Course found', 'courses' ),
		'not_found_in_trash' => _x( 'No Course found in Trash', 'courses' ),
		'parent_item_colon' => _x( 'Parent:', 'courses' ),
		'menu_name' => _x( 'Courses', 'courses' ),
	);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		
		'supports' => array( 'title', 'revisions', 'editor', 'author' ),
		'taxonomies' => array('post_tag'),
		'show_in_menu' => true,
		'show_ui' => true,
		'public' => true,
		
		'menu_icon' => 'dashicons-admin-post',
		'exclude_from_search' => false,
		'show_in_nav_menus' => false,
		'publicly_queryable' => true,
		'has_archive' => false,
		'can_export' => true,
		'query_var' => true,
		'rewrite' => true
	);

	register_post_type( 'course', $args );
}

?>