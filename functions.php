<?php

/**
 * Alison's Acupuncture Child Theme Functions
 */

// Enqueue parent theme stylesheet
add_action('wp_enqueue_scripts', function () {
  wp_enqueue_style('twentytwentyfive-style', get_template_directory_uri() . '/style.css');
  wp_enqueue_style('alisonsacupuncture-custom', get_stylesheet_directory_uri() . '/assets/css/custom.css', array('twentytwentyfive-style'), '1.0.0');
});

// Register ACF Fields for Homepage Content
if (function_exists('acf_add_local_field_group')) {
  acf_add_local_field_group(array(
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
  ));

  // Services Field Group
  acf_add_local_field_group(array(
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
        'key'               => 'field_service_1_icon',
        'label'             => 'Service 1 Icon',
        'name'              => 'service_1_icon',
        'type'              => 'text',
        'placeholder'       => 'e.g., 💉',
      ),
      array(
        'key'               => 'field_service_1_name',
        'label'             => 'Service 1 Name',
        'name'              => 'service_1_name',
        'type'              => 'text',
        'default_value'     => 'Acupuncture',
      ),
      array(
        'key'               => 'field_service_1_description',
        'label'             => 'Service 1 Description',
        'name'              => 'service_1_description',
        'type'              => 'textarea',
        'rows'              => 3,
        'default_value'     => 'Gentle, evidence-based acupuncture care tailored to your needs.',
      ),
      array(
        'key'               => 'field_service_2_icon',
        'label'             => 'Service 2 Icon',
        'name'              => 'service_2_icon',
        'type'              => 'text',
        'placeholder'       => 'e.g., ⚡',
      ),
      array(
        'key'               => 'field_service_2_name',
        'label'             => 'Service 2 Name',
        'name'              => 'service_2_name',
        'type'              => 'text',
        'default_value'     => 'Dry Needling',
      ),
      array(
        'key'               => 'field_service_2_description',
        'label'             => 'Service 2 Description',
        'name'              => 'service_2_description',
        'type'              => 'textarea',
        'rows'              => 3,
        'default_value'     => 'Targeted muscle therapy for fast relief from pain and tension.',
      ),
      array(
        'key'               => 'field_service_3_icon',
        'label'             => 'Service 3 Icon',
        'name'              => 'service_3_icon',
        'type'              => 'text',
        'placeholder'       => 'e.g., 🩺',
      ),
      array(
        'key'               => 'field_service_3_name',
        'label'             => 'Service 3 Name',
        'name'              => 'service_3_name',
        'type'              => 'text',
        'default_value'     => 'Cupping',
      ),
      array(
        'key'               => 'field_service_3_description',
        'label'             => 'Service 3 Description',
        'name'              => 'service_3_description',
        'type'              => 'textarea',
        'rows'              => 3,
        'default_value'     => 'Traditional cupping therapy to support circulation and muscle relaxation.',
      ),
      array(
        'key'               => 'field_service_4_icon',
        'label'             => 'Service 4 Icon',
        'name'              => 'service_4_icon',
        'type'              => 'text',
        'placeholder'       => 'e.g., 🧘',
      ),
      array(
        'key'               => 'field_service_4_name',
        'label'             => 'Service 4 Name',
        'name'              => 'service_4_name',
        'type'              => 'text',
        'default_value'     => 'Gua Sha & Tissue Work',
      ),
      array(
        'key'               => 'field_service_4_description',
        'label'             => 'Service 4 Description',
        'name'              => 'service_4_description',
        'type'              => 'textarea',
        'rows'              => 3,
        'default_value'     => 'Soothing soft tissue techniques designed to ease stiffness and restore balance.',
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
  ));
}
