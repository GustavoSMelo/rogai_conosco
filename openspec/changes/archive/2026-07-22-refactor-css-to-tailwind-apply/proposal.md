## Why

Two of three CSS files (`app.css` and `result.css`) use raw CSS values (hardcoded hex colors, pixel values, custom properties) instead of Tailwind utility classes via `@apply`. The third file (`welcome.css`) already follows the Tailwind `@apply` convention consistently. This inconsistency makes the codebase harder to maintain — theme changes must be applied in multiple places instead of through Tailwind's config-driven design tokens.

## What Changes

- Refactor `resources/css/app.css` to use `@apply` with Tailwind utility classes for all custom selectors (`.splash-*`, `.reveal`, `.modal-content`, `#side-nav`, `#nav-overlay`, `.tree-layer`, `#hero`, `#page`, `#menu-btn`, `.sidebar`, `.main-content`, etc.)
- Refactor `resources/css/result.css` to use `@apply` with Tailwind utility classes for all custom selectors (`.result-card`, `.result-heading`, `.result-body`, `.result-btn-*`, `.result-back-link`, `.result-muted`, `.reveal-*`, `.result-page-body`)
- Preserve all `@keyframes` animations as-is (they are CSS animations, not Tailwind utilities)
- Preserve all `@media (prefers-reduced-motion: reduce)` overrides
- No behavioral or visual changes — pure CSS refactoring

## Capabilities

### New Capabilities

- `css-tailwind-consistency`: Enforce consistent use of Tailwind `@apply` directives across all CSS files

### Modified Capabilities

<!-- No spec-level behavioral changes — pure refactoring -->

## Impact

- `resources/css/app.css` — rewrite raw CSS selectors to use `@apply` directives
- `resources/css/result.css` — rewrite raw CSS selectors to use `@apply` directives
- `resources/css/welcome.css` — no changes (already uses `@apply`)
- `tailwind.config.js` — no changes (all tokens already defined)
- No changes to Blade templates, controllers, or tests
