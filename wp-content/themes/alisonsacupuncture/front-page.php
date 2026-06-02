<?php

/**
 * Front Page Template for Alison's Acupuncture
 */

get_header();
?>

<main id="main" class="site-main">
  <?php get_template_part('template-parts/front-page/hero'); ?>
  <?php get_template_part('template-parts/front-page/about'); ?>
  <?php get_template_part('template-parts/front-page/services'); ?>
  <?php get_template_part('template-parts/front-page/hours'); ?>
  <?php get_template_part('template-parts/front-page/contact'); ?>
</main>

<?php
get_footer();
