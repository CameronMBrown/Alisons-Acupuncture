<?php

/**
 * Alison's Acupuncture Child Theme Functions
 */

// Enqueue parent theme stylesheet
add_action('wp_enqueue_scripts', function () {
  wp_enqueue_style('oceanwp-parent-style', get_template_directory_uri() . '/style.css');
  wp_enqueue_style('alisonsacupuncture-custom', get_stylesheet_directory_uri() . '/assets/css/custom.css', array('oceanwp-parent-style'), '1.0.0');

  wp_enqueue_script(
    'alisonsacupuncture-animations',
    get_stylesheet_directory_uri() . '/assets/js/animations.js',
    array(),
    '1.0.0',
    true
  );

  wp_enqueue_script(
    'alisonsacupuncture-hero-parallax',
    get_stylesheet_directory_uri() . '/assets/js/hero-parallax.js',
    array('alisonsacupuncture-animations'),
    '1.0.0',
    true
  );

  wp_enqueue_script(
    'alisonsacupuncture-about-parallax',
    get_stylesheet_directory_uri() . '/assets/js/about-parallax.js',
    array(),
    '1.0.0',
    true
  );

  wp_enqueue_script(
    'alisonsacupuncture-contact-appointment',
    get_stylesheet_directory_uri() . '/assets/js/contact-appointment.js',
    array(),
    '1.0.0',
    true
  );
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

// Register thank-you query var
add_filter('query_vars', function ($vars) {
  $vars[] = 'thank_you';
  return $vars;
});

// Register /thank-you/ rewrite rule
add_action('init', function () {
  add_rewrite_rule('^thank-you/?$', 'index.php?thank_you=1', 'top');
});

// Handle thank-you page
add_action('template_redirect', function () {
  if (get_query_var('thank_you')) {
    // Prevent search engines from indexing this page
    add_filter('wp_robots', function ($robots) {
      $robots['noindex'] = true;
      $robots['nofollow'] = true;
      return $robots;
    });

    include get_stylesheet_directory() . '/template-parts/thank-you.php';
    exit;
  }
});
