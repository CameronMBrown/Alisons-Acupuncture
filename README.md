# Alison's Acupuncture

Source code for [alisonsacupuncture.com](https://alisonsacupuncture.com), a WordPress site built on the [OceanWP](https://oceanwp.org/) theme with a custom child theme.

## What's in this repo

This repo tracks only the custom parts of the site — not WordPress itself:

- `wp-content/themes/alisonsacupuncture/` — the custom child theme (templates, styles, custom fields)
- `wp-content/plugins/` — the small set of plugins the site depends on
- `docs/` — project documentation (see below)

WordPress core, `wp-config.php`, uploaded media, and the OceanWP parent theme are **not** tracked here — they're either installed independently on each environment or deployed separately. See [`docs/deployment.md`](docs/deployment.md) for the full picture.

## Local development

This project is built with [LocalWP](https://localwp.com/). To work on it:

1. Open the site in LocalWP and start it.
2. Install dependencies:
   ```
   npm install
   ```
3. The theme's styles are written in Sass and compiled to CSS. After editing anything in `wp-content/themes/alisonsacupuncture/assets/scss/`, rebuild the compiled CSS:
   ```
   npm run build:css
   ```
   Or, to rebuild automatically while you work:
   ```
   npm run watch:css
   ```

The compiled `custom.css` is committed to the repo (it isn't built during deployment), so always run `build:css` before committing style changes.

## Design system

Colors, type, spacing, motion, and voice/brand guidelines for the site live in [`docs/design-system/`](docs/design-system/README.md). Check there before introducing new styles.

## Deployment

Pushes to `master` deploy automatically to production via GitHub Actions. Full details — what deploys, what doesn't, and how SSH access is set up — are in [`docs/deployment.md`](docs/deployment.md).

## Tech stack

- WordPress + OceanWP (parent theme)
- Custom child theme, built with Advanced Custom Fields
- Sass for styling
- Plugins: Advanced Custom Fields, Classic Editor, Yoast SEO
- Hosted on Hostinger, deployed via GitHub Actions
