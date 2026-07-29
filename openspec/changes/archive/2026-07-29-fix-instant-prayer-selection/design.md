## Context

Current flow: welcome form submits prayer request, then redirects to `/prayer/result?type=instant&religion=catholic` — **without** the user's prayer description. The prayer-result page receives `description=''`, PrayerMatcher::match('') returns empty (needs >=3 tokens), and fallback `crc32('') % count(list)` always equals 0, selecting the first prayer in the tradition's list — "Pai Nosso" in every tradition.

The bug thus has two layers:
1. **Missing data in redirect** (welcome.blade.php line 59)
2. **Deterministic fallback to first item** when description is empty (prayer-result.blade.php line 47)

## Goals / Non-Goals

**Goals:**
- User's prayer description reaches the prayer result page
- Instant prayer selection considers the description for matching
- When description is empty (edge case), show a sensible random prayer instead of always the first

**Non-Goals:**
- No changes to PrayerMatcher scoring algorithm
- No changes to the AI prayer flow (already receives description correctly)
- No changes to the prayer data file (Prays.php)

## Decisions

1. **Pass description in redirect** — Add `'description' => $this->message` to the `redirect()` call in `welcome.blade.php`. Minimal change, the route already accepts the param.

2. **Improve fallback to random prayer** — Change the fallback in `prayer-result.blade.php` from `crc32($description) % count` to `array_rand()` when description is empty/blank. When description has content but below 3 tokens, keep deterministic behavior per the existing spec.

3. **Keep fallback deterministic for short descriptions** — For cases where description has 1-2 tokens but is non-empty, keep crc32-based deterministic selection so the same short description always returns the same prayer (per existing spec requirement). Only switch to random when description is truly empty.

## Risks / Trade-offs

- Random fallback means the same empty-description request may show different prayers on different visits
  → Mitigation: acceptable trade-off — empty description is already an edge case; the randomness is a UX improvement over always showing "Pai Nosso"
- Adding description to URL query params may expose prayer content in browser history
  → Mitigation: description is already visible in the form data sent; no new risk introduced
