<?php

/**
 * Front Page Services Section
 */
?>
<section id="services" class="services-section">
  <div class="cntr">
    <h2><?php the_field('services_title'); ?></h2>
    <div class="services-grid">
      <?php for ($i = 1; $i <= 4; $i++) :
        $service_name = get_field("service_{$i}_name");
        $service_description = get_field("service_{$i}_description");
        $service_icon = get_field("service_{$i}_icon");
        if ($service_name || $service_description) :
      ?>
          <div class="service-card">
            <?php if ($service_icon) : ?>
              <div class="service-icon"><?php echo esc_html($service_icon); ?></div>
            <?php endif; ?>
            <?php if ($service_name) : ?>
              <h3><?php echo esc_html($service_name); ?></h3>
            <?php endif; ?>
            <?php if ($service_description) : ?>
              <p><?php echo esc_html($service_description); ?></p>
            <?php endif; ?>
          </div>
      <?php endif;
      endfor; ?>
    </div>
  </div>
</section>