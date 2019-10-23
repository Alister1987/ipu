<?php
/**
 * Plugin Name: SD Payment Link
 * Description: Create products and invoices and integrate payment by link
 * Version: 0.1
 * Author: Software Design
 * Author URI: http://www.lightbox.ie
 */
/**
 * Created by PhpStorm.
 * User: wojciech
 * Date: 13/03/2018
 * Time: 17:01
 */

add_action('admin_menu', 'register_proj');
add_action('admin_menu', 'register_inv');
add_action('admin_menu', 'register_vatopt');
add_action('admin_menu', 'rewrite_menus');

function rewrite_menus(){
    global $submenu;

    $submenu['edit.php?post_type=invoice'][10] = '';
    $submenu['edit.php?post_type=product_register'][10] = '';
}

include("cpt/register_fields.php");
include("cpt/invoice.php");
include("cpt/product_register.php");
include("register_product.php");
include("generate_invoice.php");
include("vat_option.php");
include("edit_redirects.php");
include("invoice_payment.php");
