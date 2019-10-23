<?php
/**
 * Created by PhpStorm.
 * User: wojciech
 * Date: 21/03/2018
 * Time: 17:37
 */

function register_vatopt()
{
    add_options_page(
        'Vat setting',
        'SD Payment Link',
        'manage_options',
        'vatopt',
        'vatopt'
    );
}

add_action( 'admin_init', 'register_vatopt_settings' );

function register_vatopt_settings() {
    //register our settings
    register_setting( 'sd-payment-link-vat', 'sd_payment_link_vat' );
    $currentSetting = get_option('sd_payment_link_vat');
    if(!$currentSetting && $currentSetting !== 0 && $currentSetting !== "0") {
        update_option('sd_payment_link_vat', '23');
    }
}

function vatopt(){ ?>
    <div class="wrap">
        <h1>Vat amount to be charged on products</h1>
        <form method="post" action="options.php">
            <?php settings_fields( 'sd-payment-link-vat' ); ?>
            <?php do_settings_sections( 'sd-payment-link-vat' ); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Vat (number without % sign)</th>
                    <td><input type="text" name="sd_payment_link_vat" style="width: 25%" value="<?php echo esc_attr( get_option('sd_payment_link_vat') ); ?>" /></td>
                </tr>
            </table>

            <?php submit_button(); ?>

        </form>
    </div>

<?php }
