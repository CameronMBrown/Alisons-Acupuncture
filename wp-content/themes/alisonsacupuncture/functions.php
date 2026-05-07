<?php

/**
 * Alison's Acupuncture Child Theme Functions
 */

// Enqueue parent theme stylesheet
add_action('wp_enqueue_scripts', function () {
  wp_enqueue_style('oceanwp-parent-style', get_template_directory_uri() . '/style.css');
  wp_enqueue_style('alisonsacupuncture-custom', get_stylesheet_directory_uri() . '/assets/css/custom.css', array('oceanwp-parent-style'), '1.0.0');
});

// ACF JSON save and load paths
add_filter('acf/settings/save_json', 'alisons_acf_json_save_point');
function alisons_acf_json_save_point($path)
{
  $path = get_stylesheet_directory() . '/acf-json';
  return $path;
}

add_filter('acf/settings/load_json', 'alisons_acf_json_load_point');
function alisons_acf_json_load_point($paths)
{
  unset($paths[0]);
  $paths[] = get_stylesheet_directory() . '/acf-json';
  return $paths;
}

// Register navigation menus
add_action('after_setup_theme', function () {
  register_nav_menus(array(
    'menu-1' => esc_html__('Primary', 'alisonsacupuncture'),
  ));
});
