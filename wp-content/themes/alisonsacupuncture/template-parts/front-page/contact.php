<?php

/**
 * Front Page Contact Section
 */
?>
<section id="contact" class="contact-section">
  <div class="cntr">
    <h2>Get in Touch</h2>
    <div class="contact-info">
      <p>Ready to start your healing journey? Reach out to me directly.</p>
      <p>
        <strong>Phone:</strong>
        <a href="tel:<?php echo esc_attr(str_replace(array(' ', '-', '(', ')'), '', get_field('business_phone'))); ?>"><?php the_field('business_phone'); ?></a>
      </p>
      <p>
        <strong>Address:</strong><br />
        <?php the_field('business_address'); ?>
      </p>
    </div>
    <p style="font-style: italic; color: #999; margin-top: 2rem;">Contact form to be configured</p>
  </div>
</section>