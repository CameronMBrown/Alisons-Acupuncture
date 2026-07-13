# Alison's Acupuncture — Design System

The living reference for how this site looks and behaves. It exists so future
work stays consistent instead of re-inventing sizes, colours, and effects
per-section (which is how the theme drifted before this system).

## Read these

| Doc | What it covers |
|-----|----------------|
| [brand-and-voice.md](./brand-and-voice.md) | Who we're designing for and the feeling to protect: professional, humble, trustworthy, legible. |
| [color.md](./color.md) | The palette, token names, and **which combinations meet WCAG AA**. |
| [typography.md](./typography.md) | The Fraunces serif headings, the system-sans body, and the fluid `clamp()` type scale. |
| [spacing-radius-elevation.md](./spacing-radius-elevation.md) | Spacing, corner-radius, and shadow tokens. |
| [motion.md](./motion.md) | The animation catalogue, timing tokens, and the reduced-motion policy. |
| [accessibility.md](./accessibility.md) | The rules that keep the site usable for older / low-vision visitors. |

## How the tokens work

Design decisions live as tokens, not scattered magic numbers.

```
_variables.scss  ──►  SCSS $vars (e.g. $primary-color, $heading-font)
                 ──►  :root CSS custom properties (--fs-body, --space-4, --shadow-md …)
                 ──►  used in section/component SCSS as var(--token)
```

- **Colours** exist as both SCSS `$vars` (for use inside Sass) and `--custom-properties`.
- **Type / spacing / radius / shadow / motion** are CSS custom properties so they
  can be fluid (`clamp()`) and overridden in media queries.
- Prefer a token over a raw value. If you need something new, add a token.

## Build

Styles are authored in SCSS and compiled to one stylesheet. **Never edit
`assets/css/custom.css` by hand** — it is generated.

```bash
npm run build:css     # one-off compile
npm run watch:css     # recompile on save
```

Entry point: `assets/scss/custom.scss` (it `@use`s every partial). Compiled
output: `assets/css/custom.css`, enqueued in `functions.php`.

## File map (theme SCSS)

```
assets/scss/
  _variables.scss      all design tokens
  _fonts.scss          @font-face for Fraunces + metric-matched fallback
  _base.scss           element defaults (body size, heading font)
  _animations.scss     keyframes, mixins, scroll-reveal classes
  _accessibility.scss  prefers-reduced-motion overrides (loaded last)
  components/          buttons, navigation, blobs, glass-card (reusable surfaces)
  sections/           hero, hours, about, services, contact, footer, testimonials
```
