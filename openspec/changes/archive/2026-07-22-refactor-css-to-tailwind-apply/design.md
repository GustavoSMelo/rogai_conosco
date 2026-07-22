## Context

The `welcome.css` file consistently uses Tailwind's `@apply` directive with utility classes (e.g., `@apply font-serif text-lg text-brand-ink`). However, `app.css` and `result.css` use raw CSS values like `background-color: #f0f0d8`, `padding: 2rem`, `color: #1c1c14`, etc. This means theme changes in `tailwind.config.js` (e.g., brand color updates) don't automatically propagate to these files — each value must be manually found and replaced.

## Goals / Non-Goals

**Goals:**
- Convert all raw CSS values in `app.css` to `@apply` directives where Tailwind utilities exist
- Convert all raw CSS values in `result.css` to `@apply` directives where Tailwind utilities exist
- Preserve CSS that has no Tailwind equivalent (e.g., `@keyframes`, `clamp()`, `rgba()` overlays, custom pseudo-elements)
- Zero visual or behavioral changes
- All tests continue to pass

**Non-Goals:**
- Adding new CSS classes or modifying any Blade templates
- Changing the animation keyframes or timing functions
- Refactoring `welcome.css` (already uses `@apply`)
- Changing the Vite configuration or build process

## Decisions

- **`@apply` inside `@layer` blocks**: Use `@apply` within `@layer base`, `@layer components`, and `@layer utilities` to match the existing Tailwind convention. Selectors that define base styles (body, html) go in `@layer base`. Component-like selectors (`.splash-*`, `.modal-content`, `.result-*`) go in `@layer components`.
- **Hardcoded values without Tailwind equivalents**: Values like `clamp()`, `rgba()` with multi-stop gradients, and `animation` properties will remain as raw CSS since Tailwind doesn't provide utilities for them.
- **`@keyframes` stay raw**: Animation keyframes are pure CSS and cannot use `@apply`. They remain unchanged.
- **`@media (prefers-reduced-motion: reduce)` stays raw**: Media query blocks are preserved as-is since `@apply` only works for property declarations, not at-rules.
- **One CSS file at a time**: Refactor `app.css` first (larger file, more complex selectors), then `result.css` (smaller, simpler). This makes review and debugging easier.

## Risks / Trade-offs

- **[Visual regression]** Any `@apply` conversion that doesn't produce an identical visual result. Mitigation: run `php artisan test` after each file; visually compare before/after build output.
- **[Missing utility]** Some raw values may not map cleanly to existing Tailwind utilities (e.g., `z-index: 400`). Mitigation: if no utility exists, leave the raw value with a comment.
- **[Build error]** `@apply` with an invalid utility class will fail at build time. Mitigation: verify each `@apply` against `tailwind.config.js` and Tailwind's default utilities.
