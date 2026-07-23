<?php

/**
 * Front Page Contact Section
 *
 * Two toggleable panels:
 *   - "Book Appointment" → ClinicSense booking widget (default active)
 *   - "Contact"          → original message form (PRG + wp_mail)
 *
 * Note on the ClinicSense widget: a third-party script renders a "Book Now"
 * button and opens its booking flow in a modal served cross-origin from
 * clinicsense.com. That modal's internal appearance CANNOT be styled with our
 * CSS. The only theming available is the widget's own `color` URL param (kept
 * as `orange`, which matches the site accent --accent-color: #ff9d23). We style
 * the surrounding wrapper/card and toggle buttons with brand colours instead.
 */

$phone = get_field('phone_number');
$email = get_field('email');
$address = get_field('address');

// Contact section content (ACF, with fallbacks)
$contact_heading     = get_field('contact_heading') ?: 'Get in Touch';
$contact_tab_label   = get_field('contact_tab_label') ?: 'Contact';
$booking_tab_label   = get_field('booking_tab_label') ?: 'Book an Appointment';
$booking_description = get_field('booking_description') ?: 'Pick a time that works for you — booking here syncs directly with Alison\'s calendar.';

// Fallback if ACF email is empty
if (empty($email)) {
  $email = 'asacupuncture1979@gmail.com';
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

  $subject = "Website contact us form submission from: {$post_name} - {$post_email}";

  $body  = "New Website Contact Us Email\n";
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
    'Cc: cam.brown94@gmail.com',
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

// Which panel is active on load. Default to booking; switch to the contact
// form when a submission bounced back with a validation error.
$active_panel = $has_error ? 'contact' : 'booking';
?>

<section id="contact" class="contact-section">
  <svg class="blob-svg blob-svg--top-left" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
    <path d="M21 3v2c0 9.627-5.373 14-12 14H7.098c.212-3.012 1.15-4.835 3.598-7.001 1.204-1.065 1.102-1.68.509-1.327-4.084 2.43-6.112 5.714-6.202 10.958L5 22H3c0-1.363.116-2.6.346-3.732C3.116 16.974 3 15.218 3 13 3 7.477 7.477 3 13 3c2 0 4 1 8 0z" />
  </svg>
  <svg class="blob-svg blob-svg--bottom-right" viewBox="0 -32 576 576" xmlns="http://www.w3.org/2000/svg">
    <path d="M546.2 9.7c-5.6-12.5-21.6-13-28.3-1.2C486.9 62.4 431.4 96 368 96h-80C182 96 96 182 96 288c0 7 .8 13.7 1.5 20.5C161.3 262.8 253.4 224 384 224c8.8 0 16 7.2 16 16s-7.2 16-16 16C132.6 256 26 410.1 2.4 468c-6.6 16.3 1.2 34.9 17.5 41.6 16.4 6.8 35-1.1 41.8-17.3 1.5-3.6 20.9-47.9 71.9-90.6 32.4 43.9 94 85.8 174.9 77.2C465.5 467.5 576 326.7 576 154.3c0-50.2-10.8-102.2-29.8-144.6z" />
  </svg>
  <div class="cntr">
    <div class="contact-header slide-in-bottom">
      <h2 class="text-3d-shadow"><?php echo esc_html($contact_heading); ?></h2>
      <div class="contact-meta">
        <?php if ($phone && $phone_href) : ?>
          <a href="tel:<?php echo esc_attr($phone_href); ?>" class="contact-meta-item" aria-label="Call us at <?php echo esc_attr($phone); ?>">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="16" height="16" fill="currentColor">
              <path d="M17.22,20.16H7a2,2,0,0,1-1.87-2.71l1.93-5.14A2,2,0,0,1,8.92,11h6.37a2,2,0,0,1,1.88,1.3l1.92,5.14A2,2,0,0,1,17.22,20.16Z" />
              <circle cx="12.11" cy="15.59" r="2" />
              <path d="M2.08,5.73V8.11a2,2,0,0,0,2,2H5a2,2,0,0,0,2-2V6.84H7a25.64,25.64,0,0,1,10,0h0V8.11a2,2,0,0,0,2,2h.89a2,2,0,0,0,2-2V5.73a1,1,0,0,0-.81-1h0a46.18,46.18,0,0,0-18.22,0h0A1,1,0,0,0,2.08,5.73Z" />
            </svg>
            <?php echo esc_html($phone); ?>
          </a>
        <?php endif; ?>

        <?php if ($email) : ?>
          <a href="mailto:<?php echo esc_attr($email); ?>" class="contact-meta-item" aria-label="Email us at <?php echo esc_attr($email); ?>">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="16" height="16" fill="currentColor">
              <path d="M22 4H2v16h20V4zm-2 4l-8 5-8-5V6l8 5 8-5v2z" />
            </svg>
            <?php echo esc_html($email); ?>
          </a>
        <?php endif; ?>

        <?php if ($address) : ?>
          <a href="https://maps.google.com/maps?daddr=<?php echo esc_attr($address_encoded); ?>" target="_blank" rel="noopener noreferrer" class="contact-meta-item" aria-label="Get directions to <?php echo esc_attr($address); ?>">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="16" height="16" fill="currentColor">
              <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" />
            </svg>
            <?php echo esc_html($address); ?>
          </a>
        <?php endif; ?>
      </div>

      <?php if (! $has_success) : ?>
        <div class="contact-toggle" role="tablist" aria-label="Choose how to get in touch">
          <button
            type="button"
            class="contact-toggle-btn<?php echo $active_panel === 'booking' ? ' is-active' : ''; ?>"
            role="tab"
            id="contact-tab-booking"
            aria-controls="contact-panel-booking"
            aria-selected="<?php echo $active_panel === 'booking' ? 'true' : 'false'; ?>"
            data-panel="booking">
            <?php echo esc_html($booking_tab_label); ?>
          </button>
          <button
            type="button"
            class="contact-toggle-btn<?php echo $active_panel === 'contact' ? ' is-active' : ''; ?>"
            role="tab"
            id="contact-tab-contact"
            aria-controls="contact-panel-contact"
            aria-selected="<?php echo $active_panel === 'contact' ? 'true' : 'false'; ?>"
            data-panel="contact">
            <?php echo esc_html($contact_tab_label); ?>
          </button>
        </div>
      <?php endif; ?>
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
        <div class="contact-panels slide-in-left">
          <!-- Book Appointment panel (ClinicSense widget) -->
          <div
            class="contact-panel booking-widget-wrapper glass-card<?php echo $active_panel === 'booking' ? ' is-active' : ''; ?>"
            id="contact-panel-booking"
            role="tabpanel"
            aria-labelledby="contact-tab-booking"
            data-panel="booking">
            <?php if ($booking_description) : ?>
              <p class="booking-widget-intro"><?php echo esc_html($booking_description); ?></p>
            <?php endif; ?>
            <div class="booking-widget-buttons" id="book_now_buttons">
              <?php // ClinicSense booking widget. Loaded via a plain <script src> with a
              // hardcoded vendor URL — no unescape/eval, so there is no injectable
              // surface. The widget injects its "Book Now" button here and opens its
              // booking modal over the page.
              //
              // Tried lazy-loading this on scroll-into-view to keep its third-party
              // Stripe cookie off the initial pageload (see git history) — reverted.
              // The widget's bootstrap calls `document.write`, which browsers refuse
              // to run in a script inserted after the page has already loaded
              // ("Failed to execute 'write' on 'Document'"), so deferred injection
              // silently breaks the Book Now button. Loading it eagerly here is a
              // vendor constraint, not something fixable from this theme. 
              ?>
              <script src="https://alisonsacupunctureanddryneedling.clinicsense.com/book_widget/?size=small&amp;color=orange" type="text/javascript"></script>
            </div>
          </div>

          <!-- Contact panel (message form) -->
          <div
            class="contact-panel contact-form-wrapper<?php echo $active_panel === 'contact' ? ' is-active' : ''; ?>"
            id="contact-panel-contact"
            role="tabpanel"
            aria-labelledby="contact-tab-contact"
            data-panel="contact">
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

              <button type="submit" class="btn btn-accent">Send Message</button>

              <p class="contact-form-disclaimer">
                This form is for direct correspondence only. I'll use it to reply to your
                message, nothing else. No mailing lists, no marketing emails, no sharing your
                information with anyone else. See the
                <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>">privacy policy</a>
                for details. If you have sensitive health information to share, please call
                instead of putting it in the message box.
              </p>
            </form>
          </div>
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