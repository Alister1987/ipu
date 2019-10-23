<?php
add_action( 'init', 'register_cpt_file' );

function register_cpt_file() {

    $labels = array(
        'name' => _x( 'Files', 'file' ),
        'singular_name' => _x( 'File', 'files' ),
        'add_new' => _x( 'Add a New File', 'files' ),
        'add_new_item' => _x( 'Add New File', 'files' ),
        'edit_item' => _x( 'Edit File', 'files' ),
        'new_item' => _x( 'New File', 'files' ),
        'view_item' => _x( 'View File', 'files' ),
        'search_items' => _x( 'Search File', 'files' ),
        'not_found' => _x( 'No File found', 'files' ),
        'not_found_in_trash' => _x( 'No File found in Trash', 'files' ),
        'parent_item_colon' => _x( 'Parent:', 'files' ),
        'menu_name' => _x( 'Files', 'files' ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => false,

        'supports' => array( 'title', 'revisions', 'editor', 'author' ),
        'taxonomies' => array('post_tag' ),
        'show_in_menu' => true,
        'show_ui' => true,
        'public' => true,

        'menu_icon' => 'dashicons-media-default',
        'exclude_from_search' => false,
        'show_in_nav_menus' => false,
        'publicly_queryable' => true,
        'has_archive' => false,
        'can_export' => true,
        'query_var' => true,
        'rewrite' => true
    );

    register_post_type( 'file', $args );
}


add_action( 'save_post', 'sd_files_csv_save' );

// Save the Metabox values
function sd_files_csv_save( $post_id )
{
    //todo useless
//    $MAX_COLUMNS = 15;
//    // Stop the script when doing autosave
//    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
//
//    // Stop the script if the user does not have edit permissions
//    if (!current_user_can('edit_post')) return;
//
//    if (get_post_type() != 'file') {
//        return;
//    }
//
//
//    //check csv
//
//    // checking if PDF is attached and image not set yet
//    $upload_file = get_field('files', $post_id);
//    $post = get_post($upload_file);
//    $ext = pathinfo($post->guid, PATHINFO_EXTENSION);
//
//    if(strtolower($ext) != "csv")
//        return;
//
//    $csv = array_map('str_getcsv', file($post->guid));
//    array_walk($csv, function(&$a) use ($csv) {
//        $a = array_combine($csv[0], $a);
//    });
//    //check columns
//    if(count($csv[0]) > $MAX_COLUMNS){
//        update_field("files", "", $post_id);
//        die("Too many columsn in the csv, please <a href='/wp-admin/edit.php?post_type=file'>go back</a>");
//    }
//    return;


}
?>