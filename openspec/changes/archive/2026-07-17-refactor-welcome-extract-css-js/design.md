## Context

The welcome page (`resources/views/welcome.blade.php`) contains ~140 lines of inline JavaScript and extensive Tailwind utility classes directly in HTML. This approach:
- Prevents Vite from bundling and minifying the JS
- Makes the template hard to read and maintain
- Bypasses Laravel's asset pipeline for caching and versioning
- Duplicates class patterns across similar elements

## Goals / Non-Goals

**Goals:**
- Extract all inline JS into `resources/js/welcome.js` as a Vite-bundled ES module
- Extract repeated Tailwind patterns into `resources/css/welcome.css`
- Replace inline Tailwind classes with semantic class names where patterns repeat 2+ times
- Keep one-off or unique Tailwind utilities inline (no value in extracting)

**Non-Goals:**
- No change to app functionality, layout, or visual output
- No refactoring of the Blade template structure (sections, loops, etc.)
- No addition of new UI behavior
- No changes to `resources/js/app.js` or `resources/css/app.css`

## Decisions

1. **Separate page-level entry vs. augmenting app.js** — A dedicated `welcome.js` avoids coupling page-specific logic to the global app bundle. Vite's code splitting keeps the welcome JS lazy-loadable.

2. **Semantic class naming** — Use BEM-like prefixes (`.welcome-`, `.hero-`, `.modal-`) scoped to the page. This avoids conflicts with future component styles and keeps the CSS self-documenting.

3. **Extraction threshold** — A Tailwind class combination used 2+ times on the page gets extracted into a CSS class. Single-use utilities stay inline for clarity.

4. **Vite import strategy** — Both `welcome.js` and `welcome.css` are imported via a single `@vite('resources/js/welcome.js')` call. Vite automatically processes JS imports and discovers CSS imports within JS, but since we keep CSS separate, both files get a `@vite` directive in the Blade template.

5. **No Tailwind `@apply` in welcome.css** — The extracted CSS uses plain CSS with custom properties or direct values. This avoids coupling the page stylesheet to Tailwind's build pipeline and keeps it independently cacheable.

## Risks / Trade-offs

- **[Risk]** Extracting CSS may increase total CSS payload if not done carefully → Mitigation: only extract repeated patterns; one-off utilities stay inline.
- **[Risk]** Moving JS to external file could break if DOM IDs change → Mitigation: the JS already queries by ID; IDs remain unchanged.
- **[Risk]** Developers may need to look in two places (template + CSS) to understand styling → Trade-off accepted for better separation of concerns.
