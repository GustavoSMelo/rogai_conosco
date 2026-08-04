---
target: resources/views/donate.blade.php
total_score: 14
max_score: 32
na_heuristics: 7,10
p0_count: 2
p1_count: 2
timestamp: 2026-07-31T20-04-00Z
slug: resources-views-donate-blade-php
---
## Design Health Score

| # | Heuristic | Score | Key Issue |
|---|-----------|-------|-----------|
| 1 | Visibility of System Status | 2 | CTA click shows "Obrigado" but no actual transaction |
| 2 | Match System / Real World | 3 | Poetic labels map well; "em breve" breaks metaphor |
| 3 | User Control and Freedom | 2 | No deselect; no undo after CTA click |
| 4 | Consistency and Standards | 2 | Top-bar nav vs sidebar; CTA color differs; footer structure differs |
| 5 | Error Prevention | 1 | CTA simulates completed donation with no backend |
| 6 | Recognition Rather Than Recall | 3 | Amounts, labels, selection state visible |
| 7 | Flexibility and Efficiency | n/a | Persuade surface |
| 8 | Aesthetic and Minimalist Design | 3 | Clean but 11 undifferentiated cards create noise |
| 9 | Error Recovery | 1 | No error states; post-CTA disabled with no retry |
| 10 | Help and Documentation | n/a | Persuade surface |
| **Total** | | **14/32** | **Poor** |

## Design Specificity Verdict

**LLM assessment**: Poetic amount labels are deeply Catholic and impossible to misappropriate — strongest specificity signal. Copy carries product DNA. But composition is generic nonprofit donation-page skeleton. Welcome page has sidebar nav, hero with gradient + trees, step timeline, chips. Donate borrows tokens and type scale but not compositional language. Unrelated charity could swap labels and deploy unchanged.

**Deterministic scan**: Detector clean (0 findings). Manual review uncovered 3 CRITICAL bugs: opacity-0 on visible state, reduced-motion opacity-0, class name mismatch (donate-visible vs donate-reveal-visible). 2 HIGH bugs: hidden attribute vs classList mismatch, ctaLabel queries nonexistent span.

**Browser visualization**: Skipped — no browser automation tool exposed.

## Overall Impression

Poetic labels and honest "em breve" show right instincts, but page is mechanically broken (reveal animation dead, donation confirmation non-functional) and strategically inverted (ask before conviction, 11 undifferentiated options, share link leads to donation page). Biggest opportunity: reorder conviction-first → ask-second, group 11 amounts into 3 visual tiers.

## What's Working

1. Poetic amount labels transform pricing grid into liturgical act — deeply specific, emotionally resonant.
2. Honest "em breve" copy transparent about missing payment gateway.
3. Selection state well-handled — aria-pressed, check icon, CTA text update.

## Priority Issues

- [P0] Reveal animation entirely non-functional: no donate-reveal class on elements, JS/CSS class name mismatch, opacity-0 on visible state, reduced-motion overrides also opacity-0. Fix: wire classes, fix name, fix opacity.
- [P0] CTA click produces false completion: "Obrigado" implies transaction that didn't happen. Plus hidden/classList mismatch means done-note likely never shows. Fix: waitlist language or disabled "Em breve" CTA, fix hidden bug.
- [P1] 11 undifferentiated cards = decision paralysis: same visual weight, violates ≤4 rule. Fix: 3 visual tiers, "popular" indicator, or progressive disclosure.
- [P1] Mission section post-CTA: conviction must precede ask on Persuade surface. Fix: move between hero and grid.
- [P2] Share link copies donate URL, not prayer page: copy says "needs prayer" but links to /doar. Fix: copy welcome route URL.

## Persona Red Flags

**Jordan (Confused First-Timer)**: 11 cards, no guidance, clicks CTA, "Obrigado" = confusion about whether money was taken.

**Riley (Stress Tester)**: No deselect, CTA shows wrong amount after re-click, "Copiar link" gives /doar not prayer page, mission after ask fails persuasion.

**Casey (Distracted Mobile)**: 11 cards stack vertically, CTA off-screen, no sticky anchor, loses context.

**Maria (Devout Catholic, mid-50s, WhatsApp, skeptical of digital payment)**: Labels resonate but "em breve" note nearly invisible. Might panic thinking money was charged. Wants financial transparency. "Copiar link" meaningless — shares via WhatsApp not clipboard.

## Minor Observations

- CTA outline-terracotta vs welcome's outline-olive for same action type
- Footer border-brand-muted/20 vs welcome's border-brand-primary/20
- Arrow character in "← Início" — no welcome precedent
- Missing aria-labelledby on mission and share sections
- No aria-live region for CTA/done-note state change
- No max-w-measure on body text
- Mission section lacks bg-brand-primary-light background
- xl:grid-cols-4 duplicates lg:grid-cols-4

## Questions to Consider

1. If payment gateway doesn't exist, should this page be a "coming soon" waitlist instead?
2. What about R$30 or R$75 — does rigidity of preset amounts constrain generosity?
3. Why abandon sidebar navigation — intentional or oversight?
