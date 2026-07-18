## Why

The project uses vanilla JavaScript (`resources/js/app.js`, `resources/js/welcome.js`) with no type safety, leading to runtime errors that could be caught at build time. TypeScript provides static type checking, better IDE support, and aligns with modern Laravel ecosystem standards. Vite already supports TypeScript natively — no additional build tooling needed.

## What Changes

- Rename `resources/js/app.js` → `resources/js/app.ts` and `resources/js/welcome.js` → `resources/js/welcome.ts`
- Add TypeScript configuration (`tsconfig.json`)
- Install `typescript` and `@types/node` dev dependencies
- Update `vite.config.js` to reference `.ts` files
- Update `welcome.blade.php` to reference `.ts` endpoints via Vite
- Update `AGENTS.md` Tech Stack to list TypeScript instead of JS
- Convert `welcome.js` to fully typed TypeScript (add type annotations, interfaces)
- `app.js` is empty — becomes empty typed entry point

## Capabilities

### New Capabilities
- `migrate-js-to-typescript`: Convert all `resources/js/` files from JavaScript to TypeScript, configure the TypeScript compiler, update build pipeline references, and update project documentation.

### Modified Capabilities
- None — no existing specs affect frontend build configuration.

## Impact

- `resources/js/app.js` → `resources/js/app.ts` (renamed)
- `resources/js/welcome.js` → `resources/js/welcome.ts` (renamed + typed)
- `vite.config.js` — input entries updated to `.ts`
- `resources/views/welcome.blade.php` — Vite reference updated
- `AGENTS.md` — Tech Stack updated
- `package.json` — `typescript`, `@types/node` added
- New file: `tsconfig.json`
