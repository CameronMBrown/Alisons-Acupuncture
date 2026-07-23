<?php

/**
 * Privacy Policy Page
 */

get_header();

$trees       = wp_get_attachment_image_src(142, 'full');
$logo        = wp_get_attachment_image_src(137, 'full');
$homepage_id = (int) get_option('page_on_front');
$email       = $homepage_id ? get_field('email', $homepage_id) : '';
$phone       = $homepage_id ? get_field('phone_number', $homepage_id) : '';

if (empty($email)) {
  $email = 'info@alisonsacupuncture.com';
}
?>

<main id="main" class="site-main">
  <section class="hero-section legal-hero-section">
    <div class="trees-background-container">
      <div class="trees-background trees-1">
        <img src="<?php echo esc_url($trees[0]); ?>" width="<?php echo esc_attr($trees[1]); ?>" height="<?php echo esc_attr($trees[2]); ?>" alt="" loading="eager">
      </div>
      <div class="trees-background trees-2">
        <img src="<?php echo esc_url($trees[0]); ?>" width="<?php echo esc_attr($trees[1]); ?>" height="<?php echo esc_attr($trees[2]); ?>" alt="" loading="eager">
      </div>
      <div class="trees-background trees-3">
        <img src="<?php echo esc_url($trees[0]); ?>" width="<?php echo esc_attr($trees[1]); ?>" height="<?php echo esc_attr($trees[2]); ?>" alt="" loading="eager">
      </div>
      <div class="trees-background trees-4">
        <img src="<?php echo esc_url($trees[0]); ?>" width="<?php echo esc_attr($trees[1]); ?>" height="<?php echo esc_attr($trees[2]); ?>" alt="" loading="eager">
      </div>
    </div>

    <?php if ($logo) : ?>
      <div class="error-404-logo-bg">
        <img src="<?php echo esc_url($logo[0]); ?>" width="<?php echo esc_attr($logo[1]); ?>" height="<?php echo esc_attr($logo[2]); ?>" alt="" aria-hidden="true">
      </div>
    <?php endif; ?>

    <div class="hero-content">
      <div class="cntr">
        <div class="legal-hero-content">
          <h1 class="hero-title text-3d-shadow slide-in-bottom">Privacy Policy</h1>
          <p class="hero-subtitle slide-in-bottom delay-short">
            How I handle the information you share with me through this site.
          </p>
        </div>
      </div>
    </div>
  </section>

  <section class="legal-section">
    <div class="cntr">
      <div class="legal-content">
        <p class="legal-updated">Last updated: July 2026</p>

        <p>
          I'm Alison, and I run this practice on my own, so this policy is written from that
          perspective rather than a corporate one. It covers the personal information collected
          through alisonsacupuncture.com, mainly through the contact form.
        </p>

        <h2>What I collect</h2>
        <p>
          When you use the contact form, I collect your name, email address, phone number (if you
          provide one), and whatever you write in the message field.
        </p>
        <p>
          This site also uses Google Analytics to see basic traffic patterns, like how many people
          visit and which pages they look at. IP addresses are anonymized, and I've turned off
          Google Signals and ad personalization, so this data isn't used for advertising, isn't
          combined with other Google account data, and isn't sold or shared with advertisers. See
          <a href="https://policies.google.com/privacy" target="_blank" rel="noopener noreferrer">Google's privacy policy</a>
          for how they handle this data.
        </p>
        <p>
          If you book an appointment through the "Book an Appointment" widget on this site, that
          booking is handled directly by ClinicSense, a separate scheduling platform. Information
          you enter there goes straight to ClinicSense and is covered by
          <a href="https://www.clinicsense.com/privacy-policy" target="_blank" rel="noopener noreferrer">their privacy policy</a>,
          not this one.
        </p>

        <h2>How I use it</h2>
        <p>
          I use contact form submissions for one thing: replying to you. I do not add your email
          to a mailing list, send marketing or promotional emails, or share, sell, or rent your
          information to anyone else. If I ever want to send you something beyond a direct reply
          to your message, such as a newsletter, I'll ask first.
        </p>

        <h2>How it's stored</h2>
        <p>
          The contact form doesn't save your submission to a database on this site. It sends the
          contents directly to my email inbox, and from there it's kept only as long as I need it
          to respond to you or maintain a record of our correspondence.
        </p>

        <h2>A note on health details</h2>
        <p>
          Please don't include detailed medical history, diagnoses, or other sensitive health
          information in the contact form. It's meant for general inquiries, not clinical
          intake. If you need to share health details before your first visit, call or wait
          until we can talk directly.
        </p>

        <h2>Your options</h2>
        <p>
          You can ask me what information I have on file for you, or ask me to delete it, at any
          time. Reach out using the contact details below and I'll take care of it.
        </p>

        <h2>Questions</h2>
        <p>
          If anything here is unclear, contact me directly:<br>
          Email: <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
          <?php if ($phone) : ?>
            <br>Phone: <a href="tel:<?php echo esc_attr(preg_replace('/(?!^\+)[^\d]/', '', trim($phone))); ?>"><?php echo esc_html($phone); ?></a>
          <?php endif; ?>
        </p>

        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn">Return to Homepage</a>
      </div>
    </div>
  </section>
</main>

<?php
get_footer();
