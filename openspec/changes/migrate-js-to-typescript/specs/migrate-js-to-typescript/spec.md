## ADDED Requirements

### Requirement: TypeScript configuration
The project SHALL include a `tsconfig.json` with appropriate settings for a Laravel Vite frontend.

#### Scenario: tsconfig.json exists at project root
- **WHEN** the migration is complete
- **THEN** `tsconfig.json` SHALL exist at the project root

#### Scenario: tsconfig includes DOM lib
- **WHEN** TypeScript compilation runs
- **THEN** the `lib` config SHALL include `"DOM"`, `"DOM.Iterable"`, and `"ES2020"`

#### Scenario: tsconfig sets noImplicitAny
- **WHEN** TypeScript type-checks the project
- **THEN** `noImplicitAny` SHALL be `true`

### Requirement: TypeScript dev dependencies
The project SHALL have `typescript` and `@types/node` as dev dependencies.

#### Scenario: typescript installed
- **WHEN** running `npm ls typescript`
- **THEN** the package SHALL be listed as a dev dependency

#### Scenario: @types/node installed
- **WHEN** running `npm ls @types/node`
- **THEN** the package SHALL be listed as a dev dependency

### Requirement: JavaScript files renamed to TypeScript
All files in `resources/js/` SHALL use the `.ts` extension.

#### Scenario: app.js renamed
- **WHEN** the migration is complete
- **THEN** `resources/js/app.js` SHALL NOT exist and `resources/js/app.ts` SHALL exist

#### Scenario: welcome.js renamed
- **WHEN** the migration is complete
- **THEN** `resources/js/welcome.js` SHALL NOT exist and `resources/js/welcome.ts` SHALL exist

### Requirement: welcome.ts is fully typed
The `resources/js/welcome.ts` file SHALL include type annotations for all variables, parameters, and function returns.

#### Scenario: DOM element variables are typed
- **WHEN** inspecting `welcome.ts`
- **THEN** all `getElementById` results SHALL be typed as `HTMLElement | null` (or specific subtype)

#### Scenario: event handler parameters are typed
- **WHEN** inspecting event listeners in `welcome.ts`
- **THEN** callback parameters SHALL have explicit type annotations (e.g., `MouseEvent`, `KeyboardEvent`)

#### Scenario: IntersectionObserver callback is typed
- **WHEN** inspecting the `IntersectionObserver` constructor
- **THEN** the callback SHALL have typed parameters (`IntersectionObserverEntry[]`, `IntersectionObserver`)

#### Scenario: closeMobileNav exposed on window
- **WHEN** inspecting `welcome.ts`
- **THEN** `window.closeMobileNav` SHALL be declared to avoid implicit `any`

### Requirement: Vite config updated to TypeScript entries
The Vite configuration SHALL reference `.ts` entry files.

#### Scenario: app.ts in vite input
- **WHEN** inspecting `vite.config.js`
- **THEN** the `input` array SHALL include `resources/js/app.ts`

#### Scenario: welcome.ts in vite input
- **WHEN** inspecting `vite.config.js`
- **THEN** the `input` array SHALL include `resources/js/welcome.ts`

### Requirement: Blade template references TypeScript
The Blade template SHALL reference the `.ts` entry points via Vite's `@vite` directive.

#### Scenario: welcome.blade.php uses .ts files
- **WHEN** the page renders
- **THEN** the `@vite` directive SHALL reference `resources/js/welcome.ts`

### Requirement: AGENTS.md updated
The project's `AGENTS.md` Tech Stack section SHALL list TypeScript instead of JavaScript.

#### Scenario: Tech Stack reflects TypeScript
- **WHEN** inspecting `AGENTS.md`
- **THEN** the Tech Stack SHALL include `TypeScript` (not `JS`)
