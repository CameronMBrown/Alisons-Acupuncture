<?php
$days = [
  'sunday'    => 'Sunday',
  'monday'    => 'Monday',
  'tuesday'   => 'Tuesday',
  'wednesday' => 'Wednesday',
  'thursday'  => 'Thursday',
  'friday'    => 'Friday',
  'saturday'  => 'Saturday',
];

$img_id = get_field('hours_background_image');
$hours_image = wp_get_attachment_image_src($img_id, 'full');
$hours_alt_txt = get_post_meta($img_id, '_wp_attachment_image_alt', true);

$office_location = get_field('office_location');
$directions_steps = [];
for ($i = 1; is_array($office_location) && $i <= 4; $i++) {
  $step_img_id = $office_location['office_directions_step_#' . $i] ?? null;
  $step_image = $step_img_id ? wp_get_attachment_image_src($step_img_id, 'large') : false;
  $step_caption = $office_location['office_directions_caption_#' . $i] ?? '';

  if (!$step_image) {
    $directions_steps = [];
    break;
  }

  $directions_steps[] = [
    'src' => $step_image[0],
    'width' => $step_image[1],
    'height' => $step_image[2],
    'alt' => get_post_meta($step_img_id, '_wp_attachment_image_alt', true) ?: $step_caption,
    'caption' => $step_caption,
  ];
}
?>

<section class="hours-section" id="hours">

  <?php if (!empty($hours_image)) : ?>
    <div class="hours-image">
      <img
        src="<?php echo esc_url($hours_image[0]); ?>"
        width="<?php echo esc_attr($hours_image[1]); ?>"
        height="<?php echo esc_attr($hours_image[2]); ?>"
        alt="<?php echo esc_attr($hours_alt_txt); ?>"
        loading="lazy">

      <?php if (!empty($directions_steps)) : ?>
        <button type="button" class="btn directions-btn directions-btn--desktop js-office-directions-trigger">How to Locate my Office</button>
      <?php endif; ?>
    </div>
  <?php endif; ?>
  <div class="hours-layout">
    <svg class="blob-svg blob-svg--top-left" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
      <path d="M21 3v2c0 9.627-5.373 14-12 14H7.098c.212-3.012 1.15-4.835 3.598-7.001 1.204-1.065 1.102-1.68.509-1.327-4.084 2.43-6.112 5.714-6.202 10.958L5 22H3c0-1.363.116-2.6.346-3.732C3.116 16.974 3 15.218 3 13 3 7.477 7.477 3 13 3c2 0 4 1 8 0z" />
    </svg>
    <div class="hours-content">
      <h2 class="text-3d-shadow slide-in-right"><?php the_field('hours_title'); ?></h2>
      <table class="hours-table slide-in-right">
        <tbody>
          <?php foreach ($days as $day_key => $day_label) : ?>
            <?php
            $is_open = (bool) get_field('hours_' . $day_key . '_is_open');
            $opening_time = get_field('hours_' . $day_key . '_opening_time');
            $closing_time = get_field('hours_' . $day_key . '_closing_time');
            $has_hours = $is_open && $opening_time && $closing_time;
            ?>
            <tr class="<?php echo $has_hours ? '' : 'closed'; ?>"
              data-day="<?php echo esc_attr($day_key); ?>">
              <th scope="row"><?php echo esc_html($day_label); ?></th>
              <td>
                <?php if ($has_hours) : ?>
                  <?php echo alisons_format_hours_time($opening_time); ?> &ndash; <?php echo alisons_format_hours_time($closing_time); ?>
                <?php else : ?>
                  Closed
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <?php if (get_field('hours_note')) : ?>
        <p class="hours-note glass-card slide-in-right delay-regular"><?php the_field('hours_note'); ?></p>
      <?php endif; ?>

      <?php if (!empty($directions_steps)) : ?>
        <button type="button" class="btn btn-yellow directions-btn directions-btn--mobile js-office-directions-trigger">How to Locate my Office</button>
      <?php endif; ?>
    </div>
  </div>

  <svg class="blob-svg blob-svg--bottom-right" viewBox="0 -32 576 576" xmlns="http://www.w3.org/2000/svg">
    <path d="M546.2 9.7c-5.6-12.5-21.6-13-28.3-1.2C486.9 62.4 431.4 96 368 96h-80C182 96 96 182 96 288c0 7 .8 13.7 1.5 20.5C161.3 262.8 253.4 224 384 224c8.8 0 16 7.2 16 16s-7.2 16-16 16C132.6 256 26 410.1 2.4 468c-6.6 16.3 1.2 34.9 17.5 41.6 16.4 6.8 35-1.1 41.8-17.3 1.5-3.6 20.9-47.9 71.9-90.6 32.4 43.9 94 85.8 174.9 77.2C465.5 467.5 576 326.7 576 154.3c0-50.2-10.8-102.2-29.8-144.6z" />
  </svg>
</section>

<?php if (!empty($directions_steps)) : ?>
  <div id="office-directions-modal" class="office-directions-modal" hidden>
    <div class="office-directions-backdrop js-office-directions-close"></div>
    <div class="office-directions-dialog" role="dialog" aria-modal="true" aria-label="How to locate my office">
      <button type="button" class="office-directions-close js-office-directions-close" aria-label="Close directions">&times;</button>

      <div class="office-directions-track">
        <?php foreach ($directions_steps as $index => $step) : ?>
          <figure class="office-directions-slide" data-index="<?php echo esc_attr($index); ?>">
            <img
              src="<?php echo esc_url($step['src']); ?>"
              width="<?php echo esc_attr($step['width']); ?>"
              height="<?php echo esc_attr($step['height']); ?>"
              alt="<?php echo esc_attr($step['alt']); ?>"
              loading="lazy">
            <figcaption><?php echo esc_html($step['caption']); ?></figcaption>
          </figure>
        <?php endforeach; ?>
      </div>

      <button type="button" class="office-directions-nav office-directions-nav--prev js-office-directions-prev" aria-label="Previous step">&larr;</button>
      <button type="button" class="office-directions-nav office-directions-nav--next js-office-directions-next" aria-label="Next step">&rarr;</button>
    </div>
  </div>
<?php endif; ?>