<?php

/**
 * Front Page Hero Section
 */

$header = get_field('header_text');
$greeting = $header['header_greeting'];
$certification = $header['certification_text'];
$title = $header['header_primary_text'];
$tagline = $header['header_tagline'];

// img
$img_id = get_field('hero_avatar_image');
$portrait_src = wp_get_attachment_image_src($img_id, 'full');
$portrait_alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);

$trees = wp_get_attachment_image_src(142, 'full', false,);
?>

<section id="hero" class="hero-section">
  <div class="trees-background-container">
    <div class="trees-background trees-1">
      <img src="<?php echo esc_url($trees[0]); ?>" width="<?php echo esc_attr($trees[1]); ?>" height="<?php echo esc_attr($trees[2]); ?>" alt="A silhouette of an evergreen tree line" loading="eager">
    </div>
    <div class="trees-background trees-2">
      <img src="<?php echo esc_url($trees[0]); ?>" width="<?php echo esc_attr($trees[1]); ?>" height="<?php echo esc_attr($trees[2]); ?>" alt="A silhouette of an evergreen tree line" loading="eager">
    </div>

    <div class="trees-background trees-3">
      <img src="<?php echo esc_url($trees[0]); ?>" width="<?php echo esc_attr($trees[1]); ?>" height="<?php echo esc_attr($trees[2]); ?>" alt="A silhouette of an evergreen tree line" loading="eager">
    </div>
    <div class="trees-background trees-4">
      <img src="<?php echo esc_url($trees[0]); ?>" width="<?php echo esc_attr($trees[1]); ?>" height="<?php echo esc_attr($trees[2]); ?>" alt="A silhouette of an evergreen tree line" loading="eager">
    </div>
  </div>
  <div class="hero-content">
    <div class="cntr hero-layout">
      <div class="hero-text">
        <p class="hero-greeting slide-in-bottom"><?php echo esc_html($greeting); ?></p>
        <h1 class="hero-title text-3d-shadow slide-in-bottom delay-short">
          <?php echo esc_html($title); ?>
          <span class="hero-title--accent slide-in-bottom delay-regular"><?php echo esc_html($certification); ?></span>
        </h1>
        <p class="hero-subtitle slide-in-bottom delay-long"><?php echo esc_html($tagline); ?></p>
        <button class="btn primary-cta slide-in-bottom delay-long">
          <a href="#contact">
            Book an Appointment
          </a>
        </button>
      </div>
      <div class="hero-image-wrapper">
        <div class="hero-image-frame"></div>
        <img src="<?php echo esc_url($portrait_src[0]); ?>" width="<?php echo esc_attr($portrait_src[1]); ?>" height="<?php echo esc_attr($portrait_src[2]); ?>" alt="<?php echo esc_attr($portrait_alt); ?>" class="hero-avatar" loading="eager">
        <div class="hero-decorative-elements">
          <div class="hero-accent-wrapper">
            <div id="hero-accent-1" class="hero-accent"></div>
          </div>
          <div class="hero-accent-wrapper">
            <div id="hero-accent-2" class="hero-accent"></div>
          </div>
          <div class="hero-accent-wrapper">
            <svg
              id="hero-accent-3" class="hero-accent"
              width="256"
              height="256"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M12 2.5L2 21.5H22L12 2.5Z"
                fill="none"
                stroke="#ff9d23"
                stroke-width="0.05"
                stroke-linejoin="miter" />
            </svg>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>