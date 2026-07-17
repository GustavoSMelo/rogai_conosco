## Context

The `welcome.css` file currently defines 15+ custom classes using raw CSS values — colors like `#7d8a5a`, `#1c1c14`, spacings like `6rem`, font sizes like `1.125rem`. These duplicate the Tailwind design tokens defined in the project's `tailwind.config.js` and `app.css`. Meanwhile, the Blade template still has ~30 inline Tailwind utility classes that could be consolidated into CSS classes.

## Goals / Non-Goals

**Goals:**
- Replace all raw CSS values in `welcome.css` with Tailwind `@apply` directives referencing the project's utility classes
- Move every remaining inline Tailwind class from `welcome.blade.php` into a CSS class in `welcome.css` using `@apply`
- Keep the same visual output — zero visual regression

**Non-Goals:**
- No changes to `app.css` or global Tailwind config
- No changes to `welcome.js` or any JS behavior
- No renaming or restructuring of existing CSS class names (`.welcome-sidebar-link`, etc.)

## Decisions

1. **`@apply` for all — no raw values** — Every color, spacing, font, radius, shadow, and transition uses `@apply` with Tailwind classes. This keeps the stylesheet in sync with the Tailwind config automatically.

2. **Inline classes consolidated** — Every inline Tailwind class combo used 1+ times (not just 2+) moves to a CSS class. Since the goal is zero inline Tailwind in the Blade, single-use patterns also get extracted.

3. **`@apply` within `@layer components`** — The `@apply` directives go inside `@layer components` blocks in `welcome.css` to match Tailwind best practices and avoid specificity conflicts.

4. **Custom selectors preserved** — IDs and element selectors like `dialog`, `.hero-trees`, `#splash`, `#side-nav` remain as-is since they aren't Tailwind utility patterns; only their property values get replaced with `@apply`.

## Risks / Trade-offs

- **[Risk]** `@apply` with responsive/hover variants (`hover:`, `sm:`) may not work in all Tailwind versions → Verified: Tailwind v4 + `@apply` supports variants. Use `@apply hover:bg-brand-accent hover:text-white;` syntax.
- **[Risk]** Replacing all inline classes changes the class attribute count on elements → No functional impact, all visual behavior is moved to CSS.
