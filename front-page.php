<?php

/**
 * Front Page Template for Alison's Acupuncture
 */

get_header();
?>

<main id="main" class="site-main">

  <!-- Hero/Header Section -->
  <section id="hero" class="hero-section">
    <?php
    $header_image = get_field('header_image');
    if ($header_image) :
    ?>
      <div class="hero-background" style="background-image: url('<?php echo esc_url($header_image); ?>');">
      </div>
    <?php
    endif;
    ?>
    <div class="hero-content">
      <h1 class="hero-title"><?php bloginfo('name'); ?></h1>
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
  </section>

  <!-- Hours Section -->
  <section id="hours" class="hours-section">
    <div class="container">
      <h2><?php the_field('hours_title'); ?></h2>
      <div class="hours-grid">
        <div class="hours-day">
          <strong>Monday</strong>
          <p><?php the_field('hours_monday'); ?></p>
        </div>
        <div class="hours-day">
          <strong>Tuesday</strong>
          <p><?php the_field('hours_tuesday'); ?></p>
        </div>
        <div class="hours-day">
          <strong>Wednesday</strong>
          <p><?php the_field('hours_wednesday'); ?></p>
        </div>
        <div class="hours-day">
          <strong>Thursday</strong>
          <p><?php the_field('hours_thursday'); ?></p>
        </div>
        <div class="hours-day">
          <strong>Friday</strong>
          <p><?php the_field('hours_friday'); ?></p>
        </div>
        <div class="hours-day">
          <strong>Saturday</strong>
          <p><?php the_field('hours_saturday'); ?></p>
        </div>
        <div class="hours-day">
          <strong>Sunday</strong>
          <p><?php the_field('hours_sunday'); ?></p>
        </div>
      </div>
      <p class="hours-note"><?php the_field('hours_note'); ?></p>
    </div>
  </section>

  <!-- Intro Section -->
  <section id="intro" class="intro-section">
    <div class="container">
      <?php
      if (have_posts()) :
        while (have_posts()) :
          the_post();
          the_content();
        endwhile;
      endif;
      ?>
    </div>
  </section>

  <!-- About Section -->
  <section id="about" class="about-section">
    <div class="container">
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
        <?php
        endif;
        ?>
      </div>
    </div>
  </section>

  <!-- Services Section -->
  <section id="services" class="services-section">
    <div class="container">
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

  <!-- Contact Section -->
  <section id="contact" class="contact-section">
    <div class="container">
      <h2>Get in Touch</h2>
      <div class="contact-info">
        <p>Ready to start your healing journey? Reach out to me directly.</p>
        <p>
          <strong>Phone:</strong> <a href="tel:<?php echo esc_attr(str_replace(array(' ', '-', '(', ')'), '', get_field('business_phone'))); ?>"><?php the_field('business_phone'); ?></a>
        </p>
        <p>
          <strong>Address:</strong><br />
          <?php the_field('business_address'); ?>
        </p>
      </div>
      <!-- Contact form will be added here during manual configuration -->
      <p style="font-style: italic; color: #999; margin-top: 2rem;">Contact form to be configured</p>
    </div>
  </section>

</main>

<?php
get_footer();
