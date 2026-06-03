<?php

/**
 * 404 Page Template for Alison's Acupuncture
 */

get_header();

$trees = wp_get_attachment_image_src(142, 'full');
$logo_url = wp_get_attachment_image_url(137, 'full');
?>

<main id="main" class="site-main">
  <section class="hero-section error-404-section">
    <div class="trees-background-container">
      <div class="trees-background trees-1">
        <img src="<?php echo esc_url($trees[0]); ?>" alt="" loading="eager">
      </div>
      <div class="trees-background trees-2">
        <img src="<?php echo esc_url($trees[0]); ?>" alt="" loading="eager">
      </div>
      <div class="trees-background trees-3">
        <img src="<?php echo esc_url($trees[0]); ?>" alt="" loading="eager">
      </div>
      <div class="trees-background trees-4">
        <img src="<?php echo esc_url($trees[0]); ?>" alt="" loading="eager">
      </div>
    </div>

    <?php if ($logo_url) : ?>
      <div class="error-404-logo-bg">
        <img src="<?php echo esc_url($logo_url); ?>" alt="" aria-hidden="true">
      </div>
    <?php endif; ?>

    <div class="hero-content">
      <div class="cntr">
        <div class="error-404-content">
          <h1 class="hero-title text-3d-shadow slide-in-bottom">
            <?php esc_html_e('Oops! Page Not Found', 'alisonsacupuncture'); ?>
          </h1>
          <p class="hero-subtitle slide-in-bottom delay-short">
            <?php esc_html_e('It looks like nothing was found at this location. Return to the homepage?', 'alisonsacupuncture'); ?>
          </p>
          <a href="<?php echo esc_url(home_url('/')); ?>" class="hero-cta-btn slide-in-bottom delay-regular">
            <?php esc_html_e('Go to Homepage', 'alisonsacupuncture'); ?>
          </a>
        </div>
      </div>
    </div>
  </section>
</main>

<?php
get_footer();
