# Product

<!-- impeccable:product-schema 1 -->

## Platform

web

## Users

- **People seeking prayer** (primary, public): anyone going through pain, worry, or gratitude who wants their situation prayed for, anonymously or registered. Anonymous use is the core promise — no account required to submit.
- **Registered users**: return to view request history, leave reviews, and track emotional trends.
- **Panelists** (painel): staff who receive, respond to, and deliver prayer responses (recorded audio/video, instant prayers, AI-generated prayers) via WhatsApp/email within a 24–48h SLA.
- **Supporters** (donation page, inferred): visitors who value the service and want to sustain it. Donation page is UI-only for now; no payment gateway confirmed.

## Product Purpose

A calm, trustworthy prayer-request platform: a person submits a request anonymously and receives a response in one of three forms — recorded prayer (audio/video via WhatsApp/email), instant pre-written biblical prayer, or AI-generated prayer. Success means the requester feels heard and supported; the site communicates its mission before its features.

## Positioning

Anonymous prayer requests with human-recorded, time-boxed (24–48h) delivery on WhatsApp/email — a promise of real personal attention, not automation. The site is mission-first (marketing-first brand): the mission is the product.

## Operating Context

- Requests carry name (optional), message, contact (email/WhatsApp, encrypted), prayer type, religion, tags.
- Panelists work in a password-protected painel (Laravel Livewire Volt pages) to list, filter, respond (media upload or public link), notify via WhatsApp deep link or email, and mark answered.
- Language: pt-BR throughout.
- Stack: PHP 8.5 / Laravel 13 / Livewire 3 + Volt / Tailwind 4 / Vite / SQLite dev / MariaDB prod.

## Capabilities and Constraints

- Anonymous submission with optional registration; contact fields encrypted (Crypt).
- Delivery forms: recorded (person-prayer/word audio/video), instant, AI.
- WhatsApp response opens a wa.me deep link prefilled with greeting + prayer message + media link; link must be `https://` with domain `.com`, `.com.br`, `.dev`, `.dev.br`, `.app`, or `.app.br`; uploaded files are never used as the WhatsApp link; greeting varies by time of day (Bom dia / Boa tarde / Boa noite).
- Email response via Mailtrap SMTP with optional media attachment/link.
- Undecided: payment gateway for donations, PIX key/code, legal entity/CNPJ info, donor recognition, donation receipts.

## Brand Commitments

- Personality: peaceful, trustworthy, humble; quiet confidence, no hype, no gamification.
- Palette: pure white background; muted olive primary (`oklch(0.55 0.10 115)`); deep terracotta accent (`oklch(0.40 0.12 28)`); OKLCH throughout; light theme only.
- Typography: Source Serif 4 for headings (reverent warmth), Figtree for body (clean approachability).
- Motion: gentle fade-up reveals, slow ease-out-quart; no bounce/elastic; respect `prefers-reduced-motion`.
- Reference: Hallow (calm, beautiful, reverent prayer app).
- Anti-references: no generic SaaS, no megachurch flash, no gothic/dark moods.

## Evidence on Hand

- Full public surface: `resources/views/welcome.blade.php` + `resources/css/welcome.css` (brand tokens in `tailwind.config.js`: brand.bg #f0f0d8, brand.primary #7d8a5a, brand.accent #8a5a47, brand.ink #1c1c14).
- Painel surface: `resources/views/painel/` + `resources/css/painel.css`.
- No DESIGN.md exists yet; the incumbent visual system lives in the code above (to be documented via `$impeccable document`).
- No testimonials, donor stories, or payment proof exist — must not be fabricated.

## Product Principles

1. The requester is never a transaction; every response carries personal attention and a 24–48h human promise.
2. The mission leads: communicate why the service exists before what it does.
3. Calm over urgency: quiet confidence, reverent warmth, no hype or pressure.
4. Anonymity and privacy are sacred: encrypted contacts, no leakage.
5. Sustain the service honestly: donations are support, not purchase — no gateway exists yet, so no payment claims.

## Accessibility & Inclusion

- Respect `prefers-reduced-motion`; gentle motion by default.
- Public surface is a marketing site (Persuade); the painel is an Operate surface.
- No confirmed WCAG target beyond the above; existing CSS follows Tailwind conventions.
