# Contributing to Rogai Conosco

Thanks for considering contributing. This guide covers the workflow, quality gates, and conventions every contribution must follow.

## Development workflow

This project follows **TDD first** — behavior is specified and tested before implementation. Agentic tools (OpenSpec, Claude Code, OpenCode) are used for most work.

1. **Fork the repository** on GitHub and clone your fork:

```bash
git clone git@github.com:<your-username>/rogai_conosco.git
cd rogai_conosco
```

2. **Add the upstream remote** and keep your fork in sync:

```bash
git remote add upstream git@github.com:GustavoSMelo/rogai_conosco.git
git fetch upstream
git checkout main
git pull upstream main
```

3. **Create a feature branch** (use a descriptive name, not `main`):

```bash
git checkout -b feat/prayer-result-improvements
```

4. **Set up the environment** — see the [README](README.md) for devcontainer or manual setup.

5. **Enable the pre-commit hooks** (runs Pint, Larastan, and PHPUnit before every commit):

```bash
git config core.hooksPath .githooks
```

6. **Enable agentic skills** (optional, for agent-assisted work):

```bash
mkdir -p .opencode/skills
for skill in .github/skills/*/; do
  name=$(basename "$skill")
  ln -sfn "$(pwd)/.github/skills/$name" ".opencode/skills/$name"
done
```

## TDD first — required

Every function, component, and class follows strict TDD:

1. **Write the OpenSpec spec** — define behavior, inputs, outputs, edge cases (`.spec.md` in `specs/` or alongside the code).
2. **Write tests first** — PHPUnit Unit or Feature tests in `tests/`.
3. **Implement** — only enough code to pass the tests.
4. **Verify coverage** — each file ≥ 70%, overall ≥ 75%.

Test locations:

- `tests/Unit/` — models, services, actions, value objects
- `tests/Feature/` — Livewire components, HTTP controllers, Volt pages

## Quality gate

Before committing, all of the following must pass:

```bash
php artisan test                  # all tests green
php artisan test --coverage       # overall coverage ≥ 75%
vendor/bin/pint --test            # PSR-1/PSR-12 formatting
vendor/bin/phpstan analyse        # 0 errors
```

Additional constraints (see `.agents/REVIEW.md` for the full protocol):

- Cyclomatic complexity < 12
- Max 800 lines per module — split into two modules beyond that
- Every file ≥ 70% test coverage
- PHPDocblocks / TypeScript function descriptions on all code
- No `console.log` / debug leftovers

## Commit convention

```
<type>(<scope>): <description>
```

Types: `✨ feat`, `🐛 fix`, `🧪 test`, `♻️ refactor`, `📄 spec`, `📝 docs`, `🔧 chore`

Examples:

```
✨ feat(prayer): add AI-generated disclaimer to AI prayer result
🐛 fix(https): trust proxy headers and force https scheme behind TLS proxy
```

Never commit with failing tests — the pre-commit hook enforces this.

## Opening a pull request

1. Push your branch to your fork:

```bash
git push origin feat/prayer-result-improvements
```

2. Open a PR against `main` on GitHub, from your fork. The description should include:

   - **What** — summary of the change and why
   - **Spec/tests** — how the behavior was specified and tested (link the `.spec.md` if applicable)
   - **Verification** — tests, Pint, and Larastan results
   - **Screenshots** — for UI changes

3. Keep PRs small and focused on one concern. Large changes should be split.

## Code review

An AI review protocol lives in `.agents/REVIEW.md`. You can request a review with:

> Review the code in `<path-or-scope>` following `.agents/REVIEW.md`. Report findings + severity.

Reviews are advisory — the reviewing agent must NOT modify code.

## Reporting issues

Open an issue with a clear title, steps to reproduce, expected vs. actual behavior, and environment details (PHP version, OS, container vs. manual setup).