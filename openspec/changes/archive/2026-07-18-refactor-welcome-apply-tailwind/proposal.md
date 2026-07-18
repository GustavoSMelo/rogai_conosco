## Why

The current `welcome.css` duplicates Tailwind design tokens as raw CSS values (colors, spacing, font sizes), creating a maintenance burden — any palette or spacing change in Tailwind config must be manually mirrored. Meanwhile, the Blade template still contains scattered Tailwind utility classes that should live in the CSS layer.

## What Changes

- Rewrite `resources/css/welcome.css` to use `@apply` directives with Tailwind utility classes instead of raw CSS values
- Move all remaining inline Tailwind classes from `resources/views/welcome.blade.php` into `welcome.css` classes using `@apply`
- Eliminate raw color, spacing, font-size, and other hardcoded values from `welcome.css` so it stays in sync with Tailwind's design tokens

## Capabilities

### New Capabilities
- `welcome-css-apply-refactor`: Refactors `welcome.css` to use Tailwind `@apply` for all styling, and moves all remaining inline Tailwind utilities from the Blade template into CSS classes

### Modified Capabilities
<!-- No existing specs are modified. -->

## Impact

- `resources/css/welcome.css` — completely rewritten: raw CSS replaced with `@apply` + Tailwind utilities
- `resources/views/welcome.blade.php` — remaining inline Tailwind classes (on nav items, hero, steps, modal, form fields, footer) replaced with CSS class references
