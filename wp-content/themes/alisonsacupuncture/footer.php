<?php

/**
 * Footer Template for Alison's Acupuncture
 */

$homepage_id  = (int) get_option('page_on_front');
$facebook_url = $homepage_id ? get_field('facebook', $homepage_id) : '';
$instagram_url = $homepage_id ? get_field('instagram', $homepage_id) : '';

?>

</main><!-- #main -->

<footer class="site-footer">
  <div class="cntr">
    <div class="footer-top">
      <div class="footer-logo">
        <a href="<?php echo esc_url(home_url('/')); ?>">
          <?php echo wp_get_attachment_image(138, 'full', false, [
            'class'   => 'footer-logo-img',
            'alt'     => 'Alison\'s Acupuncture',
            'loading' => 'lazy',
          ]); ?>
        </a>
      </div>

      <?php if ($facebook_url || $instagram_url) : ?>
        <div class="footer-socials">
          <?php if ($facebook_url) : ?>
            <a href="<?php echo esc_url($facebook_url); ?>" class="footer-social-link" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
              <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18 2H15C13.6739 2 12.4021 2.52678 11.4645 3.46447C10.5268 4.40215 10 5.67392 10 7V10H7V14H10V22H14V14H17L18 10H14V7C14 6.73478 14.1054 6.48043 14.2929 6.29289C14.4804 6.10536 14.7348 6 15 6H18V2Z" fill="currentColor" />
              </svg>
            </a>
          <?php endif; ?>
          <?php if ($instagram_url) : ?>
            <a href="<?php echo esc_url($instagram_url); ?>" class="footer-social-link" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
              <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7.8 2H16.2C19.4 2 22 4.6 22 7.8V16.2C22 19.4 19.4 22 16.2 22H7.8C4.6 22 2 19.4 2 16.2V7.8C2 4.6 4.6 2 7.8 2ZM7.6 4C5.61178 4 4 5.61178 4 7.6V16.4C4 18.3882 5.61178 20 7.6 20H16.4C18.3882 20 20 18.3882 20 16.4V7.6C20 5.61178 18.3882 4 16.4 4H7.6ZM17.25 5.5C17.6642 5.5 18 5.83579 18 6.25C18 6.66421 17.6642 7 17.25 7C16.8358 7 16.5 6.66421 16.5 6.25C16.5 5.83579 16.8358 5.5 17.25 5.5ZM12 7C14.76 7 17 9.24 17 12C17 14.76 14.76 17 12 17C9.24 17 7 14.76 7 12C7 9.24 9.24 7 12 7ZM12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9Z" fill="currentColor" />
              </svg>
            </a>
          <?php endif; ?>
        </div>
      <?php endif; ?>
    </div>

    <hr class="footer-divider">

    <div class="footer-bottom">
      <p class="footer-copyright">&copy; <?php echo date('Y'); ?> Alison's Acupuncture</p>
      <p class="footer-credit">
        Site by Brown Hat Digital
        <a href="https://github.com/CameronMBrown" target="_blank" rel="noopener noreferrer" aria-label="GitHub">
          <svg viewBox="0 0 16 16" width="14" height="14" fill="currentColor">
            <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z" />
          </svg>
        </a>
        <a href="https://www.linkedin.com/in/cameronmagyarbrown/" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
          <svg viewBox="0 0 16 16" width="14" height="14" fill="currentColor">
            <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 01.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z" />
          </svg>
        </a>
      </p>
    </div>

  </div>
</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>