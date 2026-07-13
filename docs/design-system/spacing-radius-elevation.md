# Spacing, Radius & Elevation

Tokens for the "in-between" values so layout stays rhythmic and consistent.
All defined as CSS custom properties in `_variables.scss`.

## Spacing scale

A simple rem scale for padding, margins, and gaps.

| Token | Value | ≈ px |
|---|---|---|
| `--space-1` | 0.5rem | 8 |
| `--space-2` | 1rem | 16 |
| `--space-3` | 1.5rem | 24 |
| `--space-4` | 2rem | 32 |
| `--space-5` | 3rem | 48 |
| `--space-6` | 4rem | 64 |
| `--space-7` | 6rem | 96 |
| `--space-8` | 8rem | 128 |

Section vertical padding is typically `--space-6` (4rem) desktop, `--space-5`
(3rem) on mobile. Card/content padding is usually `--space-4` (2rem).

## Radius scale

| Token | Value | Use |
|---|---|---|
| `--radius-sm` | 4px | inputs, small chips, meta links |
| `--radius-md` | 8px | tables, form fields, status cards |
| `--radius-lg` | 12px | cards, images, map, booking widget |
| `--radius-xl` | 32px | large feature panels (ultrawide about) |
| `--radius-pill` | 999px | toggles, pills |

## Elevation (shadows)

Soft, low-contrast shadows — this brand is gentle, not dramatic.

| Token | Value | Use |
|---|---|---|
| `--shadow-sm` | `0 2px 4px rgba(0,0,0,.05)` | tables, subtle lift |
| `--shadow-md` | `0 4px 12px rgba(0,0,0,.08)` | cards, buttons at rest |
| `--shadow-lg` | `0 8px 24px rgba(0,0,0,.12)` | raised images, hovered cards |

## Note

These tokens are defined and documented as the standard. Existing section files
still contain some equivalent raw values (e.g. `border-radius: 12px`,
`0 4px 12px rgba(0,0,0,.08)`) predating the tokens — migrate them to the tokens
opportunistically when touching a file, so new work doesn't reintroduce
one-off numbers.
