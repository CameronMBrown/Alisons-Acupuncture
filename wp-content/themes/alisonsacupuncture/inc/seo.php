<?php

/**
 * SEO for Alison's Acupuncture
 *
 * - Enhances Yoast's Organization schema node into a LocalBusiness/MedicalBusiness
 *   with full NAP, geo, opening hours, service area and a catalogue of services.
 * - Supplies keyword-rich, Cobourg-targeted title / meta description / Open Graph
 *   defaults for the front page (Yoast admin values still take precedence).
 *
 * Business NAP + hours are read from the ACF fields on the front page
 * (see acf-json/group_business_info.json and group_homepage.json) so the schema
 * stays in sync with the site content.
 */

if (!defined('ABSPATH')) {
  exit;
}

/**
 * Read and normalise the business info used across the SEO output.
 * Values come from ACF fields stored on the front page.
 *
 * @return array
 */
function alisons_business_info()
{
  static $info = null;
  if ($info !== null) {
    return $info;
  }

  $front_id = (int) get_option('page_on_front');

  $phone = trim((string) get_field('phone_number', $front_id));
  $phone_href = $phone ? preg_replace('/(?!^\+)[^\d]/', '', $phone) : '';

  $sameas = array_values(array_filter(array(
    get_field('facebook', $front_id),
    get_field('instagram', $front_id),
  )));

  $info = array(
    'name'        => "Alison's Acupuncture and Dry Needling",
    'phone'       => $phone,
    'phone_href'  => $phone_href,
    'email'       => trim((string) get_field('email', $front_id)),
    'address_raw' => trim((string) get_field('address', $front_id)),
    // Structured address — street/locality/region are stable; postal/geo come
    // from optional ACF fields with a verified fallback (see TODO below).
    'street'      => '304 Division Street',
    'locality'    => 'Cobourg',
    'region'      => 'ON',
    'postal_code' => trim((string) get_field('postal_code', $front_id)) ?: 'K9A 3R3',
    'country'     => 'CA',
    'latitude'    => (float) (get_field('latitude', $front_id) ?: 43.971575),
    'longitude'   => (float) (get_field('longitude', $front_id) ?: -78.170566),
    'price_range' => '$$',
    'has_map'     => 'https://maps.google.com/maps?daddr=Grandhall+304+Division+Street+Cobourg%2C+ON',
    'sameas'      => $sameas,
    'hours_spec'  => alisons_opening_hours_spec($front_id),
    // Towns targeted for local search (Cobourg + surrounding Northumberland County).
    'areas'       => array('Cobourg', 'Port Hope', 'Baltimore', 'Grafton', 'Colborne'),
    'county'      => 'Northumberland County',
    // Services offered — used to build the schema OfferCatalog. Kept as an
    // explicit list because the services are individual ACF fields, not a repeater.
    'services'    => array(
      'Acupuncture',
      'Electroacupuncture',
      'Dry Needling',
      'Cupping',
      'Soft Tissue Therapy',
      'Lower Body Tissue Work',
      'Gua Sha',
      'Ear Irrigation',
      'Dizziness and Balance Support Care (Vestibular Rehabilitation Therapy)',
      'Medication Education',
      'Blood Pressure and Heart Rate Monitoring',
    ),
  );

  return $info;
}

/**
 * Build a schema.org openingHoursSpecification array from the per-day ACF
 * hours fields (hours_monday … hours_sunday). "Closed" days are skipped.
 * A value such as "8:00 AM - 4:30 PM" becomes opens "08:00", closes "16:30".
 *
 * @param int $front_id Front page post ID.
 * @return array
 */
function alisons_opening_hours_spec($front_id)
{
  $days = array(
    'monday'    => 'Monday',
    'tuesday'   => 'Tuesday',
    'wednesday' => 'Wednesday',
    'thursday'  => 'Thursday',
    'friday'    => 'Friday',
    'saturday'  => 'Saturday',
    'sunday'    => 'Sunday',
  );

  $spec = array();

  foreach ($days as $key => $label) {
    $value = get_field('hours_' . $key, $front_id);

    if (!is_string($value) || $value === '' || strtolower(trim($value)) === 'closed') {
      continue;
    }

    // Split on a hyphen/en-dash surrounded by optional whitespace.
    $parts = preg_split('/\s*[-\x{2013}]\s*/u', trim($value));
    if (count($parts) !== 2) {
      continue;
    }

    $opens  = alisons_to_24h($parts[0]);
    $closes = alisons_to_24h($parts[1]);
    if (!$opens || !$closes) {
      continue;
    }

    $spec[] = array(
      '@type'     => 'OpeningHoursSpecification',
      'dayOfWeek' => 'https://schema.org/' . $label,
      'opens'     => $opens,
      'closes'    => $closes,
    );
  }

  return $spec;
}

/**
 * Convert a display time like "8:00 AM" to a 24-hour "HH:MM" string.
 *
 * @param string $time
 * @return string Empty string on failure.
 */
function alisons_to_24h($time)
{
  $ts = strtotime(trim($time));
  return $ts ? date('H:i', $ts) : '';
}

/**
 * Enhance Yoast's Organization graph node into a LocalBusiness/MedicalBusiness.
 *
 * Keeps the single #organization node (referenced by WebPage.about and
 * WebSite.publisher) rather than adding a duplicate node, so the graph stays
 * consistent. Yoast's existing logo/image/sameAs are preserved.
 */
add_filter('wpseo_schema_organization', function ($data) {
  if (!function_exists('get_field')) {
    return $data;
  }

  $b = alisons_business_info();

  // Broaden the type so search engines read this as a local medical business.
  $data['@type'] = array('Organization', 'MedicalBusiness');

  $data['address'] = array_filter(array(
    '@type'           => 'PostalAddress',
    'streetAddress'   => $b['street'],
    'addressLocality' => $b['locality'],
    'addressRegion'   => $b['region'],
    'postalCode'      => $b['postal_code'],
    'addressCountry'  => $b['country'],
  ));

  if ($b['latitude'] && $b['longitude']) {
    $data['geo'] = array(
      '@type'     => 'GeoCoordinates',
      'latitude'  => $b['latitude'],
      'longitude' => $b['longitude'],
    );
    $data['hasMap'] = $b['has_map'];
  }

  if ($b['phone']) {
    $data['telephone'] = $b['phone'];
  }
  if ($b['email']) {
    $data['email'] = $b['email'];
  }
  $data['priceRange'] = $b['price_range'];

  // Service area: Cobourg + surrounding Northumberland County towns.
  $area = array();
  foreach ($b['areas'] as $city) {
    $area[] = array('@type' => 'City', 'name' => $city);
  }
  $area[] = array('@type' => 'AdministrativeArea', 'name' => $b['county']);
  $data['areaServed'] = $area;

  if (!empty($b['hours_spec'])) {
    $data['openingHoursSpecification'] = $b['hours_spec'];
  }

  // Catalogue of services as an OfferCatalog of MedicalTherapy offerings.
  $offers = array();
  foreach ($b['services'] as $service) {
    $offers[] = array(
      '@type'       => 'Offer',
      'itemOffered' => array(
        '@type' => 'MedicalTherapy',
        'name'  => $service,
      ),
    );
  }
  $data['hasOfferCatalog'] = array(
    '@type'           => 'OfferCatalog',
    'name'            => 'Acupuncture & Wellness Services',
    'itemListElement' => $offers,
  );

  return $data;
});

/**
 * Keyword-rich, Cobourg-targeted title / meta description / social defaults for
 * the front page. Yoast admin values (if set) still win, since these only fill
 * the default the filters receive.
 */
add_filter('wpseo_title', function ($title) {
  if (is_front_page()) {
    return "Acupuncture & Dry Needling in Cobourg, ON | Alison's Acupuncture";
  }
  return $title;
});

add_filter('wpseo_metadesc', function ($desc) {
  if (is_front_page()) {
    return 'Registered Practical Nurse offering acupuncture, dry needling, cupping and soft tissue therapy in Cobourg, ON. Serving Cobourg, Port Hope and Northumberland County. Book your appointment today.';
  }
  return $desc;
});

add_filter('wpseo_opengraph_title', function ($title) {
  if (is_front_page()) {
    return "Acupuncture & Dry Needling in Cobourg, ON | Alison's Acupuncture";
  }
  return $title;
});

$alisons_og_desc = function ($desc) {
  if (is_front_page()) {
    return 'Acupuncture, dry needling, cupping and soft tissue therapy in Cobourg, ON — serving Cobourg, Port Hope and Northumberland County.';
  }
  return $desc;
};
add_filter('wpseo_opengraph_desc', $alisons_og_desc);
add_filter('wpseo_twitter_description', $alisons_og_desc);

add_filter('wpseo_twitter_title', function ($title) {
  if (is_front_page()) {
    return "Acupuncture & Dry Needling in Cobourg, ON | Alison's Acupuncture";
  }
  return $title;
});
