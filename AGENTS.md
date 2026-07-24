# Rogai Conosco — Agentic Coding Guide

## Project Overview

> Prayer request platform — anonymous prayer requests with 3 delivery forms:
> 1. **Recorded prayer** (audio/video, delivered via WhatsApp/email, 24-48h SLA)
> 2. **Instant prayer** (pre-written biblical prayers)
> 3. **AI-generated prayer** (LLM-based instant prayer)

Users may request anonymously or register. Registered users can view history, leave reviews, and track emotional trends.

## Tech Stack

- **Backend:** PHP 8.5, Laravel 13
- **Frontend:** Livewire 3, Volt 1.7, Tailwind CSS 4, Vite 8, TypeScript, Blade
- **Testing:** PHPUnit 12 (Unit + Feature tests)
- **Agentic coding:** [OpenSpec](https://github.com/fissionai/openspec) (`@fission-ai/openspec`) [Impeccable](https://impeccable.style/) (`npx impeccable install`)

## TDD First — Required

**Every** function, component, and class must follow strict TDD:

1. **Write the OpenSpec spec** — define behavior, inputs, outputs, edge cases
2. **Write tests first** — PHPUnit Unit or Feature tests in `tests/`
3. **Implement** — only enough code to pass the tests
4. **Coverage ≥ 75%** — run `php artisan test --coverage` to verify

Test location conventions:
- `tests/Unit/` — models, services, actions, value objects
- `tests/Feature/` — Livewire components, HTTP controllers, Volt pages

## Running Tests

```bash
php artisan test                    # all tests
php artisan test --coverage         # with coverage report
php artisan test --filter=SomeTest  # single test class
```

Coverage is measured for the `app/` directory (configured in `phpunit.xml`).

## OpenSpec Workflow

1. Create a `.spec.md` file (e.g., `specs/prayer-request.spec.md` or alongside the code)
2. Run `openspec` to scaffold tests from the spec
3. Write the test, watch it fail (red)
4. Implement, watch it pass (green)
5. Refactor if needed

## Architecture Notes

- **Livewire Volt** for page-level components (`resources/views/livewire/`)
- **Livewire full components** for complex interactions (`app/Livewire/`)
- **Actions pattern** for business logic (`app/Actions/`)
- **Queued jobs** for recorded prayer processing (audio/video rendering)
- **WhatsApp notifications** via Laravel notifications
- **Database:** SQLite (dev), MariaDB (prod — docker-compose)

## Commit Convention

```
<type>(<scope>): <description>

types: ✨ feat, 🐛 fix, 🧪 test, ♻️ refactor, 📄 spec, 📝 docs, 🔧 chore
```

Always run `php artisan test` before committing. Do not commit without passing tests.

## Dev Environment

```bash
git config core.hooksPath .githooks  # enable pre-commit hooks
composer install                     # install dependencies
php artisan serve                    # starts server, queue, logs, vite concurrently
composer run setup                   # fresh install
```

The pre-commit hook in `.githooks/pre-commit` runs **Pint**, **Larastan**, and **PHPUnit** before every commit. It is version-controlled so everyone gets it automatically after running `git config core.hooksPath .githooks`.

## Installing Skills

Skills are version-controlled in `.github/skills/` as the canonical source. To install them into your agentic coding harness, symlink from the harness's skills directory:

```bash
# One-time install — adjust <harness-skills-dir> to match your tool
mkdir -p <harness-skills-dir>
for skill in .github/skills/*/; do
  name=$(basename "$skill")
  ln -sfn "$(pwd)/.github/skills/$name" "<harness-skills-dir>/$name"
done
```

For example:

| Harness  |   Skills directory  |
|----------|---------------------|
| OpenCode | `.opencode/skills/` |
| Cline    | `.cline/skills/`    |
| Roo      | `.roo/skills/`      |
| Claude   | `.claude/skills`    |
| Codex    | `.codex/skills`     |
| Pi       | `.pi/skills`        |
| Cursor   | `.cursor/skills`    |

Re-run after pulling skill updates. Verify with:
```bash
ls -la <harness-skills-dir>/  # should show 7 entries
```

## Design Context

Brand and design decisions are captured in `PRODUCT.md` (strategy) and `DESIGN.md` (visual system). Key anchors:

- **Register:** Brand (marketing-first). The site communicates mission before features.
- **Personality:** Peaceful, trustworthy, humble. Quiet confidence, no hype.
- **Palette:** Pure white bg, muted olive primary (`oklch(0.55 0.10 115)`), deep terracotta accent (`oklch(0.40 0.12 28)`). OKLCH throughout.
- **Typography:** Source Serif 4 (headings, reverent warmth) + Figtree (body, clean approachability).
- **Motion:** Gentle fade-up reveals, slow ease-out-quart. No bounce, no elastic. `prefers-reduced-motion` respected.
- **Theme:** Light. Pure white surface, not tinted. Brand color carried by accents, not background.
- **Anti-references:** No generic SaaS, no megachurch flash, no gothic/dark moods.
- **Reference:** Hallow (calm, beautiful, reverent prayer app).

Run `/skill impeccable` and then use its built-in commands (`critique`, `craft`, `polish`, `live`, etc.).

## Frontend Design (Impeccable Skill)

The **impeccable** skill handles all frontend/UI work: critique, craft, polish, animate, audit, distill, and live-iterate on interfaces. It covers Tailwind, Livewire Volt, typography, spacing, layout, color, motion, accessibility, responsive behavior, and the visual system in `DESIGN.md`.

Load it with `/skill impeccable` when working on any UI task.

## CSS Convention

All `*.css` files SHALL use Tailwind `@apply` directives instead of raw CSS values whenever a corresponding utility class exists. This keeps the codebase in sync with `tailwind.config.js` design tokens.

- `@keyframes` and `@media` at-rules may remain as raw CSS
- Values without Tailwind equivalents (e.g., `clamp()`, `rgba()` with multi-stop values, `animation` with custom cubic-bezier) may remain as raw CSS
- Reference `resources/css/welcome.css` for the canonical `@apply` pattern
