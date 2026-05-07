<?php

/**
 * Child Theme Header Template for Alison's Acupuncture
 */
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
          <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/img/alisonsacupuncture-logo-sm.png'); ?>" alt="Alison's Acupuncture Logo">
        </a>
        <div class="nav-btns-wr">
          <input type="checkbox" id="menu-toggle" class="menu-toggle">
          <label for="menu-toggle" class="menu-toggle-label">☰</label>
          <ul class="menu">
            <li><a href="/#hero"><svg viewBox="0 0 24 24">
                  <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                  <polyline points="9,22 9,12 15,12 15,22" />
                </svg>Home</a></li>
            <li><a href="/#hours"><svg viewBox="0 0 192 192" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                  <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                  <g id="SVGRepo_iconCarrier">
                    <g transform="translate(16 16)">
                      <circle cx="80" cy="80" r="74" style="fill:none;stroke:currentColor;stroke-width:16;stroke-linejoin:round;stroke-opacity:1" />
                      <path d="M80 30v50l40 32" style="fill:none;stroke:currentColor;stroke-width:16;stroke-linecap:round;stroke-linejoin:round;stroke-opacity:1" />
                    </g>
                  </g>
                </svg>Hours</a></li>
            <li><a href="/#about"><svg viewBox="0 0 24 24">
                  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                  <circle cx="12" cy="7" r="4" />
                </svg>About</a></li>
            <li><a href="/#services"><svg viewBox="0 0 24 24">
                  <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" />
                </svg>Services</a></li>
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
                </svg>Contact</a></li>
          </ul>
        </div>
      </nav>
    </header>