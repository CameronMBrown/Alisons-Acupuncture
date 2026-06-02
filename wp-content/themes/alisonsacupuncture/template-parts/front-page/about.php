<?php

/**
 * Front Page About Section
 */

$title = get_field('about_title');
$body = get_field('about_text');
$bg_image_id = get_field('about_image');
$bg_image_url = $bg_image_id ? wp_get_attachment_image_url($bg_image_id, 'full') : '';

?>
<section id="about" class="about-section">
  <img class="about-bg" src="<?php echo esc_url($bg_image_url); ?>" alt="<?php echo esc_attr($title); ?>">
  <div class="cntr">
    <div class="about-content">
      <div class="about-text">
        <h2 class="text-3d-shadow slide-in-left"><?php echo esc_html($title); ?></h2>
        <p class="slide-in-left"><?php echo esc_html($body); ?></p>
      </div>
    </div>
  </div>
</section>