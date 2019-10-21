<?php
/**
 * Created by PhpStorm.
 * User: alessandro
 * Date: 28/08/2017
 * Time: 12:48
 */
add_action( 'admin_menu', 'my_plugin_menu' );

function my_plugin_menu() {
	add_options_page(
		'Popup Settings',
		'Popup Settings',
		'manage_options',
		'popup-settings.php',
		'sd_popup_settings'
	);
}

function sd_popup_settings(){

	// Save attachment ID
	if (isset( $_POST['image_attachment_id'] ) ) :
		update_option( 'popup_image', absint( $_POST['image_attachment_id'] ) );
	endif;
	
	wp_enqueue_media();


	if(isset($_POST["popup_title"]))
		update_option("popup_title",$_POST["popup_title"]);
	if(isset($_POST["popup_text"]))
		update_option("popup_text",$_POST["popup_text"]);
	if(isset($_POST["popup_btn_text"]))
		update_option("popup_btn_text",$_POST["popup_btn_text"]);
	if(isset($_POST["popup_btn_link"]))
		update_option("popup_btn_link",$_POST["popup_btn_link"]);
	if(isset($_POST["popup_id"]))
		update_option("popup_id",$_POST["popup_id"]);
	if(isset($_POST["popup_show"]))
		update_option("popup_show",$_POST["popup_show"]);
	else
		update_option("popup_show","");



	?>
	<h1>Popup Settings</h1>
	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="type" value="multi-import">
		<table class="form-table">
			<tbody>
			<tr>
				<th scope="row"><label for="csv_file">Popup ID - If the user click on "Never show again" change this one for showing the popup again </label></th>
				<td>
					<input style="width:100%;" type="text" name="popup_id" value="<?php echo get_option("popup_id")?>" required/>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="csv_file">Title</label></th>
				<td>
					<input style="width:100%;" type="text" name="popup_title" value="<?php echo get_option("popup_title")?>" required/>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="csv_file">Text</label></th>
				<td>
					<input style="width:100%;" type="text" name="popup_text" value="<?php echo get_option("popup_text")?>" required/>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="csv_file">Button Text</label></th>
				<td>
					<input style="width:100%;" type="text" name="popup_btn_text" value="<?php echo get_option("popup_btn_text")?>" required/>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="csv_file">Button Link</label></th>
				<td>
					<input style="width:100%;" type="text"name="popup_btn_link" value="<?php echo get_option("popup_btn_link")?>" required/>
				</td>
			</tr>
            <tr>
                <th scope="row"><label for="csv_file">Image</label></th>
                <td>
                    <div class='image-preview-wrapper'>
                        <img id='image-preview' src='<?php echo wp_get_attachment_url( get_option( 'popup_image' ) ); ?>' height='100'>
                    </div>
                    <input id="upload_image_button" type="button" class="button" value="<?php _e( 'Upload image' ); ?>" />
                    <input type='hidden' name='image_attachment_id' id='image_attachment_id' value='<?php echo get_option( 'popup_image' ); ?>'>
                </td>
            </tr>
			<tr>
				<th scope="row"><label for="csv_file">Show Popup</label></th>
				<td>
					<input  type="checkbox" name="popup_show" <?php echo get_option("popup_show")?"checked":""?> /> <span>Tick it if you want to show the popup</span>
				</td>
			</tr>

			</tbody>



		</table>


		<p class="submit">
			<input type="submit" name="submit" id="submit" class="button button-primary" value="Save">
		</p>
	</form>


<?php }



add_action( 'admin_footer', 'media_selector_print_scripts' );

function media_selector_print_scripts() {

$my_saved_attachment_post_id = get_option( 'popup_image', 0 );

?><script type='text/javascript'>

    jQuery( document ).ready( function( $ ) {

        // Uploading files
        var file_frame;
        var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
        var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this

        jQuery('#upload_image_button').on('click', function( event ){

            event.preventDefault();

            // If the media frame already exists, reopen it.
            if ( file_frame ) {
                // Set the post ID to what we want
                file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
                // Open frame
                file_frame.open();
                return;
            } else {
                // Set the wp.media post id so the uploader grabs the ID we want when initialised
                wp.media.model.settings.post.id = set_to_post_id;
            }

            // Create the media frame.
            file_frame = wp.media.frames.file_frame = wp.media({
                title: 'Select a image to upload',
                button: {
                    text: 'Use this image',
                },
                multiple: false	// Set to true to allow multiple files to be selected
            });

            // When an image is selected, run a callback.
            file_frame.on( 'select', function() {
                // We set multiple to false so only get one image from the uploader
                attachment = file_frame.state().get('selection').first().toJSON();

                // Do something with attachment.id and/or attachment.url here
                $( '#image-preview' ).attr( 'src', attachment.url ).css( 'width', 'auto' );
                $( '#image_attachment_id' ).val( attachment.id );

                // Restore the main post ID
                wp.media.model.settings.post.id = wp_media_post_id;
            });

            // Finally, open the modal
            file_frame.open();
        });

        // Restore the main ID when the add media button is pressed
        jQuery( 'a.add_media' ).on( 'click', function() {
            wp.media.model.settings.post.id = wp_media_post_id;
        });
    });

</script> <?php
}