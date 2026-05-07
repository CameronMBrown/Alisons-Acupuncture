<?php

/**
 * Front Page Hero Section
 */

$title = get_field('header_primary_text');
$portrait_src = wp_get_attachment_image_src(get_field('hero_avatar_image'), 'full');
?>

<section id="hero" class="hero-section">
  <div class="hero-content">
    <div class="cntr hero-layout">
      <div class="hero-r">
        <h1 class="hero-title"><?php echo esc_html($title); ?></h1>
        <p class="hero-tagline"><?php the_field('header_tagline'); ?></p>
        <div class="hero-contact-info">
          <p class="hero-phone">
            <a href="tel:<?php echo esc_attr(str_replace(array(' ', '-', '(', ')'), '', get_field('business_phone'))); ?>">
              <?php the_field('business_phone'); ?>
            </a>
          </p>
          <p class="hero-address"><?php the_field('business_address'); ?></p>
        </div>
      </div>
      <img src="<?php echo esc_url($portrait_src[0]); ?>" alt="A portrait of Alison" class="hero-avatar">

    </div>
  </div>
</section>