<?php

/**
 * 404 Page Template for Alison's Acupuncture
 */

get_header();
?>

<main id="main" class="site-main">
  <div class="cntr">
    <section class="error-404 not-found">
      <header class="page-header">
        <h1 class="page-title"><?php esc_html_e('Oops! Page Not Found', 'alisonsacupuncture'); ?></h1>
      </header>

      <div class="page-content">
        <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try going back to the homepage?', 'alisonsacupuncture'); ?></p>
        <a href="<?php echo esc_url(home_url('/')); ?>" target="_self" class="button"><?php esc_html_e('Go to Homepage', 'alisonsacupuncture'); ?></a>
      </div>
    </section>
  </div>
</main>

<?php
get_footer();
