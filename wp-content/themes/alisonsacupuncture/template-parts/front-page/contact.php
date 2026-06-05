<?php

/**
 * Front Page Contact Section
 */

$phone = get_field('phone_number');
$email = get_field('email');
$address = get_field('address');

// Fallback if ACF email is empty
if (empty($email)) {
  $email = 'info@alisonsacupuncture.com';
}

$phone_href = '';
if ($phone) {
  $phone_href = preg_replace('/(?!^\+)[^\d]/', '', trim($phone));
}

$address_encoded = $address ? urlencode($address) : '';

// ---- Form Processing (PRG) ----

$submitted_name = '';
$has_success    = false;
$has_error      = false;

if (isset($_GET['contact'])) {
  if ($_GET['contact'] === 'success') {
    $has_success    = true;
    $submitted_name = isset($_GET['name']) ? sanitize_text_field(wp_unslash($_GET['name'])) : '';
  } elseif ($_GET['contact'] === 'error') {
    $has_error = true;
  }
}

if (isset($_POST['contact_submit'])) {
  if (
    ! isset($_POST['_wpnonce']) ||
    ! wp_verify_nonce(wp_unslash($_POST['_wpnonce']), 'contact_form')
  ) {
    $redirect_url = add_query_arg('contact', 'error', get_permalink()) . '#contact';
    wp_redirect($redirect_url);
    exit;
  }

  // Honeypot — if filled, silently bail (bot)
  if (! empty($_POST['contact_website'])) {
    wp_redirect(home_url('/thank-you/'));
    exit;
  }

  $post_name    = isset($_POST['contact_name'])    ? sanitize_text_field(wp_unslash($_POST['contact_name']))    : '';
  $post_email   = isset($_POST['contact_email'])   ? sanitize_email(wp_unslash($_POST['contact_email']))         : '';
  $post_phone   = isset($_POST['contact_phone'])   ? sanitize_text_field(wp_unslash($_POST['contact_phone']))   : '';
  $post_message = isset($_POST['contact_message']) ? sanitize_textarea_field(wp_unslash($_POST['contact_message'])) : '';

  $errors = [];

  if (empty($post_name)) {
    $errors[] = 'name';
  }

  if (empty($post_email) || ! is_email($post_email)) {
    $errors[] = 'email';
  }

  if (empty($post_message)) {
    $errors[] = 'message';
  }

  if (! empty($errors)) {
    $redirect_url = add_query_arg('contact', 'error', get_permalink()) . '#contact';
    wp_redirect($redirect_url);
    exit;
  }

  $to = $email;

  $subject = "{$post_name} is requesting an appointment";

  $body  = "New Appointment Request\n";
  $body .= "========================\n\n";
  $body .= 'Date:     ' . wp_date('F j, Y g:i A') . "\n";
  $body .= "Name:     {$post_name}\n";
  $body .= "Email:    {$post_email}\n";

  if ($post_phone) {
    $body .= "Phone:    {$post_phone}\n";
  }

  $body .= "----------------------------\n";
  $body .= "Message:\n\n{$post_message}\n";

  $headers = [
    'Content-Type: text/plain; charset=UTF-8',
    "Reply-To: {$post_name} <{$post_email}>",
  ];

  $sent = wp_mail($to, $subject, $body, $headers);

  if ($sent) {
    $redirect_url = home_url('/thank-you/?name=' . urlencode($post_name));
  } else {
    $redirect_url = add_query_arg('contact', 'error', get_permalink()) . '#contact';
  }

  wp_redirect($redirect_url);
  exit;
}
?>

<section id="contact" class="contact-section">
  <div class="cntr">
    <div class="contact-header slide-in-bottom">
      <h2 class="text-3d-shadow">Get in Touch</h2>
      <div class="contact-meta">
        <?php if ($phone && $phone_href) : ?>
          <a href="tel:<?php echo esc_attr($phone_href); ?>" class="contact-meta-item" aria-label="Call us at <?php echo esc_attr($phone); ?>">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="16" height="16" fill="currentColor">
              <path d="M17.22,20.16H7a2,2,0,0,1-1.87-2.71l1.93-5.14A2,2,0,0,1,8.92,11h6.37a2,2,0,0,1,1.88,1.3l1.92,5.14A2,2,0,0,1,17.22,20.16Z"/>
              <circle cx="12.11" cy="15.59" r="2"/>
              <path d="M2.08,5.73V8.11a2,2,0,0,0,2,2H5a2,2,0,0,0,2-2V6.84H7a25.64,25.64,0,0,1,10,0h0V8.11a2,2,0,0,0,2,2h.89a2,2,0,0,0,2-2V5.73a1,1,0,0,0-.81-1h0a46.18,46.18,0,0,0-18.22,0h0A1,1,0,0,0,2.08,5.73Z"/>
            </svg>
            <?php echo esc_html($phone); ?>
          </a>
        <?php endif; ?>

        <?php if ($email) : ?>
          <a href="mailto:<?php echo esc_attr($email); ?>" class="contact-meta-item" aria-label="Email us at <?php echo esc_attr($email); ?>">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="16" height="16" fill="currentColor">
              <path d="M22 4H2v16h20V4zm-2 4l-8 5-8-5V6l8 5 8-5v2z"/>
            </svg>
            <?php echo esc_html($email); ?>
          </a>
        <?php endif; ?>

        <?php if ($address) : ?>
          <a href="https://maps.google.com/maps?daddr=<?php echo esc_attr($address_encoded); ?>" target="_blank" rel="noopener noreferrer" class="contact-meta-item" aria-label="Get directions to <?php echo esc_attr($address); ?>">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="16" height="16" fill="currentColor">
              <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
            </svg>
            <?php echo esc_html($address); ?>
          </a>
        <?php endif; ?>
      </div>
    </div>

    <?php if ($has_success) : ?>
      <div class="contact-form-status contact-success" role="status">
        <p>
          <?php if ($submitted_name) : ?>
            <?php echo esc_html("Thanks, {$submitted_name}! Your appointment request has been sent. I'll be in touch soon."); ?>
          <?php else : ?>
            Thanks! Your appointment request has been sent. I'll be in touch soon.
          <?php endif; ?>
        </p>
      </div>
    <?php else : ?>
      <div class="contact-grid">
        <div class="contact-form-wrapper slide-in-left">
          <?php if ($has_error) : ?>
            <div class="contact-form-status contact-error" role="alert">
              <p>Something went wrong. Please try again or call directly.</p>
            </div>
          <?php endif; ?>

          <form id="contact-form" action="" method="post">
            <div class="form-field">
              <label for="contact-name">
                Name <span class="required" aria-hidden="true">*</span>
              </label>
              <input
                type="text"
                id="contact-name"
                name="contact_name"
                required
                aria-required="true"
                autocomplete="name"
                placeholder="Your name">
            </div>

            <div class="form-field">
              <label for="contact-email">
                Email <span class="required" aria-hidden="true">*</span>
              </label>
              <input
                type="email"
                id="contact-email"
                name="contact_email"
                required
                aria-required="true"
                autocomplete="email"
                placeholder="your@email.com">
            </div>

            <div class="form-field">
              <label for="contact-phone">Phone</label>
              <input
                type="tel"
                id="contact-phone"
                name="contact_phone"
                autocomplete="tel"
                placeholder="(123) 456-7890">
            </div>

            <div class="form-field">
              <label for="contact-message">
                Message <span class="required" aria-hidden="true">*</span>
              </label>
              <textarea
                id="contact-message"
                name="contact_message"
                rows="5"
                required
                aria-required="true"
                placeholder="How can we help you?"></textarea>
            </div>

            <div class="form-field" style="display:none;" aria-hidden="true">
              <label for="contact-website">Leave this empty</label>
              <input type="text" id="contact-website" name="contact_website" tabindex="-1" autocomplete="off">
            </div>

            <?php wp_nonce_field('contact_form', '_wpnonce'); ?>
            <input type="hidden" name="contact_submit" value="1">

            <button type="submit" class="btn btn-accent">Book Appointment</button>
          </form>
        </div>

        <div class="contact-map-wrapper slide-in-right">
          <?php if ($address && $address_encoded) : ?>
            <div class="map-container">
              <iframe
                src="https://maps.google.com/maps?q=<?php echo esc_attr($address_encoded); ?>&output=embed&z=15"
                style="border:0; min-height: 400px; width: 100%;"
                allowfullscreen
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="Map showing <?php echo esc_attr($address); ?>"></iframe>
            </div>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
</section>
