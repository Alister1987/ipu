<?php
add_action( 'init', 'register_cpt_recruitment' );
add_action( 'admin_init', 'recruitment_add_roles');

function register_cpt_recruitment() {
  $labels = array(
    'name' => _x( 'Recruitment', 'recruitment' ),
    'singular_name' => _x( 'Recruitment', 'recruitment' ),
    'add_new' => _x( 'Add a New Recruitment', 'recruitment' ),
    'add_new_item' => _x( 'Add New Recruitment', 'recruitment' ),
    'edit_item' => _x( 'Edit Recruitment', 'recruitment' ),
    'new_item' => _x( 'New Recruitment', 'recruitment' ),
    'view_item' => _x( 'View Recruitment', 'recruitment' ),
    'search_items' => _x( 'Search Recruitment', 'recruitment' ),
    'not_found' => _x( 'No Job found', 'recruitment' ),
    'not_found_in_trash' => _x( 'No Job found in Trash', 'recruitment' ),
    'parent_item_colon' => _x( 'Parent:', 'recruitment' ),
    'menu_name' => _x( 'Recruitment', 'recruitment' ),
  );

  $args = array(
    'labels' => $labels,
    'hierarchical' => false,
    'supports' => array( 'title', 'revisions', 'editor', 'author', 'thumbnail' ),
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
    'rewrite' => true,
    'capabilities' => helper_recruitment_capabilities(),
    'map_meta_cap' => true,
  );

  register_post_type( 'recruitment', $args );
}

/*
- Roles And Capabilities
  https://codex.wordpress.org/Roles_and_Capabilities
  https://developer.wordpress.org/reference/functions/wp_roles/
  https://kinsta.com/blog/wordpress-user-roles/ (tutorial)

capabilities          |	administrator     |
----------------------|:-----------------:|
read_post             |   x               |
read_private_posts    |   x               |
edit_post             |   x               |
edit_posts            |   x               |
edit_others_posts     |   x               |
edit_published_posts  |   x               |
edit_private_posts    |   x               |
delete_post           |   x               |
delete_posts          |   x               |
delete_others_posts   |   x               |
delete_published_post |   x               |
delete_private_post   |   x               |
publish_posts         |   x               |
*/

function helper_recruitment_capabilities ($single = 'recruitment', $plural = 'recruitments') {
  return array(
    'read_post' => 'read_' . $single,
    'read_private_posts' => 'read_private_' . $plural,
    'edit_post' => 'edit_' . $single,
    'edit_posts' => 'edit_' . $plural,
    'edit_others_posts' => 'edit_others_' . $plural,
    'edit_published_posts' => 'edit_published_' . $plural,
    'edit_private_posts' => 'edit_private_' . $plural,
    'delete_post' => 'delete_' . $single,
    'delete_posts' => 'delete_' . $plural,
    'delete_others_posts' => 'delete_others_' . $plural,
    'delete_published_posts' => 'delete_published_' . $plural,
    'delete_private_posts' => 'delete_private_' . $plural,
    'publish_posts' => 'publish_' . $plural,
    'moderate_comments' => 'moderate_' . $single . '_comments',
  );
}

function recruitment_add_roles() {
  $caps = helper_recruitment_capabilities();

  $admin = get_role('administrator');
  $admin_caps = [
    'read_post',
    'read_private_posts',
    'edit_post',
    'edit_posts',
    'edit_others_posts',
    'edit_published_posts',
    'edit_private_posts',
    'delete_post',
    'delete_posts',
    'delete_others_posts',
    'delete_published_post',
    'delete_private_post',
    'publish_posts',
  ];

  foreach($admin_caps as $cap) $admin->add_cap( $caps[$cap] );
}

?>
