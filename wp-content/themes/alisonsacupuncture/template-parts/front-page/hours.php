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

<section class="hours-section">

  <?php if (!empty($hours_image)) : ?>
    <div class="hours-image">
      <img
        src="<?php echo esc_url($hours_image[0]); ?>"
        alt="<?php echo esc_attr($hours_alt_txt); ?>">
    </div>
  <?php endif; ?>
  <div class="hours-layout">
    <div class="hours-content">
      <h2 class="text-3d-shadow"><?php the_field('hours_title'); ?></h2>
      <table class="hours-table">
        <tbody>
          <?php foreach ($days as $day_key => $day_label) : ?>
            <?php
            $hours_value = get_field('hours_' . $day_key);
            $is_closed = is_string($hours_value) && strtolower(trim($hours_value)) === 'closed';
            ?>
            <tr class="<?php echo $is_closed ? 'closed' : ''; ?>">
              <th scope="row"><?php echo esc_html($day_label); ?></th>
              <td><?php echo esc_html($hours_value); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <?php if (get_field('hours_note')) : ?>
        <p class="hours-note"><?php the_field('hours_note'); ?></p>
      <?php endif; ?>
    </div>
  </div>
</section>