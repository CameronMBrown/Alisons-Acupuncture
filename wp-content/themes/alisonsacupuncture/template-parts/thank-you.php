<?php

/**
 * Thank You Page
 */

get_header();

$trees   = wp_get_attachment_image_src(142, 'full');
$logo_url = wp_get_attachment_image_url(137, 'full');
$name     = isset($_GET['name']) ? sanitize_text_field(wp_unslash($_GET['name'])) : '';
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
            Email Sent
          </h1>
          <p class="hero-subtitle slide-in-bottom delay-short">
            <?php if ($name) : ?>
              <?php echo esc_html("Thank you, {$name}, we will be in touch shortly."); ?>
            <?php else : ?>
              Thank you, we will be in touch shortly.
            <?php endif; ?>
          </p>
          <button class="slide-in-bottom delay-regular">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn">
              Return to Homepage
            </a>
          </button>
        </div>
      </div>
    </div>
  </section>
</main>

<?php
get_footer();
