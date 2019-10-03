<?php
add_action( 'init', 'register_cpt_postersandpromo' );

function register_cpt_postersandpromo() {

	$labels = array( 
		'name' => _x( 'Health promotions', 'postersandpromos' ),
		'singular_name' => _x( 'Health promotions', 'postersandpromos' ),
		'add_new' => _x( 'Add a New Health promotions', 'postersandpromos' ),
		'add_new_item' => _x( 'Add New Health promotions', 'postersandpromos' ),
		'edit_item' => _x( 'Edit Posters and promos', 'postersandpromos' ),
		'new_item' => _x( 'New Health promotions', 'postersandpromos' ),
		'view_item' => _x( 'View Health promotions', 'postersandpromos' ),
		'search_items' => _x( 'Search Health promotions', 'postersandpromos' ),
		'not_found' => _x( 'No Health promotions found', 'postersandpromos' ),
		'not_found_in_trash' => _x( 'No Health promotions found in Trash', 'postersandpromos' ),
		'parent_item_colon' => _x( 'Parent:', 'postersandpromos' ),
		'menu_name' => _x( 'Health promotions', 'postersandpromos' ),
	);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		
		'supports' => array( 'title', 'revisions', 'editor', 'author' ),
		'taxonomies' => array('post_tag' ),
		'show_in_menu' => true,
		'show_ui' => true,
		'public' => true,
		
		'menu_icon' => 'dashicons-tickets',
		'exclude_from_search' => false,
		'show_in_nav_menus' => false,
		'publicly_queryable' => true,
		'has_archive' => false,
		'can_export' => true,
		'query_var' => true,
		'rewrite' => true
	);

	register_post_type( 'postersandpromo', $args );
}

add_action( 'save_post', 'postersandpromos_save' );

// Save the Metabox values
function postersandpromos_save( $post_id ) {
    // Stop the script when doing autosave
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    // Stop the script if the user does not have edit permissions
    if( !current_user_can( 'edit_post' ) ) return;
    
    if(get_post_type() != 'postersandpromo') {
        return;
    }
    
    // checking if PDF is attached and image not set yet
    $image = get_field('image', $post_id);
    $upload_file = get_field('upload_file', $post_id);
    
    $root = substr(ABSPATH, 0, strlen(ABSPATH) - 1);
    $save_to = $root."/wp-content/uploads/poster_".$post_id.".png";
    
    $image = parse_url( wp_get_attachment_url( $image ) );
    $image    = $root . dirname( $image [ 'path' ] ) . '/' . rawurlencode( basename( $image[ 'path' ] ) );
    
    $upload_file = parse_url( wp_get_attachment_url( $upload_file ) );
    if(!wp_get_attachment_url( get_field('upload_file', $post_id) )) {
        return;
    }
    
    $pdf_file = $root . dirname( $upload_file [ 'path' ] ) . '/' . rawurlencode( basename( $upload_file[ 'path' ] ) );
    
    if(file_exists($save_to)) {
        unlink($save_to);
    }

    $img = new imagick();

    //this must be called before reading the image, otherwise has no effect - "-density {$x_resolution}x{$y_resolution}"
    //this is important to give good quality output, otherwise text might be unclear
    $img->setResolution(200,200);

    //read the pdf
    $img->readImage($pdf_file.'[0]');

    //set new format
    $img->setImageFormat('png');

    $img->trimImage(0);
 
    //save image file
    $img->writeImage($save_to);
    
    // $filename should be the path to a file in the upload directory.
    $filename = $save_to;

    // The ID of the post this attachment is for.
    $parent_post_id = $post_id;

    // Check the type of file. We'll use this as the 'post_mime_type'.
    $filetype = wp_check_filetype( basename( $filename ), null );

    // Get the path to the upload directory.
    $wp_upload_dir = wp_upload_dir();

    // Prepare an array of post data for the attachment.
    $attachment = array(
        'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
        'post_mime_type' => $filetype['type'],
        'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
        'post_content'   => '',
        'post_status'    => 'inherit'
    );

    // Insert the attachment.
    $attach_id = wp_insert_attachment( $attachment, $filename, $parent_post_id );

    // Generate the metadata for the attachment, and update the database record.
    $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
    wp_update_attachment_metadata( $attach_id, $attach_data );
    
    update_field('field_54aacb7374b03', $attach_id, $post_id);
}

?>