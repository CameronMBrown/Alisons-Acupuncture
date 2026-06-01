<?php

/**
 * Front Page About Section
 */

$title = get_field('about_title');
$body = get_field('about_text');
$bg_image_id = get_field('about_image');
$bg_image_url = $bg_image_id ? wp_get_attachment_image_url($bg_image_id, 'full') : '';

do_action('qm/debug', $bg_image_url);

?>
<section id="about" class="about-section">
  <img class="about-bg" src="<?php echo esc_url($bg_image_url); ?>" alt="<?php echo esc_attr($title); ?>">
  <div class="cntr left">
    <div class="about-content">
      <div class="about-text">
        <h2 class="text-shadow"><?php echo esc_html($title); ?></h2>
        <p><?php echo esc_html($body); ?></p>
      </div>
    </div>
  </div>
</section>