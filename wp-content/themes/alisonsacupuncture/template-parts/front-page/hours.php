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
?>

<section class="hours-section" id="hours">

  <?php if (!empty($hours_image)) : ?>
    <div class="hours-image">
      <img
        src="<?php echo esc_url($hours_image[0]); ?>"
        alt="<?php echo esc_attr($hours_alt_txt); ?>"
        loading="lazy">
    </div>
  <?php endif; ?>
  <div class="hours-layout">
    <svg class="blob-svg blob-svg--top-left" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
      <path d="M21 3v2c0 9.627-5.373 14-12 14H7.098c.212-3.012 1.15-4.835 3.598-7.001 1.204-1.065 1.102-1.68.509-1.327-4.084 2.43-6.112 5.714-6.202 10.958L5 22H3c0-1.363.116-2.6.346-3.732C3.116 16.974 3 15.218 3 13 3 7.477 7.477 3 13 3c2 0 4 1 8 0z"/>
    </svg>
    <div class="hours-content">
      <h2 class="text-3d-shadow slide-in-right"><?php the_field('hours_title'); ?></h2>
      <table class="hours-table slide-in-right">
        <tbody>
          <?php foreach ($days as $day_key => $day_label) : ?>
            <?php
            $hours_value = get_field('hours_' . $day_key);
            $is_closed = is_string($hours_value) && strtolower(trim($hours_value)) === 'closed';
            ?>
            <tr class="<?php echo $is_closed ? 'closed' : ''; ?>"
              data-day="<?php echo esc_attr($day_key); ?>">
              <th scope="row"><?php echo esc_html($day_label); ?></th>
              <td><?php echo esc_html($hours_value); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <?php if (get_field('hours_note')) : ?>
        <p class="hours-note slide-in-right delay-regular"><?php the_field('hours_note'); ?></p>
      <?php endif; ?>
    </div>
  </div>

  <svg class="blob-svg blob-svg--bottom-right" viewBox="0 -32 576 576" xmlns="http://www.w3.org/2000/svg">
    <path d="M546.2 9.7c-5.6-12.5-21.6-13-28.3-1.2C486.9 62.4 431.4 96 368 96h-80C182 96 96 182 96 288c0 7 .8 13.7 1.5 20.5C161.3 262.8 253.4 224 384 224c8.8 0 16 7.2 16 16s-7.2 16-16 16C132.6 256 26 410.1 2.4 468c-6.6 16.3 1.2 34.9 17.5 41.6 16.4 6.8 35-1.1 41.8-17.3 1.5-3.6 20.9-47.9 71.9-90.6 32.4 43.9 94 85.8 174.9 77.2C465.5 467.5 576 326.7 576 154.3c0-50.2-10.8-102.2-29.8-144.6z"/>
  </svg>
</section>