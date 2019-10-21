<?php
/**
 * Created by PhpStorm.
 * User: wojciech
 * Date: 13/03/2018
 * Time: 16:57
 */

if (!function_exists( 'create_product_register_cpt' )){
    function create_product_register_cpt(){

        $labels = array(
            'name' => __('Product Register'),
            'singular_name' => __('Product Register Single'),
            'all_items' => __('All Product Registers'),
            'add_new_item' => __('Add New Product Register'),
            'add_new' => __('Add New Product Register'),
            'edit_item' => __('Edit Product Register'),
            'view_item' => __('View Product Register'),
            'search_items' => __('Search Product Registers'),
            'not_found' => __('No Product Registers'),
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'has_archive' => false,
            'publicly_queryable' => false,
            'query_var' => false,
            'rewrite' => array( 'slug' => 'productregister', 'with_front' => false ),
            'capability_type' => 'post',
            'show_in_nav' => true,
            'taxonomies' => array( '' ),
            'show_in_menu' => true,
            'exclude_from_search' => true,
            'can_export' => true,
            'supports' => array(),
        );

        register_post_type( 'product_register', $args );
    }

    add_action('init', 'create_product_register_cpt', 'flush_rewrite_rules');
}