# Rogai Conosco — AI Code Review Guide

> This file defines the review protocol an AI agent must follow when reviewing code in this repository. All parameters below are derived from `AGENTS.md` quality gates. Deviations are findings.

## How to Trigger a Review

Ask the agent with a prompt like:

```
Review the code in <path-or-scope> following REVIEW.md. Report findings + severity.
```

Typical scopes: a single file, a diff (`git diff`), an uncommitted change, or the whole `app/` + `resources/` tree.

## Review Scope

- `app/` — models, services, actions, Livewire components, jobs, notifications
- `resources/views/livewire/` — Volt page components
- `resources/` (TS, CSS, Blade) — frontend code
- `tests/` — unit and feature tests
- Any spec files (`*.spec.md`, `openspec/`)

## Hard Parameters (from AGENTS.md — Quality Gate)

| # | Parameter | Rule | How to verify |
|---|-----------|------|---------------|
| 1 | Cyclomatic complexity | Must be **lower than 12** per function/method | Manual inspection; extract conditionals/loops count |
| 2 | Module size | Max **800 lines** per file — beyond that must be split | `wc -l <file>` |
| 3 | Unit test coverage | Every file in `app/` **≥ 70% coverage**, every function/class has a unit test | `php artisan test --coverage`; each app file must have a matching test in `tests/Unit/` or `tests/Feature/` |
| 4 | Docblocks | Every PHP function/class must have a **PHPDocblock**; every TS function must have a **description** | Manual inspection |
| 5 | PHPStan / Larastan | Must run clean — **0 errors** at configured level (level 5 in `phpstan.neon.dist`) | `vendor/bin/phpstan analyse` |
| 6 | Syntax / parse | Every PHP file must parse without errors (php-parser based — run `php -l <file>`) | `php -l <file>`, `vendor/bin/phpstan analyse` already fails on parse errors |
| 7 | PSR standards | Code SHALL be **PSR-1 + PSR-12 compliant** (naming, autoload, formatting, strict types, visibility). Enforced by **Pint** — must be clean (no diffs) | `vendor/bin/pint --test` |
| 8 | PHP metrics | Quality metrics per PHP code-quality gate: complexity < 12, coupling reasonable, no long methods | See parameter 1; worse-case scans in `phpstan` diagnostics |

## Compliance Checks (from AGENTS.md — Conventions)

### TDD
- [ ] Test written before implementation (check `git log` order or follow-up spec files)
- [ ] Tests placed correctly: `tests/Unit/` for models/services/actions/value objects; `tests/Feature/` for Livewire components, HTTP controllers, Volt pages

### Architecture
- [ ] Volt for page-level components (`resources/views/livewire/`)
- [ ] Full Livewire components for complex interactions (`app/Livewire/`)
- [ ] Business logic in `app/Services/` — do NOT use `app/Actions/`
- [ ] Queued jobs for recorded prayer processing (audio/video rendering)
- [ ] WhatsApp notifications via Laravel notifications
- [ ] DB usage matches: SQLite (dev), MariaDB (prod)

### Frontend / Design (if UI code in scope)
- [ ] Palette/text in design tokens, OKLCH colors (`oklch(0.55 0.10 115)` olive, `oklch(0.40 0.12 28)` terracotta)
- [ ] Typography: Source Serif 4 headings, Figtree body
- [ ] Motion: gentle fade-up, ease-out-quart, no bounce/elastic, respects `prefers-reduced-motion`
- [ ] Light theme, white surface, brand color in accents only
- [ ] CSS uses `@apply` instead of raw CSS when a utility exists (`@keyframes`/`@media`/non-token values exempt)

### Tooling / Static Analysis
- [ ] `vendor/bin/pint --test` — clean, PSR-12 formatting (pre-commit hook runs Pint)
- [ ] `vendor/bin/phpstan analyse` — 0 errors at level 5 (Larastan)
- [ ] `php -l` — no syntax/parse errors on changed PHP files
- [ ] PHP files follow PSR-1 (naming: `camelCase` methods, `PascalCase` classes, `snake_case` filespaces, autoloading PSR-4) and PSR-12 (declaration order, spacing, strict types)

### Code Style
- [ ] No comments unless asked (per opencode guidelines)
- [ ] No secrets, keys, or sensitive data in code/commits
- [ ] Split modules > 800 lines into two

## Verification Commands

```bash
php artisan test                     # must pass before any commit
php artisan test --coverage          # verify ≥ 70% per file
vendor/bin/phpstan analyse           # PHPStan (Larastan) — 0 errors @ level 5
vendor/bin/pint --test               # PSR-12 style — clean
php -l app/<file>                    # syntax/parse check on changed files
wc -l app/<file>                     # module size check
git diff --stat                      # scope of change
```

## Finding Format

Report every finding as:

```
<file>:<line>: <SEVERITY> <category>: <problem>. <suggestion>
```

Severities:
- **BLOCKER** — would break build, tests, or security
- **CRITICAL** — violates hard parameter (complexity ≥ 12, > 800 lines, < 70% coverage, missing docblock)
- **WARNING** — violates convention (TDD, architecture, design)
- **INFO** — style/nit without impact

## Final Output

1. Summary line: pass / fail, count by severity
2. Findings list
3. Verification evidence (commands run + results)

Do NOT modify code. Review only. If asked to fix, say so and wait.