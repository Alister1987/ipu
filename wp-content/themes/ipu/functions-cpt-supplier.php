<?php
add_action( 'init', 'register_cpt_supplier' );

function register_cpt_supplier() {

	$labels = array( 
		'name' => _x( 'Suppliers', 'supplier' ),
		'singular_name' => _x( 'Suppliers', 'suppliers' ),
		'add_new' => _x( 'Add a New Suppliers', 'suppliers' ),
		'add_new_item' => _x( 'Add New Suppliers', 'suppliers' ),
		'edit_item' => _x( 'Edit Suppliers', 'suppliers' ),
		'new_item' => _x( 'New Suppliers', 'suppliers' ),
		'view_item' => _x( 'View Suppliers', 'suppliers' ),
		'search_items' => _x( 'Search suppliers', 'suppliers' ),
		'not_found' => _x( 'No Suppliers found', 'suppliers' ),
		'not_found_in_trash' => _x( 'No Suppliers found in Trash', 'suppliers' ),
		'parent_item_colon' => _x( 'Parent:', 'suppliers' ),
		'menu_name' => _x( 'Suppliers', 'suppliers' ),
	);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		
		'supports' => array( 'title', 'revisions', 'editor', 'author' ),
		'taxonomies' => array('post_tag'),
		'show_in_menu' => true,
		'show_ui' => true,
		'public' => true,
		
		'menu_icon' => 'dashicons-cart',
		'exclude_from_search' => false,
		'show_in_nav_menus' => false,
		'publicly_queryable' => true,
		'has_archive' => false,
		'can_export' => true,
		'query_var' => true,
		'rewrite' => true
	);

	register_post_type( 'supplier', $args );
}

?>