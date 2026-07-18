# Rogai Conosco — Design System

## Theme

Light. Pure white background with olive forwardness, natural olive undertones, a warm peach-terracotta accent. The surface is a clean, sunlit room — serene, open, unhurried.

## Color Palette

All values in OKLCH.

```css
:root {
  --color-bg: oklch(0.94 0.018 100);
  --color-surface: oklch(0.92 0.015 100);
  --color-ink: oklch(0.1 0.008 115);
  --color-muted: oklch(0.45 0.006 115);

  --color-primary: oklch(0.55 0.10 115);
  --color-primary-light: oklch(0.90 0.03 115);

  --color-accent: oklch(0.40 0.12 28);
  --color-accent-light: oklch(0.88 0.02 28);
}
```

| Role | Value | Usage |
|------|-------|-------|
| bg | `#f0f0d8` | Soft warm off-white. Easy on the eyes, still reads as bright. |
| surface | `oklch(0.985 0.003 105)` | Cards, panels, section alt backgrounds. Barely tinted. |
| ink | `oklch(0.1 0.008 115)` | Body text — near-black with olive warmth. ≥7:1 vs bg. |
| muted | `oklch(0.38 0.008 115)` | Secondary text, captions, metadata. ≥4.5:1 vs bg and surface. |
| primary | `oklch(0.55 0.10 115)` | Muted olive. Decorative elements, borders, ambient tint. |
| primary-light | `oklch(0.90 0.03 115)` | Olive-tinted section backgrounds, subtle fills. |
| accent | `oklch(0.40 0.12 28)` | Deep terracotta. CTAs, interactive elements, emphasis. |
| accent-light | `oklch(0.88 0.02 28)` | Peach-tinted surfaces for highlighted sections. |

**Color strategy:** Committed. Olive and terracotta carry 30–60% of the surface area. Brand surfaces use decisive color blocks to communicate warmth and conviction. The hero uses a full-bleed photograph with color overlay; section backgrounds alternate olive tints and surface tones. Ample whitespace balances the committed palette.

## Typography

| Role | Font | Weight | Size clamp |
|------|------|--------|------------|
| Display / Hero | Source Serif 4 | 400 (regular) | `clamp(2.25rem, 4vw, 4rem)` |
| Heading 1 | Source Serif 4 | 400 | `clamp(1.75rem, 3vw, 2.75rem)` |
| Heading 2 | Source Serif 4 | 400 | `clamp(1.35rem, 2.25vw, 2rem)` |
| Heading 3 | Figtree | 500 | `clamp(1.1rem, 1.75vw, 1.4rem)` |
| Body | Figtree | 400 | `1rem` / `1.125rem` (large) |
| Small / Caption | Figtree | 400 | `0.875rem` |

**Line-height:** Body `1.6`, headings `1.2–1.3`.  
**Max body width:** 70ch.  
**Text wrapping:** `text-wrap: balance` on h1–h3; `text-wrap: pretty` on body prose.  
**Letter-spacing:** Display/hero `-0.02em`; all else normal (0).

Source Serif 4 provides the reverent, grounded warmth the brand needs — it's a serif that reads as crafted, not academic. Figtree (already in the project) is the clean, approachable sans for body copy and UI.

## Spacing & Layout

Scale based on `0.25rem` increments, with deliberate variation for rhythm:

```
xs:  0.25rem   (4px)
sm:  0.5rem    (8px)
md:  1rem      (16px)
lg:  1.5rem    (24px)
xl:  2.5rem    (40px)
2xl: 4rem      (64px)
3xl: 6rem      (96px)
```

Section padding: `4rem 1.5rem` mobile → `6rem 2rem` desktop.

Cards inset: `1.5rem`.

## Motion

Peaceful and unhurried. Animations serve calm, never attention.

- **Duration:** `300ms` for micro-interactions, `500ms` for section reveals, `800ms` for hero entrance.
- **Easing:** `cubic-bezier(0.25, 0.1, 0.25, 1)` — gentle ease-out-quart variant. No bounce, no elastic.
- **Allowed properties:** opacity, transform (translate, scale), filter. Never layout properties.
- **Reveal style:** Gentle fade-up with `translateY(12px) → translateY(0)` + opacity. Stagger sibling children by `80ms`.
- **Hover/Focus:** Subtle lift (`translateY(-2px)`) with accompanying shadow deepening. `150ms`.
- **Reduced motion:** `@media (prefers-reduced-motion: reduce)` — reduce all animations to instant (`0ms`) or crossfade only. No transform reveals.

## Components (planned)

- **Introduction name** When user enters in landing page, should first load the app name in the middle of screen, after this, a animation will fadeout the app name and appears the landing page itself
- **Header/Site nav:** Minimal. The site name, a link to "Request prayer," and a "About" link. No mega-menus. the menu should be in right side and cover the entire right side, with option to collide it
- **Hero section:** Short, centered. Tagline + primary CTA. No stock photos. Maybe just text on a light olive-tinted background.
- **Prayer request form:** The core surface. A single-page form with: name optional, prayer text, delivery preference (recorded / instant / AI). Simple, no anxiety-inducing progress bars.
- **Footer:** Minimal. Mission statement, donation link, social/contact.
- **Buttons:**
  - Primary CTA: Outlined with accent color. `1px` solid `--color-accent`, accent text, no fill until hover (subtle accent-light fill).
  - Secondary: Link-style, muted text.
  - Tertiary: Underlined text link.

## z-index Scale

```
dropdown:    100
sticky:      200
modal-backdrop: 300
modal:       400
toast:       500
tooltip:     600
```
