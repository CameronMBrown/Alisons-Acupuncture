# Accessibility

**Many visitors are older or have reduced vision.** Accessibility is a design
requirement here, not a compliance checkbox. Target: **WCAG 2.1 AA**.

## Text size

- Body copy is fluid and **never below ~1.15rem (18px)**; it grows to ~1.4rem on
  large screens. Small/fine print floors at `--fs-small` (~1rem / 16px) — the old
  0.85rem footer text is gone. `--fs-xs` (16px flat) is the absolute floor of the
  whole scale, for compact secondary text (e.g. service-card back copy in a 3–4
  column grid) — nothing should go smaller than this. See
  [typography.md](./typography.md).
- Type **scales up** on large/ultrawide displays instead of staying fixed, so the
  site is comfortable on a big monitor, not just a laptop.
- Never disable zoom or set sizes that prevent the browser from scaling text.

## Contrast

- Follow the pairings in [color.md](./color.md). AA = **4.5:1** normal text,
  **3:1** large text / UI.
- **Bright accent orange (`#ff9d23`) is not a text colour on light backgrounds**
  (~1.9:1). Use `$accent-strong` (`#a85906`) for accent text; the brand yellow
  for accent headings on the green section.
- Long-form copy is regular weight and dark enough (`#333`/`#444`) for AAA on the
  page backgrounds.

## Focus

- Every interactive element must have a visible **`:focus-visible`** ring.
  Buttons use a 3px accent/secondary outline with 2px offset; nav and toggles
  follow suit. Don't remove focus outlines without replacing them.
- Card fronts/backs are reachable: the flip triggers on `:focus-within`, and both
  faces are in the DOM so assistive tech reads the description regardless of flip
  state.

## Motion

- All motion honours **`prefers-reduced-motion: reduce`** — see the policy in
  [motion.md](./motion.md). Opted-out users get a static, fully-functional page
  with content visible (never hidden behind a disabled animation).
- Nothing important is conveyed by motion alone.

## Touch & targets

- Interactive targets aim for **≥ 44×44px** (footer social links are 44px; nav
  items and buttons have generous padding). Keep new tap targets at this size.
- The mobile "Call Now" button and tel: links make the phone number one tap away.

## Content & semantics

- Use real heading levels (`h1` → `h2` → `h3`) in order; the serif is styling, not
  structure.
- Images need meaningful `alt` text (decorative accents/blobs are `aria-hidden`
  or purely CSS).
- Don't rely on colour alone to signal state (e.g. the "closed" hours row also has
  a distinct label, not just a tint).

## Quick self-check when changing UI

1. Is any new text ≥ 18px and using a `--fs-*` token?
2. Does every foreground/background pair meet AA (check [color.md](./color.md))?
3. Does every interactive element show a focus ring?
4. Is any new animation covered by the reduced-motion block (and JS guarded if
   JS-driven)?
5. Are new tap targets ≥ 44px?
