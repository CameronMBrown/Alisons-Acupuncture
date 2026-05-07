<?php

/**
 * Front Page Intro Section
 */
?>
<section id="intro" class="intro-section">
  <div class="cntr">
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