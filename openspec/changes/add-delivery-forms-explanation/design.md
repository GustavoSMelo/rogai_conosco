## Context

The welcome page (`resources/views/welcome.blade.php`) has a "Como sua oração chega até você" section (`#delivery`) presenting three steps: recorded prayer, instant prayer, AI prayer. The recorded option is a single step card, but the prayer modal's "Tipo de oração" select exposes 6 recorded variants grouped into 3 semantics: **Apenas oração** (pray), **Apenas palavra** (word), **Oração + palavra** (pray + word) — each in audio or video. The page never explains these variants, so users pick blindly.

The page uses a static blade + CSS pattern: sections are hand-written HTML with Tailwind utilities and welcome-* custom classes defined in `resources/css/welcome.css`. Existing cards use `welcome-card`, chips use `welcome-chip`, and motion uses the `reveal` class. CSS follows the `@apply` convention (see AGENTS.md).

## Goals / Non-Goals

**Goals:**
- Explain the three recorded sub-options (pray, word, pray + word) with the exact names used in the modal select, so the user understands each before submitting
- Make clear that "palavra" = a Bible verse chosen for the user's specific situation
- Reuse existing visual language (cards, chips, brand colors, `reveal` animation) — no new design system

**Non-Goals:**
- No backend changes, no modal changes, no new routes
- No changes to the instant/AI steps of the delivery section
- No interactive behavior (section is informational, plain HTML + CSS)

## Decisions

**Decision 1: New static section after `#delivery`, not a modification of the step cards**
The step 1 card stays as-is (it is the most-requested option at a glance); the sub-options get their own section right after, so the delivery flow reads "3 forms → recorded has 3 variants". Alternative considered: expanding step 1 into nested cards — rejected because the three-step layout and numbering would break.
Implementation: new `<section id="delivery-options">` with heading "O que você pode receber" (or similar), subtitle, and a 3-card grid using `welcome-cards-grid` + `welcome-card` classes already present, each card with `reveal` class.

**Decision 2: Section order and naming mirror the modal select options**
Card titles use the exact strings from the modal (`Apenas oração`, `Apenas palavra`, `Oração + palavra`) to avoid terminology mismatch. Each card gets a chip matching the step colors (brand-primary for pray, brand-accent for word, brand-ink for combined) and a short explanation of what is delivered.

**Decision 3: Pure static markup; any new styles go into `welcome.css` via `@apply`**
No Livewire state needed. If new utility combos are needed (e.g., a detail line), define a `welcome-*` class in `resources/css/welcome.css` using `@apply`, per the CSS convention. If existing classes suffice, no CSS changes at all.

## Risks / Trade-offs

- [Page length grows] → Section is compact (3 cards), consistent with existing sections; sidebar already scrolls
- [Text/card wording mismatch with future modal labels] → Titles copied from current select options; note in code comment that labels live in welcome.blade.php modal select
- [Feature tests cannot easily assert static blade content] → Spec scenarios tested via Livewire/HTTP test asserting rendered HTML contains the section and titles (feature test on the `/` route)