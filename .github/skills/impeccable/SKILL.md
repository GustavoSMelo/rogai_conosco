# Impeccable — Design Critique & UI Craft Skill

A design skill for the Rogai Conosco prayer platform. Handles all frontend/UI work: critique, craft, polish, animate, audit, distill, and live-iterate on interfaces.

## When to Use

Load this skill when working on any UI task — Blade templates, Livewire Volt components, Tailwind CSS, typography, layout, color, motion, accessibility, responsive behavior, or the visual system.

## Commands

### `critique <file>`
Run a design health critique on a UI file. Scores 10 heuristics (1-4), checks anti-patterns, persona red flags, and generates a prioritized issue list with suggested commands.

### `clarify`
Fix language/consistency issues (e.g., Portuguese/English mix, unclear copy).

### `delight`
Add human warmth — imagery, illustrations, photographs of people. Fix "zero human imagery" issues.

### `distill`
Simplify UI — remove numbered scaffolding (01/02/03), AI tropes, unnecessary decoration.

### `harden`
Fix UX safety issues — loading states, error recovery, maxlengths, validation, broken links, non-skippable splash screens.

### `audit`
Accessibility (WCAG AA), performance, responsive, and contrast audit.

### `animate`
Motion design review — fade-up reveals, ease-out-quart, `prefers-reduced-motion` compliance. No bounce/elastic.

### `polish`
General visual polish — spacing, alignment, typography rhythm, color token consistency.

### `craft`
Build or refine a UI component against brand guidelines (DESIGN.md, PRODUCT.md).

### `live`
Start or connect to the live preview server for hot-reload iteration on Blade views.

## Design System Anchors

- **Brand:** Marketing-first, communicates mission before features.
- **Personality:** Peaceful, trustworthy, humble. Quiet confidence, no hype.
- **Palette:** Pure white bg, muted olive primary (`oklch(0.55 0.10 115)`), deep terracotta accent (`oklch(0.40 0.12 28)`). OKLCH throughout.
- **Typography:** Source Serif 4 (headings) + Figtree (body).
- **Motion:** Gentle fade-up reveals, slow ease-out-quart. No bounce/elastic. Respect `prefers-reduced-motion`.
- **Theme:** Light. Pure white surface, no tinted bg. Brand color via accents, not background.
- **Anti-references:** No generic SaaS, no megachurch flash, no gothic/dark moods.
- **Reference:** Hallow (calm, beautiful, reverent prayer app).

## Heuristics (Design Health Score)

1. Visibility of System Status
2. Match System / Real World
3. User Control and Freedom
4. Consistency and Standards
5. Error Prevention
6. Recognition Rather Than Recall
7. Flexibility and Efficiency of Use
8. Aesthetic and Minimalist Design
9. Error Recovery
10. Help and Documentation

Scored 1-4. Target ≥ 32/40.

## Related Files

- `.impeccable/` — critique history, live config, annotations
- `.impeccable/critique/` — past design health critiques
- `.impeccable/live/` — live preview server state
- `DESIGN.md` — full visual system (referenced, create if needed)
- `PRODUCT.md` — product strategy (referenced, create if needed)
