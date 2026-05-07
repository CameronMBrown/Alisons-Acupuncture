<?php

/**
 * Front Page About Section
 */
?>
<section id="about" class="about-section">
  <div class="cntr">
    <div class="about-content">
      <div class="about-text">
        <h2><?php the_field('about_title'); ?></h2>
        <p>Use the page editor content above to add an introduction or about section. This section is managed in the normal WordPress page editor.</p>
      </div>
      <?php
      $about_image = get_field('about_image');
      if ($about_image) :
      ?>
        <div class="about-image">
          <img src="<?php echo esc_url($about_image); ?>" alt="<?php the_field('about_title'); ?>" />
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>