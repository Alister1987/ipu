<?php
/**
 * Created by PhpStorm.
 * User: wojciech
 * Date: 13/03/2018
 * Time: 16:57
 */

if (!function_exists( 'create_invoice_cpt' )){
    function create_invoice_cpt(){

        $labels = array(
            'name' => __('Payment Link'),
            'singular_name' => __('Invoice Single'),
            'all_items' => __('All Invoices'),
            'add_new_item' => __('Add New Invoice'),
            'add_new' => __('Add New Payment Link'),
            'edit_item' => __('Edit Invoice'),
            'view_item' => __('View Invoice'),
            'search_items' => __('Search Invoices'),
            'not_found' => __('No Invoices'),
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'has_archive' => false,
            'publicly_queryable' => false,
            'query_var' => false,
            'rewrite' => array( 'slug' => 'invoice', 'with_front' => false ),
            'capability_type' => 'post',
            'show_in_nav' => true,
            'taxonomies' => array( '' ),
            'show_in_menu' => true,
            'exclude_from_search' => true,
            'can_export' => true,
            'supports' => array(),
        );

        register_post_type( 'invoice', $args );
    }

    add_action('init', 'create_invoice_cpt', 'flush_rewrite_rules');
}