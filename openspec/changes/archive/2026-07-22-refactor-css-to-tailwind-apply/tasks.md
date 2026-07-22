## 1. Refactor app.css

- [x] 1.1 Convert `@layer base` selectors (html, body, textarea, ::selection, :focus-visible) to use `@apply` with Tailwind utilities
- [x] 1.2 Convert `@layer components` selectors (.text-balance, .text-pretty) to use `@apply`
- [x] 1.3 Convert `@layer utilities` (.measure) to use `@apply`
- [x] 1.4 Convert `#splash`, `.splash-logo`, `.splash-line`, `.splash-line-2`, `.splash-hide` selectors to use `@apply`
- [x] 1.5 Convert `#page`, `.page-show`, `.reveal`, `.reveal.visible` selectors to use `@apply`
- [x] 1.6 Convert `#side-nav`, `#nav-overlay`, `#menu-btn`, sidebar, `.main-content` selectors to use `@apply`
- [x] 1.7 Convert `.hero-trees`, `.hero-content`, `.tree-layer`, `.tree-layer-*` selectors to use `@apply`
- [x] 1.8 Convert `dialog`, `.modal-content` selectors to use `@apply`
- [x] 1.9 Convert `.animate-spin` and `.modal-content` responsive variants to use `@apply`
- [x] 1.10 Preserve `@keyframes`, `@media (prefers-reduced-motion: reduce)` blocks as-is

## 2. Refactor result.css

- [x] 2.1 Convert `.result-card` and responsive variant to use `@apply`
- [x] 2.2 Convert `.result-page-body` and `::before` pseudo-element to use `@apply` (keep `background-image` and `content` as raw)
- [x] 2.3 Convert `.result-heading`, `.result-body`, `.result-muted` to use `@apply`
- [x] 2.4 Convert `.result-btn-primary`, `.result-btn-secondary`, `.result-btn-outline` and hover states to use `@apply`
- [x] 2.5 Convert `.result-back-link` and hover state to use `@apply`
- [x] 2.6 Convert `.reveal`, `.reveal.visible`, `.reveal-delay-*` and reduced-motion to use `@apply`

## 3. Update AGENTS.md

- [x] 3.1 Update the file `AGENTS.md` to only use tailwind imports directives in *.css files 

## 4. Verify

- [x] 4.1 Run `npm run build` to confirm no build errors
- [x] 4.2 Run `php artisan test` to confirm no regressions
