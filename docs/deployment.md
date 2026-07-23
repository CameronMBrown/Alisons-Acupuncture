# Deployment

Production host: Hostinger. Live site: https://alisonsacupuncture.com

## What git manages

This repo only tracks `wp-content/themes/alisonsacupuncture` (our theme),
`wp-content/plugins/*` (excluding `query-monitor`, which is dev-only), and
general project files. It does **not** track:

- WordPress core (`wp-admin`, `wp-includes`, `wp-*.php`) — installed directly
  on each environment.
- `wp-config.php` — environment-specific secrets, never committed.
- `wp-content/uploads/` — media library, managed per-environment via WP admin.
- `wp-content/themes/oceanwp` — the parent theme our theme is a child of.
  Not tracked in git, but **is** deployed by CI (see below). If oceanwp ever
  needs updating, do it directly on production (and locally) rather than
  through this repo.

## Auto-deploy (`.github/workflows/deploy.yml`)

Every push to `master` triggers a GitHub Action that rsyncs these paths over
SSH to production, each scoped independently with `rsync --delete` so a
deletion only prunes within that specific folder (never touches sibling
plugins/themes that aren't ours, e.g. Hostinger's bundled plugins):

- `wp-content/themes/alisonsacupuncture/`
- `wp-content/themes/oceanwp/`
- `wp-content/plugins/advanced-custom-fields/`
- `wp-content/plugins/classic-editor/`
- `wp-content/plugins/wordpress-seo/`

**Adding a new plugin?** Add it to the `for plugin in ...` list in
`deploy.yml`, or it won't deploy.

**Uploads are never touched by CI** — media is uploaded once manually and
from then on managed independently on each environment via wp-admin.

### SSH access

Two separate SSH keys are used, both registered in Hostinger's
hPanel → Advanced → SSH Access → Manage SSH Keys:

- `~/.ssh/id_ed25519_hostinger` — personal key, for manual/interactive SSH
  access (`ssh hostinger-alisons`, config alias in `~/.ssh/config`).
- `~/.ssh/id_ed25519_deploy_alisons` — dedicated CI key, no passphrase.
  Private key is stored as the `HOSTINGER_SSH_KEY` GitHub Actions secret.
  Kept separate from the personal key so it can be rotated/revoked
  independently without affecting manual access.

GitHub Actions secrets (repo Settings → Secrets and variables → Actions):
`HOSTINGER_HOST`, `HOSTINGER_PORT`, `HOSTINGER_USER`, `HOSTINGER_SSH_KEY`.

Production path: `domains/alisonsacupuncture.com/public_html/`

## What's manual (not automated)

These were one-time steps during initial launch and aren't part of the
ongoing deploy pipeline:

- **Database**: exported from LocalWP, imported via phpMyAdmin on production.
  Table prefix on both sides is `wp_`. Future schema/content changes made
  directly in wp-admin on production are the source of truth — this repo
  does not sync the database.
- **URL migration**: after DB import, `siteurl`/`home` in `wp_options` were
  updated directly via SQL (safe — plain strings, not serialized), then the
  **Better Search Replace** plugin was run across all tables to catch
  serialized references (theme mods, postmeta, etc.) to the old local URL.
- **Media uploads**: synced once via `rsync` over SSH from local
  `wp-content/uploads/`. Not repeated by CI — new uploads happen directly on
  production via wp-admin.

## Local environment

LocalWP, table prefix `wp_`. Build theme CSS with `npm run build:css` before
committing style changes — compiled `custom.css` is committed directly (not
built in CI).
