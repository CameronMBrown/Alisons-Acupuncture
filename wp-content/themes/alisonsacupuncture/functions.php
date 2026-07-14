<?php

/**
 * Alison's Acupuncture Child Theme Functions
 */

// SEO: LocalBusiness/MedicalBusiness schema, meta description, Open Graph (see inc/seo.php)
require_once get_stylesheet_directory() . '/inc/seo.php';

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

  wp_enqueue_script(
    'alisonsacupuncture-mobile-nav',
    get_stylesheet_directory_uri() . '/assets/js/mobile-nav.js',
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

// Register navigation menus + let WordPress/Yoast manage the document <title>
add_action('after_setup_theme', function () {
  add_theme_support('title-tag');

  register_nav_menus(array(
    'menu-1' => esc_html__('Primary', 'alisonsacupuncture'),
  ));
});

// Register thank-you + privacy-policy query vars
add_filter('query_vars', function ($vars) {
  $vars[] = 'thank_you';
  $vars[] = 'privacy_policy';
  return $vars;
});

// Register /thank-you/ and /privacy-policy/ rewrite rules
add_action('init', function () {
  add_rewrite_rule('^thank-you/?$', 'index.php?thank_you=1', 'top');
  add_rewrite_rule('^privacy-policy/?$', 'index.php?privacy_policy=1', 'top');
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

// Handle privacy policy page
add_action('template_redirect', function () {
  if (get_query_var('privacy_policy')) {
    include get_stylesheet_directory() . '/template-parts/privacy-policy.php';
    exit;
  }
});

// Format a "8:00 AM"-style time string with the AM/PM suffix wrapped for smaller styling
function alisons_format_hours_time($time_string)
{
  if (preg_match('/^(\d{1,2}:\d{2})\s*([AaPp][Mm])$/', trim($time_string), $matches)) {
    return esc_html($matches[1]) . ' <span class="hours-meridiem">' . esc_html(strtoupper($matches[2])) . '</span>';
  }

  return esc_html($time_string);
}

