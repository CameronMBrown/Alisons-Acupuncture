# Analytics

GA4 + Search Console, both surfaced to Alison through one scheduled Looker
Studio email — she doesn't have (or need) logins to either platform.

## Legal posture: no cookie-consent banner

Site is a solo-practitioner clinic in Cobourg, ON (Canada — PIPEDA, not
GDPR/CCPA). No banner is used, on the basis that:

- GA4 is configured analytics-only: Google Signals off (property-level
  toggle) and `allow_google_signals: false` /
  `allow_ad_personalization_signals: false` set in the gtag config as a
  code-level backstop. No ad personalization, no cross-site/ad data sharing.
- PIPEDA doesn't mandate an EU-style consent banner for this posture — a
  plain-language privacy-policy disclosure is the applicable bar, not
  opt-in-before-collection.
- `template-parts/privacy-policy.php` discloses GA4 use, links to Google's
  privacy policy, and explicitly states no ad personalization / no
  sharing/selling data.

Revisit this if the business ever meaningfully targets EU/UK visitors or
adds ad platforms (Google Ads, Meta Pixel, etc.) — the current setup
specifically assumes neither.

## GA4 property

- Measurement ID: `ALISONS_GA_MEASUREMENT_ID` constant, top of `functions.php`.
- Loader hooked to `wp_head`, skipped entirely for `is_user_logged_in()` so
  admin/editor/dev visits don't pollute the data.

## Custom event tracking

Source: `wp-content/themes/alisonsacupuncture/assets/js/analytics-tracking.js`
— one of the source files concatenated into `bundle.min.js` by
`scripts/build-js.mjs` (run `npm run build:js` after editing). A single
delegated `click` listener on `document` fires a `button_click` event with
`button_name` / `button_location` / `priority` params:

| Priority | button_name             | Trigger element                                          |
|----------|-------------------------|-----------------------------------------------------------|
| 1        | `book_now`              | `#patient-cal-book-now-button` (ClinicSense widget, injected into the DOM at runtime — not an iframe, confirmed via live DOM inspection) |
| 2        | `call_phone`            | `.nav-phone-link`, `.call-now-mobile` (header)             |
| 3        | `book_appointment_hero` | `.primary-cta` (hero section)                              |
| 4        | `locate_office`         | `.js-office-directions-trigger` (hours section, desktop + mobile) |
| low      | *(derived from link/button text)* | any other `button` / `a.btn` not matched above   |

Guard at top of the file: bails out entirely if `window.dataLayer`/`gtag`
aren't present, so a blocked/broken GA load can't throw JS errors elsewhere
on the page.

## Contact form conversion

No JS needed — the contact form already does a PRG redirect to `/thank-you/`
on success (see `docs/contact-form.md`). In GA4: **Admin → Events → Create
event** named `contact_form_success`, matching `event_name = page_view` AND
`page_location contains /thank-you/`, then marked as a **key event**.

## Page titles on custom routes (`/thank-you/`, `/privacy-policy/`)

These are synthetic routes (rewrite rules in `functions.php`, not real
WP posts — see `docs/contact-form.md`). Yoast owns the `<title>` tag on this
site and does **not** honor WP core's `pre_get_document_title` filter, so
title overrides for these routes must go through Yoast's own `wpseo_title`
filter instead (same pattern already used for the front-page title override
in `inc/seo.php`). Using the wrong hook here is what caused GA4 to log the
thank-you page title as the bare site name for a while — fixed in
`functions.php`, but worth remembering if a new custom route is ever added.

## Asset cache-busting (this bit us once — worth understanding)

`wp_enqueue_style`/`wp_enqueue_script` for the theme's CSS/JS bundle use
`filemtime()` for the version string, not a hardcoded one. Hostinger's CDN
(`hcdn`) caches static assets for `max-age=604800` (7 days) keyed on the
full URL including the `?ver=` query string — a hardcoded version means the
CDN has no reason to ever re-fetch an updated file after a deploy. Bundle
rebuilds (`npm run build:js`) now automatically change `?ver=` to the file's
new mtime, which busts the CDN cache key on every real change.

**Known gotcha**: CDN edge-cache purges don't always propagate to every
edge node instantly. After a deploy, different visitors (or you, testing
from a different network) can briefly see different cached versions of the
page/assets. If a change doesn't seem to be live, don't assume it's a code
bug before checking this — hard-refresh, try incognito, or purge cache
fully in Hostinger hPanel if it persists.

Deploy is automatic on push to `master` (`.github/workflows/deploy.yml` —
see `docs/deployment.md`); there is no manual deploy step to forget, but the
CDN caching layer above is independent of that pipeline.

## Search Console

Property registered for `alisonsacupuncture.com` (confirm domain-property
vs. URL-prefix matches what's connected in Looker Studio — mismatches here
are the most common reason the connector shows zero data). Reports through
the same Looker Studio dashboard as GA4, not GA4 itself.

## Looker Studio report + bi-weekly email

One report, two data sources (GA4 + Search Console), date range set to
**Last 14 days with previous-period comparison** so every card shows
current vs. prior period automatically.

**GA4 cards:**
- Homepage views (scorecard, filtered to `page_path = /` — the site
  otherwise doesn't care about pageviews on `/thank-you/` or
  `/privacy-policy/`)
- Button clicks by `button_name` (table, custom dimensions), manually
  ordered to match the priority table above rather than sorted by volume
- Contact form submissions (scorecard, the `contact_form_success` key event)
- Device category — mobile / desktop / tablet / other (bar or pie chart)
- Average session duration (scorecard)

**Search Console cards:**
- Clicks, Impressions, CTR, Average position (scorecards — note in the
  report itself that lower position = better, so it doesn't read backwards)
- Top 5 queries by clicks (table)

Search Console data lags GA4 by roughly 2-3 days — expected, not a bug, and
worth remembering if the two data sources ever look out of sync for the
same date range.

**Delivery**: Looker Studio's native **File → Schedule email delivery**,
every 14 days, to Alison's personal Gmail. Runs on Google's infrastructure —
no server, cron job, or credentials on our side to maintain. (Gmail's MCP
integration, if ever considered for this, only creates drafts — it can't
send — so it was ruled out in favor of this native path.)

## Custom dimensions required for the button-click table

GA4 → **Admin → Custom definitions → Create custom dimensions** — event-scoped,
one for `button_name`, one for `button_location`. These only start
populating from the moment they're registered forward, not retroactively.
