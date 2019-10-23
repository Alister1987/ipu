<?php
/**
 * Created by PhpStorm.
 * User: alessandro
 * Date: 04/07/2017
 * Time: 12:01
 */


if (!function_exists( 'create_payment_cpt' )){
	function create_payment_cpt(){

		$labels = array(
			'name' => __('Payment'),
			'singular_name' => __('Payment Single'),
			'all_items' => __('All Payments'),
			'add_new_item' => __('Add New Payment'),
			'add_new' => __('Add New Payment'),
			'edit_item' => __('Edit Payment'),
			'view_item' => __('View Payment'),
			'search_items' => __('Search Payments'),
			'not_found' => __('No Payments'),
		);

		$args = array(
			'labels' => $labels,
			'public' => true,
			'has_archive' => false,
			'publicly_queryable' => true,
			'query_var' => false,
			'rewrite' => array( 'slug' => 'payment', 'with_front' => false ),
			'capability_type' => 'post',
			'show_in_nav' => true,
			'taxonomies' => array( '' ),
			'show_in_menu' => true,
			'exclude_from_search' => true,
			'can_export' => true,
			'supports' => array(),
		);

		register_post_type( 'payment', $args );
	}

	add_action('init', 'create_payment_cpt', 'flush_rewrite_rules');
}

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_payment-cpt',
		'title' => 'Payment cpt',
		'fields' => array (
			array (
				'key' => 'field_595b7d405d479',
				'label' => 'Full Name',
				'name' => 'fullname',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_595b7d405d422',
				'label' => 'Pharmacy Name',
				'name' => 'pharmacy_name',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_595b7d405d411',
				'label' => 'Attendant Name',
				'name' => 'attendant_name',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_595b7e335d47a',
				'label' => 'User ID',
				'name' => 'user_id',
				'type' => 'user',
				'role' => array (
					0 => 'all',
				),
				'field_type' => 'select',
				'allow_null' => 1,
			),
			array (
				'key' => 'field_595b7e535d47b',
				'label' => 'Date of Purchase',
				'name' => 'date_of_purchase',
				'type' => 'date_time_picker',
				'show_date' => 'true',
				'date_format' => 'm/d/y',
				'time_format' => 'h:mm tt',
				'show_week_number' => 'false',
				'picker' => 'slider',
				'save_as_timestamp' => 'true',
				'get_as_timestamp' => 'false',
			),
			array (
				'key' => 'field_595b7e7a5d47c',
				'label' => 'Email',
				'name' => 'email',
				'type' => 'email',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_595b7ecd5d47d',
				'label' => 'Amount',
				'name' => 'amount',
				'type' => 'number',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			),
			array (
				'key' => 'field_595b7ed85d47e',
				'label' => 'Item ID',
				'name' => 'item_id',
				'type' => 'post_object',
				'post_type' => array (
					0 => 'event',
					1 => 'course',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_595b7d405d412',
				'label' => 'Event/Course Name',
				'name' => 'event_name',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_595b7ecd5d47f',
				'label' => 'Approved',
				'name' => 'approved',
				'type' => 'true_false',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			),
		),

		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'payment',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'permalink',
				1 => 'the_content',
				2 => 'excerpt',
				3 => 'custom_fields',
				4 => 'discussion',
				5 => 'comments',
				6 => 'revisions',
				7 => 'slug',
				8 => 'author',
				9 => 'format',
				10 => 'featured_image',
				11 => 'categories',
				12 => 'tags',
				13 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));
}

//requires admin column pro
if(function_exists("ac_register_columns")) {
	function ac_custom_column_settings_5a2aa7ca() {

		ac_register_columns( 'payment', array(
			array(
				'columns' => array(
					'title' => array(
						'type' => 'title',
						'label' => 'Title',
						'width' => '',
						'width_unit' => '%',
						'edit' => 'off',
						'sort' => 'on',
						'name' => 'title'
					),
					'599e9e3642c94' => array(
						'type' => 'column-acf_field',
						'label' => 'Event/Course Name',
						'width' => '',
						'width_unit' => '%',
						'field' => 'field_595b7d405d412',
						'character_limit' => '20',
						'edit' => 'off',
						'sort' => 'off',
						'filter' => 'off',
						'filter_label' => '',
						'name' => '599e9e3642c94'
					),
					'595cfd5bc85b1' => array(
						'type' => 'column-acf_field',
						'label' => 'User ID',
						'width' => '',
						'width_unit' => '%',
						'field' => 'field_595b7e335d47a',
						'display_author_as' => 'display_name',
						'user_link_to' => 'email_user',
						'edit' => 'off',
						'sort' => 'on',
						'filter' => 'off',
						'filter_label' => '',
						'name' => '595cfd5bc85b1'
					),
					'595cfd7dc4c8b' => array(
						'type' => 'column-acf_field',
						'label' => 'Full Name',
						'width' => '',
						'width_unit' => '%',
						'field' => 'field_595b7d405d479',
						'character_limit' => '20',
						'edit' => 'off',
						'sort' => 'off',
						'filter' => 'off',
						'filter_label' => '',
						'name' => '595cfd7dc4c8b'
					),
					'59a3f7164e711' => array(
						'type' => 'column-acf_field',
						'label' => 'Pharmacy Name',
						'width' => '',
						'width_unit' => '%',
						'field' => 'field_595b7d405d422',
						'character_limit' => '20',
						'edit' => 'off',
						'sort' => 'on',
						'filter' => 'on',
						'filter_label' => '',
						'name' => '59a3f7164e711'
					),
					'59a3f7164f457' => array(
						'type' => 'column-acf_field',
						'label' => 'Attendant Name',
						'width' => '',
						'width_unit' => '%',
						'field' => 'field_595b7d405d411',
						'character_limit' => '20',
						'edit' => 'off',
						'sort' => 'on',
						'filter' => 'on',
						'filter_label' => '',
						'name' => '59a3f7164f457'
					),
					'595cfd5bceaa6' => array(
						'type' => 'column-acf_field',
						'label' => 'Email',
						'width' => '',
						'width_unit' => '%',
						'field' => 'field_595b7e7a5d47c',
						'edit' => 'off',
						'sort' => 'off',
						'filter' => 'off',
						'filter_label' => '',
						'name' => '595cfd5bceaa6'
					),
					'595cfd5bdc070' => array(
						'type' => 'column-acf_field',
						'label' => 'Item ID',
						'width' => '',
						'width_unit' => '%',
						'field' => 'field_595b7ed85d47e',
						'post_property_display' => 'title',
						'post_link_to' => 'edit_post',
						'edit' => 'off',
						'sort' => 'on',
						'filter' => 'on',
						'filter_label' => '',
						'name' => '595cfd5bdc070'
					),
					'595cfd5bdcbb0' => array(
						'type' => 'column-acf_field',
						'label' => 'Date of Purchase',
						'width' => '',
						'width_unit' => '%',
						'field' => 'field_595b7e535d47b',
						'sort' => 'on',
						'filter' => 'off',
						'filter_label' => '',
						'filter_format' => '',
						'name' => '595cfd5bdcbb0',
						'date_format' => ''
					),
					'595cfd5bdd6de' => array(
						'type' => 'column-acf_field',
						'label' => 'Amount',
						'width' => '',
						'width_unit' => '%',
						'field' => 'field_595b7ecd5d47d',
						'edit' => 'off',
						'sort' => 'on',
						'filter' => 'off',
						'filter_label' => '',
						'name' => '595cfd5bdd6de'
					),
					'595cfd5be50f6' => array(
						'type' => 'column-acf_field',
						'label' => 'Approved',
						'width' => '',
						'width_unit' => '%',
						'field' => 'field_595b7ecd5d47f',
						'edit' => 'off',
						'sort' => 'off',
						'filter' => 'off',
						'filter_label' => '',
						'name' => '595cfd5be50f6'
					)
				),
				'layout' => array(
					'id' => '599e9de8d7883',
					'name' => 'test',
					'roles' => false,
					'users' => false,
					'read_only' => false
				)

			)
		) );
	}
	add_action( 'ac/ready', 'ac_custom_column_settings_5a2aa7ca' );
}