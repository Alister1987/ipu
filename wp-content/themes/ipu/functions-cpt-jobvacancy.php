<?php
add_action( 'init', 'register_cpt_jobvacancy' );

function register_cpt_jobvacancy() {

	$labels = array( 
		'name' => _x( 'Job Vacancy', 'jobvacancy' ),
		'singular_name' => _x( 'Job Vacancy', 'jobvacancy' ),
		'add_new' => _x( 'Add a New Job', 'jobvacancy' ),
		'add_new_item' => _x( 'Add New Job', 'jobvacancy' ),
		'edit_item' => _x( 'Edit Job', 'jobvacancy' ),
		'new_item' => _x( 'New Job', 'jobvacancy' ),
		'view_item' => _x( 'View Job', 'jobvacancy' ),
		'search_items' => _x( 'Search job', 'jobvacancy' ),
		'not_found' => _x( 'No Job found', 'jobvacancy' ),
		'not_found_in_trash' => _x( 'No Job found in Trash', 'jobvacancy' ),
		'parent_item_colon' => _x( 'Parent:', 'jobvacancy' ),
		'menu_name' => _x( 'Job Vacancy', 'jobvacancy' ),
	);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		
		'supports' => array( 'title', 'revisions', 'editor', 'author' ),
		'taxonomies' => array('post_tag'),
		'show_in_menu' => true,
		'show_ui' => true,
		'public' => true,
		
		'menu_icon' => 'dashicons-images-alt',
		'exclude_from_search' => false,
		'show_in_nav_menus' => false,
		'publicly_queryable' => true,
		'has_archive' => false,
		'can_export' => true,
		'query_var' => true,
		'rewrite' => true
	);

	register_post_type( 'jobvacancy', $args );
}

?>