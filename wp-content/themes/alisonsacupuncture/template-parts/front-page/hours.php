<?php

/**
 * Front Page Hours Section
 */
?>
<section id="hours" class="hours-section">
  <div class="cntr">
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