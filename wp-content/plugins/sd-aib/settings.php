<?php
/**
 * Created by PhpStorm.
 * User: alessandro
 * Date: 04/07/2017
 * Time: 14:49
 */

// create custom plugin settings menu
//add_action('admin_menu', 'my_cool_plugin_create_menu');

function adminPag2e() {

	//create new top-level menu
	add_menu_page('My Cool Plugin Settings', 'Cool Settings', 'administrator', __FILE__, 'my_cool_plugin_settings_page' , plugins_url('/images/icon.png', __FILE__) );

	//call register settings function
}

add_action( 'admin_init', 'register_my_cool_plugin_settings' );


function register_my_cool_plugin_settings() {
	//register our settings
	register_setting( 'sd-aib-settings', 'store_id' );
	register_setting( 'sd-aib-settings', 'store_id_test' );
	register_setting( 'sd-aib-settings', 'shared_secret' );
	register_setting( 'sd-aib-settings', 'shared_secret_test' );
	register_setting( 'sd-aib-settings', 'gateway_url' );
	register_setting( 'sd-aib-settings', 'gateway_url_test' );
	register_setting( 'sd-aib-settings', 'thank_url' );
	register_setting( 'sd-aib-settings', 'fail_url' );
	register_setting( 'sd-aib-settings', 'test_mode' );
}

function adminPage() {
	?>
	<div class="wrap">
		<h1>AIB Connector</h1>

		<form method="post" action="options.php">
			<?php settings_fields( 'sd-aib-settings' ); ?>
			<?php do_settings_sections( 'sd-aib-settings' ); ?>
			<table class="form-table">
				<tr valign="top">
					<th scope="row">Store Name</th>
					<td><input type="text" name="store_id" style="width: 100%" value="<?php echo esc_attr( get_option('store_id') ); ?>" /></td>
				</tr>

				<tr valign="top">
					<th scope="row">Shared Secret</th>
					<td><input type="text" name="shared_secret" style="width: 100%" value="<?php echo esc_attr( get_option('shared_secret') ); ?>" /></td>
				</tr>

                <tr valign="top">
                    <th scope="row">Url</th>
                    <td><input type="text" name="gateway_url" style="width: 100%" value="<?php echo esc_attr( get_option('gateway_url') ); ?>" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row">Store Name - Test</th>
                    <td><input type="text" name="store_id_test" style="width: 100%" value="<?php echo esc_attr( get_option('store_id_test') ); ?>" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row">Shared Secret - Test</th>
                    <td><input type="text" name="shared_secret_test" style="width: 100%" value="<?php echo esc_attr( get_option('shared_secret_test') ); ?>" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row">Url - Test</th>
                    <td><input type="text" name="gateway_url_test" style="width: 100%" value="<?php echo esc_attr( get_option('gateway_url_test') ); ?>" /></td>
                </tr>

                <tr valign="top">
					<th scope="row">Thanks Page</th>
					<td><input type="text" name="thank_url" style="width: 100%" value="<?php echo esc_attr( get_option('thank_url') ); ?>" /></td>
				</tr>

				<tr valign="top">
					<th scope="row">Fail Page</th>
					<td><input type="text" name="fail_url" style="width: 100%" value="<?php echo esc_attr( get_option('fail_url') ); ?>" /></td>
				</tr>

				<tr valign="top">
					<th scope="row">Test Mode</th>
					<td><input type="checkbox" name="test_mode" <?php echo esc_attr( get_option('test_mode') ) ? "checked":""; ?>/></td>
				</tr>
			</table>

			<?php submit_button(); ?>

		</form>
	</div>
<?php }

//backward compatibility
function searchConfigurationInfo(){
	return array(
		"card_info_page_url" => "/checkout/",
		"logged_to_donate" =>false,
		"test_mode" => get_option("test_mode"),
		"thank_you_page_url" => get_option("thank_url"),
		"fail_page_url" => get_option("fail_url"),
	);
}
//backward compatibility ... no comments
function verifiesIfUserIsLogged(){
	return is_user_logged_in();
}