## Why

The welcome page bundles JavaScript inline within the Blade template and uses Tailwind utility classes directly in HTML, making it hard to maintain, lint, and cache. Extracting JS to a dedicated file enables module bundling via Vite, while extracting CSS utility classes into a component stylesheet separates concerns and reduces template noise.

## What Changes

- Extract all inline JavaScript from `resources/views/welcome.blade.php` into a new file `resources/js/welcome.js`
- Extract reusable Tailwind utility class patterns from the Blade template into a new CSS file `resources/css/welcome.css`
- Import both files via Vite (`@vite`) in the Blade template
- Remove the inline `<script>` block from the Blade template
- Replace inline Tailwind classes with semantic CSS class names where it improves readability; keep Tailwind for one-off utilities

## Capabilities

### New Capabilities
- `welcome-js-extraction`: Extracts all inline DOM manipulation, event handling, and IntersectionObserver logic from the Blade template into a standalone ES module
- `welcome-css-extraction`: Extracts repeated Tailwind utility patterns and layout classes into a dedicated CSS file with scoped selectors

### Modified Capabilities

<!-- No existing specs are modified by this change. -->

## Impact

- `resources/views/welcome.blade.php` — inline `<script>` removed, Tailwind classes partially replaced with CSS classes
- `resources/js/welcome.js` — new file (Vite entry, imported via `@vite`)
- `resources/css/welcome.css` — new file (Vite entry, imported via `@vite`)
- `resources/css/app.css` — no changes (global styles remain)
- `resources/js/app.js` — no changes (remains as the main app entry; welcome.js is a separate page entry)
- `vite.config.js` — no changes needed (Vite auto-discovers imports)
