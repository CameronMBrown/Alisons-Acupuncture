# Motion

Motion here is **decorative and subtle** — it adds life without demanding
attention or blocking reading. Every animation is optional: users who ask their
OS to reduce motion get a calm, static page (see the policy below).

## Timing tokens

Defined in `_variables.scss`; reuse them instead of ad-hoc durations.

| Token | Value | Use |
|---|---|---|
| `--dur-fast` | 0.2s | hovers, small state changes |
| `--dur-base` | 0.3s | buttons, toggles |
| `--dur-slow` | 0.6s | card flip, larger transitions |
| `--ease` | `ease` | default easing |

Scroll-reveal timing lives in `_animations.scss` (`$animation-duration: 0.7s`,
`ease-out`).

## Catalogue

| Effect | Where | How | File |
|---|---|---|---|
| **Scroll reveal** | most sections | elements start at `opacity:0`; an `IntersectionObserver` adds `.is-visible` to fade/slide them in. Delay utilities `.delay-short/regular/long` stagger groups. | `_animations.scss`, `animations.js` |
| **Staggered cards** | services | row-aware `animation-delay` per column (0/200/400/600ms) | `sections/services/_services.scss` |
| **Card flip** | services | 3-D `rotateY(180deg)` on hover/focus reveals the description | `sections/services/_services.scss` |
| **Hero accents** | hero | squares slowly rotate (`rotate360`, 16–30s) and bob (`bobbing`) | `sections/hero/_hero-accents.scss` |
| **Blob drift** | hours bg | soft SVG blobs drift on a loop | `components/_blobs.scss` |
| **Tree parallax** | hero | 4 tree layers translate horizontally on scroll (JS) | `hero-parallax.js` |
| **About parallax** | about | background image translates vertically on scroll (JS) | `about-parallax.js` |
| **Hover lift** | buttons, nav, meta | `translateY(-3px)` + shadow/brightness | components + sections |

## Performance rules

- **Animate only `transform` and `opacity`.** They're GPU-composited and don't
  trigger layout/paint. Avoid animating width/height/top/left/box-shadow.
- Parallax scroll handlers are throttled with `requestAnimationFrame` + a
  `ticking` flag — keep that pattern for any new scroll effect.
- Prefer `transform`/`background`/`box-shadow` transitions over `filter:
  brightness()`/`drop-shadow()` on hover where practical (filters are
  repaint-heavy). Some hovers still use filters; migrate opportunistically.
- Keep the self-hosted font budget tiny (see [typography.md](./typography.md)).

## Reduced-motion policy (required)

`_accessibility.scss` (loaded **last**) contains one
`@media (prefers-reduced-motion: reduce)` block. When a visitor has enabled
"reduce motion" at the OS level:

- **Scroll-reveal content is forced visible** (`opacity:1; transform:none;
  animation:none`). This is critical — those elements start invisible, so
  disabling the animation *without* revealing them would leave blank space.
- **Infinite decorative loops stop** — hero rotating/bobbing accents and drifting
  blobs render in a resting position.
- **The card flip is disabled** (transition removed).
- **Smooth scrolling becomes instant** (`scroll-behavior: auto`).
- A belt-and-braces `*` rule collapses any remaining animation to ~0ms.

**JS-driven motion can't be stopped by CSS**, so the two parallax scripts
(`hero-parallax.js`, `about-parallax.js`) each early-return when
`matchMedia('(prefers-reduced-motion: reduce)').matches`.

The default (motion-on) experience is untouched — this only calms things for
users who opted out. **Any new animation must be covered by this policy.**
