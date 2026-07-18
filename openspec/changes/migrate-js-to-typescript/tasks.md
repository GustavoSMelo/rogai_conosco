## 1. TypeScript Infrastructure

- [x] 1.1 Install `typescript` and `@types/node` dev dependencies
- [x] 1.2 Create `tsconfig.json` at project root with DOM lib, ES2020, noImplicitAny

## 2. Rename Files & Update Build Pipeline

- [x] 2.1 Rename `resources/js/app.js` to `resources/js/app.ts`
- [x] 2.2 Rename `resources/js/welcome.js` to `resources/js/welcome.ts`
- [x] 2.3 Update `vite.config.js` input entries to `.ts` extensions
- [x] 2.4 Update `resources/views/welcome.blade.php` `@vite` directive to reference `welcome.ts`

## 3. Add Type Annotations to welcome.ts

- [x] 3.1 Add type annotations to all DOM element references (`getElementById`)
- [x] 3.2 Add type annotations to event handler parameters
- [x] 3.3 Add type annotations to `IntersectionObserver` callbacks
- [x] 3.4 Declare `window.closeMobileNav` for global access

## 4. Verify & Update Documentation

- [x] 4.1 Run `vite build` to confirm TypeScript compilation succeeds
- [ ] 4.2 Verify no runtime regressions (check console in browser)
- [x] 4.3 Update AGENTS.md Tech Stack to list TypeScript instead of JS
