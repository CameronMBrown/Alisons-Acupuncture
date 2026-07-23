# Contact Form

Source: `wp-content/themes/alisonsacupuncture/template-parts/front-page/contact.php`
(PRG pattern — form POSTs to itself, redirects to `/thank-you/` or back with
`?contact=error` on failure).

## Recipients

- **To**: ACF `email` field on the front page (post ID 9), currently
  `info@alisonsacupuncture.com`. Falls back to the same address in code if
  the ACF field is ever empty (`contact.php` and `privacy-policy.php` both
  have this fallback — keep them in sync if the business address changes).
- **Cc**: `cam.brown94@gmail.com` (developer, hardcoded in `contact.php`).

## Forwarding: info@ → Alison's personal inbox

Alison checks her personal Gmail (`asacupuncture1979@gmail.com`) more than
`info@`. Forwarding is configured in Hostinger hPanel → Emails →
`info@alisonsacupuncture.com` → Email Forwarding, targeting her personal
address, with "keep a copy in mailbox" left on as a backup.

This is a mailbox-level setting on Hostinger's side — **not tracked in this
repo or reachable via SSH/deploy**. If it ever needs to change, it's a manual
hPanel step.

## Mail sending / deliverability

`wp_mail()` sends through Hostinger's PHP `mail()` relay (`hsendmail`) — no
SMTP plugin. A Brevo-based SMTP relay was evaluated and abandoned in favor of
keeping everything on Hostinger's own business email; `wp-mail-smtp` was
installed then removed again when that plan changed.

Two things fixed real deliverability problems (test emails were landing in
spam before these):

1. **`wp_mail_from` / `wp_mail_from_name` filters** in `functions.php` force
   the From header to `info@alisonsacupuncture.com` / "Alison's Acupuncture"
   instead of WordPress's default fake `wordpress@alisonsacupuncture.com`.
   Removing this will likely bring spam-flagging back.
2. **Hostinger Business Email** provisioned for the domain, which auto-added
   proper mail DNS. Confirmed live:
   - MX → `mx1/mx2.hostinger.com`
   - SPF → `v=spf1 include:_spf.mail.hostinger.com ~all`
   - DMARC → `v=DMARC1; p=none`
   - **DKIM is not set up.** Not currently needed (three consecutive test
     sends landed in inbox, not spam, after the From-address fix), but worth
     enabling later via hPanel → Emails → DKIM for long-term sender
     reputation, especially if send volume grows.

### ⚠️ Business Email pricing

The Hostinger Business Email plan was provisioned **free for the first
year**. Pricing after year one is unclear/unconfirmed. If it lapses or
reverts to a paid tier that isn't renewed, `info@alisonsacupuncture.com`
stops working (and the deliverability fixes above may be affected, since
they depend on MX/SPF/DKIM tied to that mailbox). **Check renewal terms
before the free year is up.**

## Anti-spam

Honeypot field (`contact_website`, hidden, bots fill it → silent redirect)
plus a WP nonce (CSRF, not bot protection). No CAPTCHA. Deliberate choice for
a low-traffic clinic site — revisit (Cloudflare Turnstile is the lighter-
weight option) if spam volume actually becomes a problem.

## Related routes

`/thank-you/` and `/privacy-policy/` are custom rewrite rules (not real WP
pages) registered in `functions.php`. Both previously served a real 404 HTTP
status and "Page not found" `<title>` because WP's query system saw no
matched post — fixed by clearing `$wp_query->is_404` and filtering
`pre_get_document_title` in each route's `template_redirect` handler.
