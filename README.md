# Rogai Conosco

> Prayer request platform — anonymous prayer requests with 3 delivery forms.

Users can request prayers anonymously or register. Registered users can view history, leave reviews, and track emotional trends.

## How it works

1. **Recorded prayer** — audio/video, delivered via WhatsApp/email, 24–48h SLA. A real person prays for you.
2. **Instant prayer** — pre-written biblical prayers matched to the request.
3. **AI-generated prayer** — LLM-based instant prayer (OpenRouter), informed by the user's faith and religious tradition.

## Tech stack

| Layer     | Technology                                   |
|-----------|----------------------------------------------|
| Backend   | PHP 8.5, Laravel 13                          |
| Frontend  | Livewire 3, Volt 1.7, Tailwind CSS 4, Vite 8, TypeScript, Blade |
| Database  | SQLite (dev), MariaDB (prod / devcontainer)  |
| AI        | OpenRouter API (chat completions)            |
| Testing   | PHPUnit 12 (Unit + Feature), Pint, Larastan  |

## Requirements

- PHP 8.5+
- Composer 2
- Node.js 22+ and npm
- [Optional] Docker + VS Code Dev Containers extension (or GitHub Codespaces)

## Setup with Dev Container (recommended)

The repo ships a ready-made dev environment in `.devcontainer/` — PHP 8.5, MariaDB, Composer, Node, CLI agentic tools (opencode, claude-code, openspec, impeccable).

### VS Code

1. Open the repository in VS Code.
2. Install the **Dev Containers** extension (`ms-azuretools.vscode-containers`).
3. Run **Dev Containers: Reopen in Container** (or `Ctrl+Shift+P` → "Rebuild and Reopen in Container").
4. On first creation, the post-create script installs dependencies, copies `.env.devcontainer` to `.env`, and builds the frontend automatically.
5. Start the dev servers:

```bash
composer run dev
```

The post-create script already ran `composer install`, `npm install` and `npm run build`, so you can also just run `php artisan serve` + `npm run dev` separately if you prefer.

Services available inside the container:

| Service | URL/port                |
|---------|-------------------------|
| App     | http://localhost:8000   |
| Vite    | http://localhost:5173   |
| MariaDB | localhost:3306 (db: `rogaiconosco`, user/pass: `rogaiconosco`) |

### GitHub Codespaces

Open the repo on GitHub → **Code** → **Codespaces** → **Create codespace on main**. Same setup runs automatically.

### Enable AI features in the container

`.env.devcontainer` does not include AI keys. To enable AI-generated prayers, add to your `.env` inside the container:

```
OPENROUTER_API_KEY=sk-or-...
OPENROUTER_MODEL=your/model
```

Then restart the servers.

## Setup without Dev Container

Manual setup on your machine (SQLite used by default — no database server needed).

```bash
git clone git@github.com:GustavoSMelo/rogai_conosco.git
cd rogai_conosco

composer install
cp .env.example .env
php artisan key:generate
php artisan migrate

npm install
npm run build
```

Start the full dev environment (server + queue + logs + Vite, all at once):

```bash
composer run dev
```

Or run processes separately:

```bash
php artisan serve            # app at http://localhost:8000
php artisan queue:listen     # process queued jobs
npm run dev                  # Vite dev server
```

One-shot setup (equivalent to the devcontainer post-create):

```bash
composer run setup
```

### Environment variables

Key variables in `.env`:

| Variable                 | Description                                       |
|--------------------------|---------------------------------------------------|
| `DB_CONNECTION`          | `sqlite` (default, dev) or `mysql`/`mariadb`      |
| `OPENROUTER_API_KEY`     | API key for AI-generated prayers (OpenRouter)     |
| `OPENROUTER_MODEL`       | Model id used for AI prayers                      |
| `DASHBOARD_PASSWORD`     | Password for the internal dashboard               |
| `MAIL_MAILER`            | `log` in dev; configure SMTP/Mailtrap for delivery|

## Testing

```bash
php artisan test            # all tests
php artisan test --coverage # coverage report (target ≥ 75%)
php artisan test --filter=SomeTest
```

Code quality gate (also enforced by the pre-commit hook in `.githooks/`):

```bash
vendor/bin/pint             # PSR-1/PSR-12 formatting
vendor/bin/phpstan analyse  # static analysis (0 errors)
```

## Production (Docker)

A production compose file (Nginx + PHP-FPM + MariaDB) lives at the repo root:

```bash
docker compose up -d --build
```

Set `DB_*` environment variables in your shell or `.env` before running (the compose file consumes `${DB_PASSWORD}`, `${DB_DATABASE}`, `${DB_USERNAME}`, `${DB_PORT}`).