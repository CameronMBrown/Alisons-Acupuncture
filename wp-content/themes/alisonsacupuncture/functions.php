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

  // Single bundle of animations, hero/about parallax, contact-appointment
  // toggle, mobile nav, and office-directions modal. Built from those 6
  // source files via `npm run build:js` (scripts/build-js.mjs) — edit the
  // sources, not this bundle.
  wp_enqueue_script(
    'alisonsacupuncture-bundle',
    get_stylesheet_directory_uri() . '/assets/js/bundle.min.js',
    array(),
    '1.0.0',
    true
  );
});

// This child theme fully overrides header.php/footer.php with its own nav,
// animations, and modals, and never calls OceanWP's oceanwp_header()/
// oceanwp_footer() template hooks, so OceanWP's own jQuery-powered features
// (mobile side panel, sticky header, scroll-to-top, etc.) have no markup to
// attach to. Drop OceanWP's main script (and jQuery, its only dependency)
// on the front end. VERIFY IN BROWSER before trusting this: click the mobile
// menu, watch scroll-in animations, and check the console for JS errors on
// every template (front page, thank-you, privacy-policy). Remove this dequeue
// if anything relies on OceanWP's JS.
add_action('wp_enqueue_scripts', function () {
  if (is_admin()) {
    return;
  }
  wp_dequeue_script('oceanwp-main');
  wp_deregister_script('oceanwp-main');
  wp_dequeue_script('jquery');
  wp_deregister_script('jquery');
}, 100);

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

  // Hard-cropped square size for service card cover images, so the served
  // crop matches the 1:1 card exactly instead of relying on CSS object-fit
  // to mask a mismatched aspect ratio.
  add_image_size('service-card', 800, 800, true);
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

