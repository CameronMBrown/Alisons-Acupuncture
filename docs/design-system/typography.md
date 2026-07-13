# Typography

Two typefaces, each doing one job:

- **Headings — Fraunces** (self-hosted serif). A soft, warm old-style serif that
  gives the site its humble, human, trustworthy character.
- **Body — sans-serif.** `$body-font` is a system stack (`-apple-system,
  BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif`).
  ⚠️ **In practice the OceanWP parent forces its own body font (Open Sans, a
  Google Font) onto `body` via Customizer CSS injected after ours**, so body copy
  currently renders in Open Sans, not the system stack. If we want the
  zero-request system stack (a perf win — see the fonts note below), body needs a
  higher-specificity override too (same tactic as the headings).

Headings apply `--heading-font` via **`.site h1 … .site h6`** in `_base.scss`.
The `.site` scope is deliberate: OceanWP's Customizer sets a heading font with an
unscoped `h1,h2,…` rule injected **inline in `<head>` after** our stylesheet, so
an unscoped rule of ours would lose on source order and headings would fall back
to Open Sans. `.site h2` (specificity 0,1,1) beats `h2` (0,0,1) regardless of
order. The hero title classes also set the family directly.

## Why a serif for headings only

Headings are a small amount of text but carry most of the brand voice, so one
typeface across two weights covers them. Body copy — the bulk of the glyphs —
stays on the system stack, so **we add warmth without adding a font-loading tax
to the reading experience.**

## The self-hosted font (performance)

Fraunces ships as **Latin-subset WOFF2, two static weights** (500, 600),
~18KB each (~36KB total), in `assets/fonts/`. Defined in `_fonts.scss`:

- **`font-display: swap`** — text paints immediately in the fallback serif and
  never blocks render (protects FCP/LCP).
- **Preloaded** — the 600 weight (used above the fold) has a
  `<link rel="preload" as="font" type="font/woff2" crossorigin>` in `header.php`.
- **Metric-matched fallback** — a companion `@font-face` ("Fraunces Fallback")
  re-shapes Georgia to Fraunces's metrics so the swap barely shifts layout
  (protects CLS). Values were computed from the shipped font:

  | Descriptor | Value | Source |
  |---|---|---|
  | `size-adjust` | 102.6% | Fraunces avg-advance ÷ Georgia avg-advance |
  | `ascent-override` | 95.3% | Fraunces typo ascent (1956/2000 em) ÷ size-adjust |
  | `descent-override` | 24.9% | Fraunces typo descent (510/2000 em) ÷ size-adjust |
  | `line-gap-override` | 0% | Fraunces line gap (0) |

  Full stack: `"Fraunces", "Fraunces Fallback", Georgia, "Times New Roman", serif`.

> Only weights **500 and 600** exist. Do **not** request 700/900 — the browser
> would synthesise a fake bold. To add a weight, drop the subset WOFF2 into
> `assets/fonts/` and add a matching `@font-face`.

To refresh a subset from Fontsource:
`https://cdn.jsdelivr.net/npm/@fontsource/fraunces@5/files/fraunces-latin-<weight>-normal.woff2`

## The fluid type scale

Sizes are **fluid** — `clamp(min, preferred + vw, max)` — so text **shrinks
gracefully on phones and grows on large/ultrawide screens** instead of sitting at
one fixed size. Mins are deliberately generous for an older / low-vision
audience. Defined as CSS custom properties in `_variables.scss`.

> **⚠️ 1rem = 10px on this site.** The OceanWP parent sets
> `html { font-size: 62.5% }`, so a rem is 10px, not the browser-default 16px.
> The `rem` values below are calibrated for that 10px root (that's why they look
> large). The **px targets are what actually render**; the `vw` term is
> root-independent so it carries the same px slope regardless. If OceanWP's 62.5%
> is ever removed, rescale these tokens (÷1.6).

| Token | clamp | ≈ range (px) | Use for |
|---|---|---|---|
| `--fs-xs` | `1.6rem` (flat) | 16 | floor of the scale — compact/secondary text in tight layouts |
| `--fs-small` | `clamp(1.6rem, 1.52rem + 0.25vw, 1.84rem)` | 16 → 18.4 | footer, notes, fine print (floor was 0.85rem) |
| `--fs-body` | `clamp(1.84rem, 1.68rem + 0.5vw, 2.24rem)` | 18.4 → 22.4 | default body copy |
| `--fs-lg` | `clamp(2.08rem, 1.84rem + 0.8vw, 2.72rem)` | 20.8 → 27.2 | lead paragraphs, emphasised body |
| `--fs-h3` | `clamp(2.56rem, 2.08rem + 1.5vw, 4.16rem)` | 25.6 → 41.6 | sub-section headings, hero accent |
| `--fs-h2` | `clamp(3.84rem, 2.88rem + 3vw, 5.6rem)` | 38.4 → 56 | section headings (was fixed 4rem) |
| `--fs-display` | `clamp(4.16rem, 2.4rem + 5vw, 8rem)` | 41.6 → 80 | hero title / large display |

### The hero uses the shared tokens

The hero is fluid via the same scale — no bespoke per-breakpoint font sizes:

- `.hero-title` → `--fs-display` (up to 80px)
- `.hero-greeting` → `calc(var(--fs-display) * 1.5)` so the oversized "Hey"
  always tracks the title (up to 120px)
- `.hero-title--accent` → `--fs-h3`
- `.hero-subtitle` → `--fs-lg`

Hero breakpoints now only adjust layout (the greeting's overlap margin, mobile
centring). The serif applies and weight is capped at 600.

### Service-card sizing

Cards get narrow as columns increase, so the title is capped **below** the fluid
`--fs-h3`: `.service-card-front h3` uses `--fs-h3` on mobile but drops to
`--fs-lg` at `≥ $bp-desktop`.

The flip-back copy (`.service-card-back p`) is sized to match the card's column
count — same breakpoints as `.service-card`'s width rules, so the two stay in
lockstep:

| Columns | Viewport | Token | Size |
|---|---|---|---|
| 1 (mobile) | `< $bp-medium` (768px) | `--fs-body` | 18.4 → 22.4px |
| 2 (tablet) | `$bp-medium`–`$bp-desktop` (768–992px) | `--fs-small` | 16 → 18.4px |
| 3–4 (desktop, ultrawide) | `≥ $bp-desktop` (992px+) | `--fs-xs` | 16px flat |

`--fs-xs` is deliberately **flat, not fluid** — it sits right at the
accessibility floor so it reads as clearly smaller than `--fs-small` across the
whole desktop/ultrawide range, rather than converging with it at some widths (an
early fluid version did converge, which is why it's flat).

## Rules (never cross these)

- **Minimum body text ≈ 1.15rem (18px).** Never set body copy below `--fs-small`.
- **Long-form copy: regular weight, line-height ≥ 1.6.** Bold long paragraphs are
  harder to read for low vision — the About copy was moved from 700 → 400.
- **Serif = headings only.** Never set paragraphs in Fraunces.
- Don't hard-code `font-size` in px/rem in section files — use a `--fs-*` token.
