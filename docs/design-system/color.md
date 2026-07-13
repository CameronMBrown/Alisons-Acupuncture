# Colour

Warm and earthy: forest green, soft brown, and sunny orange/yellow accents — a
palette that reads natural, calm, and trustworthy for a wellness practice.

## Palette

| Token (SCSS / CSS var) | Hex | Role |
|---|---|---|
| `$primary-color` / `--primary-color` | `#5b7e3c` | Forest green. Primary brand colour, headings, buttons, section backgrounds. |
| `$secondary-color` / `--secondary-color` | `#3d3224` | Deep brown. Secondary text, subheadings. |
| `$accent-color` / `--accent-color` | `#f8a946` | Warm amber/yellow. **Large fills / buttons only, with DARK text** — see warning below. |
| `$accent-strong` / `--accent-strong` | `#a85906` | Deep orange. Accent-coloured **text** on light backgrounds (AA-safe). |
| `$alternate-color` / `--alternate-color` | `#ffd65a` | Warm yellow. Highlights, large headings on the green section. |
| `$text-color` / `--text-color` | `#333` | Default body text. |
| `$text-light` / `--text-light` | `#f9f7f4` | Text on dark/green backgrounds. |
| `$light-bg` / `--light-bg` | `#f9f7f4` | Warm off-white page/section background. |
| `$border-color` / `--border-color` | `#e0ddd9` | Hairlines, dividers. |

## ⚠️ The accent-colour contrast rules

`$accent-color` (`#f8a946`) is a bright amber. Two rules keep it accessible:

1. **Never use it as a text/graphic colour on light or green** — it's only
   **1.83:1** on the off-white and **2.39:1** on the green, failing even the 3:1
   bar. For accent-**coloured text** on a light surface use `$accent-strong`
   (`#a85906`, 4.79:1). For an accent heading on the **green** section use
   `$alternate-color` yellow (`#ffd65a`, 3.34:1 — clears 3:1 large text).
2. **On an accent *fill* (buttons, toggles), use DARK text, not white.** White on
   `#f8a946` is only **1.95:1** (fails); `$secondary-color` brown gives **6.4:1**.
   This is why `.btn-accent`, the booking button, and the active contact toggle
   use dark-on-amber.

## Contrast reference (WCAG)

AA needs **4.5:1** for normal text, **3:1** for large text (≥24px, or ≥18.66px
bold) and UI/graphics.

| Foreground on background | Ratio | Verdict |
|---|---:|---|
| `#333` text on light `#f9f7f4` | 11.82:1 | ✅ AAA |
| Secondary brown on light | 11.69:1 | ✅ AAA |
| About copy `#444` on white | 9.74:1 | ✅ AAA |
| Primary green on white | 4.67:1 | ✅ AA (normal) |
| Primary green on light `#f9f7f4` | 4.37:1 | ✅ AA large / ⚠️ borderline normal |
| Text-light `#f9f7f4` on primary green | 4.37:1 | ✅ AA large / ⚠️ borderline normal |
| `accent-strong #a85906` on light | 4.79:1 | ✅ AA (normal) |
| Yellow `#ffd65a` on primary green | 3.34:1 | ✅ AA large only |
| **Secondary brown `#3d3224` on accent `#f8a946`** | **6.40:1** | ✅ AA — use for text on accent fills |
| **White on accent `#f8a946`** | **1.95:1** | ❌ don't put white on accent |
| **`accent #f8a946` on light** | **1.83:1** | ❌ text — fills only |
| **`accent #f8a946` on green** | **2.39:1** | ❌ text — fills only |

Rule of thumb: green-on-off-white and green-as-background-for-white both sit near
the 4.5 line — fine for headings/large UI, keep an eye on small green text on the
tinted background.
