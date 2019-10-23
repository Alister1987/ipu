<?php

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_social-buttons',
		'title' => 'Social buttons',
		'fields' => array (
			array (
				'key' => 'field_59c138cc121b4',
				'label' => 'Share Options',
				'name' => 'share_options',
				'type' => 'true_false',
				'message' => 'Do you want to show the share buttons ?',
				'default_value' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'news',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}


