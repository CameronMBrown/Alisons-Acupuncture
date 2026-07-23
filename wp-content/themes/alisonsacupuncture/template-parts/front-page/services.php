<?php

/**
 * Front Page Services Section
 */

$services = [
  'acupuncture'          => ['title' => 'acupuncture_title',          'desc' => 'acupuncture_description',          'img' => 'acupuncture_image'],
  'electroacupuncture'   => ['title' => 'electroacupuncture_title',   'desc' => 'electroacupuncture_description',   'img' => 'electroacupuncture_image'],
  'dry_needling'         => ['title' => 'dryneedling_title',          'desc' => 'dryneedling_description',          'img' => 'dryneedling_image'],
  'cupping'              => ['title' => 'cupping_title',              'desc' => 'cupping_description',              'img' => 'cupping_image'],
  'fire_cupping'         => ['title' => 'fire_cupping_title',         'desc' => 'fire_cupping_description',         'img' => 'fire_cupping_image'],
  'tissue_work'          => ['title' => 'tissuework_title',           'desc' => 'tissuework_description',           'img' => 'tissuework_image'],
  'lower_tissue_work'    => ['title' => 'lowertissuework_title',      'desc' => 'lowertissuework_description',      'img' => 'lowertissuework_image'],
  'guasha'               => ['title' => 'guasha_title',               'desc' => 'guasha_description',               'img' => 'guasha_image'],
  'earwax'               => ['title' => 'earwax_title',               'desc' => 'earwax_description',               'img' => 'earwax_image'],
  'balancecare'          => ['title' => 'balancecare_title',          'desc' => 'balancecare_description',          'img' => 'balancecare_image'],
  'medication_education' => ['title' => 'medication_education_title', 'desc' => 'medication_education_description', 'img' => 'medication_education_image'],
  'heart_health'         => ['title' => 'heart_health_title',         'desc' => 'heart_health_description',         'img' => 'heart_health_image'],
];

$logo = wp_get_attachment_image(141, 'full', false, ['class' => 'service-card-logo']);
?>
<section id="services" class="services-section">
  <div class="cntr">
    <h2 class="text-3d-shadow slide-in-bottom"><?php the_field('services_title'); ?></h2>
    <div class="services-grid">
      <?php foreach ($services as $key => $fields) :
        $group = get_field($key);
        $title = $group[$fields['title']] ?? '';
        $description = $group[$fields['desc']] ?? '';
        $image_id = $group[$fields['img']] ?? '';
        $image_html = $image_id ? wp_get_attachment_image($image_id, 'service-card', false, [
          'class'   => 'service-card-image',
          'loading' => 'lazy',
        ]) : '';
      ?>
        <div class="service-card slide-in-bottom" tabindex="0">
          <div class="service-card-inner">
            <div class="service-card-front">
              <?php echo $image_html; ?>
              <h3 class="text-3d-shadow"><?php echo esc_html($title); ?></h3>
            </div>
            <div class="service-card-back">
              <?php if ($logo) : ?>
                <?php echo $logo; ?>
              <?php endif; ?>
              <?php if ($description) : ?>
                <p><?php echo esc_html($description); ?></p>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>