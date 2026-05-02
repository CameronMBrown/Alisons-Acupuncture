<?php
/**
 * Alison's Acupuncture Child Theme Functions
 */

// Enqueue parent theme stylesheet
add_action( 'wp_enqueue_scripts', function() {
	wp_enqueue_style( 'twentytwentyfive-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'alisonsacupuncture-custom', get_stylesheet_directory_uri() . '/assets/css/custom.css', array( 'twentytwentyfive-style' ), '1.0.0' );
} );

// Register ACF Fields for Homepage Content
if ( function_exists( 'acf_add_local_field_group' ) ) {
	acf_add_local_field_group( array(
		'key'                   => 'group_homepage',
		'title'                 => 'Homepage Settings',
		'fields'                => array(
			// Header Section
			array(
				'key'               => 'field_header_tagline',
				'label'             => 'Header Tagline',
				'name'              => 'header_tagline',
				'type'              => 'text',
				'default_value'     => 'Healing Through Traditional Chinese Medicine',
				'placeholder'       => 'Enter a short introduction or tagline',
			),
			array(
				'key'               => 'field_business_phone',
				'label'             => 'Business Phone',
				'name'              => 'business_phone',
				'type'              => 'text',
				'default_value'     => '(905) 123-4567',
				'placeholder'       => 'Enter phone number',
			),
			array(
				'key'               => 'field_business_address',
				'label'             => 'Business Address',
				'name'              => 'business_address',
				'type'              => 'textarea',
				'default_value'     => 'Grandhall 304 Division Street\nCobourg, ON',
				'placeholder'       => 'Enter full address',
				'rows'              => 3,
			),
			array(
				'key'               => 'field_header_image',
				'label'             => 'Header Background Image',
				'name'              => 'header_image',
				'type'              => 'image',
				'return_format'     => 'url',
			),
			// About Section
			array(
				'key'               => 'field_about_title',
				'label'             => 'About Section Title',
				'name'              => 'about_title',
				'type'              => 'text',
				'default_value'     => 'About Alison',
			),
			array(
				'key'               => 'field_about_content',
				'label'             => 'About Content',
				'name'              => 'about_content',
				'type'              => 'wysiwyg',
				'default_value'     => 'With a background in nursing and over 10 years of experience in acupuncture, I am dedicated to helping you achieve optimal wellness through the principles of Traditional Chinese Medicine.',
				'toolbar'           => 'basic',
			),
			array(
				'key'               => 'field_about_image',
				'label'             => 'About Section Image',
				'name'              => 'about_image',
				'type'              => 'image',
				'return_format'     => 'url',
			),
			// Hours Section
			array(
				'key'               => 'field_hours_title',
				'label'             => 'Hours Section Title',
				'name'              => 'hours_title',
				'type'              => 'text',
				'default_value'     => 'Hours of Operation',
			),
			array(
				'key'               => 'field_hours_monday',
				'label'             => 'Monday Hours',
				'name'              => 'hours_monday',
				'type'              => 'text',
				'default_value'     => 'Closed',
			),
			array(
				'key'               => 'field_hours_tuesday',
				'label'             => 'Tuesday Hours',
				'name'              => 'hours_tuesday',
				'type'              => 'text',
				'default_value'     => '8:00 AM - 4:30 PM',
			),
			array(
				'key'               => 'field_hours_wednesday',
				'label'             => 'Wednesday Hours',
				'name'              => 'hours_wednesday',
				'type'              => 'text',
				'default_value'     => '8:00 AM - 4:30 PM',
			),
			array(
				'key'               => 'field_hours_thursday',
				'label'             => 'Thursday Hours',
				'name'              => 'hours_thursday',
				'type'              => 'text',
				'default_value'     => '8:00 AM - 4:30 PM',
			),
			array(
				'key'               => 'field_hours_friday',
				'label'             => 'Friday Hours',
				'name'              => 'hours_friday',
				'type'              => 'text',
				'default_value'     => '8:00 AM - 4:30 PM',
			),
			array(
				'key'               => 'field_hours_saturday',
				'label'             => 'Saturday Hours',
				'name'              => 'hours_saturday',
				'type'              => 'text',
				'default_value'     => 'Closed',
			),
			array(
				'key'               => 'field_hours_sunday',
				'label'             => 'Sunday Hours',
				'name'              => 'hours_sunday',
				'type'              => 'text',
				'default_value'     => 'Closed',
			),
			array(
				'key'               => 'field_hours_note',
				'label'             => 'Hours Note',
				'name'              => 'hours_note',
				'type'              => 'text',
				'default_value'     => 'Evening hours vary week to week. Contact me directly for scheduling.',
			),
		),
		'location'              => array(
			array(
				array(
					'param'             => 'page_type',
					'operator'          => '==',
					'value'             => 'front_page',
				),
			),
		),
		'menu_order'            => 0,
		'position'              => 'normal',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen'        => '',
	) );

	// Services Field Group
	acf_add_local_field_group( array(
		'key'                   => 'group_services',
		'title'                 => 'Services',
		'fields'                => array(
			array(
				'key'               => 'field_services_title',
				'label'             => 'Services Section Title',
				'name'              => 'services_title',
				'type'              => 'text',
				'default_value'     => 'Our Services',
			),
			array(
				'key'               => 'field_services',
				'label'             => 'Services',
				'name'              => 'services',
				'type'              => 'repeater',
				'sub_fields'        => array(
					array(
						'key'               => 'field_service_name',
						'label'             => 'Service Name',
						'name'              => 'service_name',
						'type'              => 'text',
					),
					array(
						'key'               => 'field_service_description',
						'label'             => 'Service Description',
						'name'              => 'service_description',
						'type'              => 'textarea',
						'rows'              => 3,
					),
					array(
						'key'               => 'field_service_icon',
						'label'             => 'Service Icon (emoji or text)',
						'name'              => 'service_icon',
						'type'              => 'text',
						'placeholder'       => 'e.g., 💉 or yin-yang',
					),
				),
				'button_label'      => 'Add Service',
				'collapsed'         => '',
				'min'               => 0,
				'max'               => 0,
				'layout'            => 'table',
				'prefix_label'      => 0,
			),
		),
		'location'              => array(
			array(
				array(
					'param'             => 'page_type',
					'operator'          => '==',
					'value'             => 'front_page',
				),
			),
		),
		'menu_order'            => 1,
		'position'              => 'normal',
	) );

	// Testimonials Field Group
	acf_add_local_field_group( array(
		'key'                   => 'group_testimonials',
		'title'                 => 'Testimonials',
		'fields'                => array(
			array(
				'key'               => 'field_testimonials',
				'label'             => 'Testimonials',
				'name'              => 'testimonials',
				'type'              => 'repeater',
				'sub_fields'        => array(
					array(
						'key'               => 'field_testimonial_text',
						'label'             => 'Testimonial',
						'name'              => 'testimonial_text',
						'type'              => 'textarea',
						'rows'              => 4,
					),
					array(
						'key'               => 'field_testimonial_author',
						'label'             => 'Author Name',
						'name'              => 'testimonial_author',
						'type'              => 'text',
					),
				),
				'button_label'      => 'Add Testimonial',
				'min'               => 0,
				'layout'            => 'block',
			),
		),
		'location'              => array(
			array(
				array(
					'param'             => 'page_type',
					'operator'          => '==',
					'value'             => 'front_page',
				),
			),
		),
		'menu_order'            => 2,
		'position'              => 'normal',
	) );
}
