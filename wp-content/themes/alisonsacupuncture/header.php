<?php

/**
 * Child Theme Header Template for Alison's Acupuncture
 */

$phone_number = get_field('phone_number');

do_action('qm/debug',  $phone_number); // Debugging line to check the phone number field value
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/img/alisonsacupuncture-logo-sm.png'); ?>" type="image">
  <title>Alison's Acupuncture</title>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <div id="page" class="site">

    <header id="masthead" class="site-header" role="banner">
      <nav id="site-navigation" class="main-navigation" role="navigation">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
          <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/img/alisonsacupuncture-logo-sm-colour.png'); ?>" alt="Alison's Acupuncture Logo">
        </a>
        <div class="nav-btns-wr">
          <input type="checkbox" id="menu-toggle" class="menu-toggle">
          <label for="menu-toggle" class="menu-toggle-label">☰</label>
          <ul class="menu">
            <li><a href="/#hero">
                <svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M1.7 6.2V14.3H6.2V10.7C6.2 9.70588 7.00588 8.9 8 8.9C8.99412 8.9 9.8 9.70588 9.8 10.7V14.3H14.3V6.2L8 0.8L1.7 6.2Z" fill="currentColor" />
                </svg>
                <p class="nav-label">Home</p>
              </a></li>
            <li><a href="/#hours"><svg viewBox="0 0 192 192" xmlns="http://www.w3.org/2000/svg">
                  <defs>
                    <mask id="clock-cutout" maskUnits="userSpaceOnUse">
                      <!-- White = visible -->
                      <rect width="192" height="192" fill="white" />

                      <!-- Black = cut out -->
                      <path
                        d="M96 46V96L136 128"
                        fill="none"
                        stroke="black"
                        stroke-width="16"
                        stroke-linecap="round"
                        stroke-linejoin="round" />
                    </mask>
                  </defs>

                  <circle
                    cx="96"
                    cy="96"
                    r="74"
                    fill="currentColor"
                    mask="url(#clock-cutout)" />
                </svg>
                <p class="nav-label">Hours</p>
              </a></li>
            <li><a href="/#about"><svg viewBox="0 0 24 24">
                  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                  <circle cx="12" cy="7" r="4" />
                </svg>
                <p class="nav-label">About</p>
              </a></li>
            <li><a href="/#services"><svg viewBox="0 0 24 24">
                  <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" />
                </svg>
                <p class="nav-label">Services</p>
              </a></li>
            <li><a href="/#contact"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none">
                  <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                  <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                  <g id="SVGRepo_iconCarrier">
                    <g id="ic-contact-phone-2">
                      <path class="cls-1" d="M17.22,20.16H7a2,2,0,0,1-1.87-2.71l1.93-5.14A2,2,0,0,1,8.92,11h6.37a2,2,0,0,1,1.88,1.3l1.92,5.14A2,2,0,0,1,17.22,20.16Z" />
                      <circle class="cls-2" cx="12.11" cy="15.59" r="2" />
                      <path class="cls-1" d="M2.08,5.73V8.11a2,2,0,0,0,2,2H5a2,2,0,0,0,2-2V6.84H7a25.64,25.64,0,0,1,10,0h0V8.11a2,2,0,0,0,2,2h.89a2,2,0,0,0,2-2V5.73a1,1,0,0,0-.81-1h0a46.18,46.18,0,0,0-18.22,0h0A1,1,0,0,0,2.08,5.73Z" />
                    </g>
                  </g>
                </svg>
                <p class="nav-label">Contact</p>
              </a>
              <?php if ($phone_number) : ?>
                <a href="tel:<?php echo esc_attr($phone_number); ?>" class="nav-phone-link">
                  <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2 3C2 2.44772 2.44772 2 3 2H6C6.55228 2 7 2.44772 7 3V5C7 5.55228 6.55228 6 6 6H4C4.55228 6 4 6.44772 4 7V9C4 9.55228 3.55228 10 3 10H2C1.44772 10 1 9.55228 1 9V3Z" fill="currentColor" />
                    <path d="M10.7071 3.70711C11.0976 3.31658 11.7308 3.31658 12.1213 3.70711L15.1213 6.70711C15.5118 7.09763 15.5118 7.73085 15.1213 8.12138L14.4142 8.82845C14.0237 9.21897 13.3905 9.21897 13 -8e-07L10.7071 -0.707107C10.3166 -1.09763 9.68342 -1.09763 9.29289 -0.707107L8.58579 -0.00000000000000012246467991473532C8.19526 -0.609523 -0 -1e-06 -0 -1e-06L10.7071 -0.707107Z" fill="currentColor" />
                    <path d="M17.7071 -0.292893C18.0976 -0.6834170000000001 18.7308 -0.6834170000000001 19.1213 -0.292893L22.1213 -0.292893C22.5118 -0.9024169999999999 22.5118 -0.2692049999999999 22.1213 0.12132L21.4142 0.828384C21.0237 1.21891 20.3905 1.21891 20 -1e-06L17.7071 -0.707107C17.3166 -1.09763 16.6834 -1.09763 16.2929 -0.707107L15.5858 -0.00000000000000012246467991473532C15.1953 -0.609523 -0 -1e-06 -0 -1e-06L17.7071 -0.292893Z" fill="currentColor" />
                  </svg>
                </a>
              <?php endif; ?>
            </li>
          </ul>
        </div>
      </nav>
    </header>