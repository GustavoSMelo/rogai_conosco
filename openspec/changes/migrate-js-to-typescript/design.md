## Context

The project has two JavaScript files in `resources/js/`: `app.js` (empty) and `welcome.js` (142 lines of vanilla DOM manipulation). Neither has type definitions. Vite supports TypeScript natively with zero config — files can be renamed from `.js` to `.ts` and Vite will handle compilation. No TypeScript infrastructure exists yet (no `tsconfig.json`, no `typescript` package).

## Goals / Non-Goals

**Goals:**
- Add TypeScript configuration (`tsconfig.json`) appropriate for a Laravel+Vite frontend
- Install `typescript` and `@types/node` as dev dependencies
- Rename `app.js` → `app.ts`, `welcome.js` → `welcome.ts`
- Add type annotations to all DOM references, event handlers, and callbacks in `welcome.ts`
- Update `vite.config.js` input entries to reference `.ts` files
- Update `welcome.blade.php` Vite directive
- Update `AGENTS.md` Tech Stack to reflect TypeScript

**Non-Goals:**
- No runtime behavior changes — the TS output must be identical in behavior
- No framework migration (no React, Vue, Alpine — stays vanilla TS)
- No test files for the TS code (the JS had no tests either)
- No CI pipeline changes

## Decisions

1. **Strict TSConfig with `noImplicitAny`** — Catches untyped variables while keeping the migration feasible without excessive type gymnastics. `strict: true` is too aggressive for a vanilla DOM script.

2. **`@types/node` required** — Vite runs in Node context; type definitions for `NodeJS` globals are needed.

3. **TypeScript types for DOM elements** — Use `HTMLElement | null` for `getElementById` results and proper `HTMLInputElement`/`HTMLTextAreaElement` casts. The `IntersectionObserver` callback and event handlers get explicit parameter types.

4. **`window.closeMobileNav` global** — The function is exposed on `window` for inline `onclick` in the Blade template. TypeScript needs a declaration merge (`declare global` or `(window as any)`) to avoid the implicit `any` error.

5. **Vite entry unchanged** — Laravel Vite plugin already resolves `.ts` files. Only the file extension in the `input` array and the Blade `@vite` directive need updating.

## Risks / Trade-offs

- **[Low risk]** `tsconfig.json` `include` must cover `resources/js/` but exclude `vendor/`, `node_modules/`, `public/`. Standard `**/*.ts` pattern.
- **[Low risk]** The `IntersectionObserverEntry` and `MutationObserverInit` types require `@types/node` or `lib: ["dom"]` in tsconfig. Using `"lib": ["ES2020", "DOM", "DOM.Iterable"]` covers all needed types.
- **[Low risk]** No TypeScript compilation step in the build — Vite strips types during bundling. `tsc` is only used for editor support and type checking (`tsc --noEmit`).
