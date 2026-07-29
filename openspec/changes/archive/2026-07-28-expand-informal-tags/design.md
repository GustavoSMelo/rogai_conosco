## Context

Prayer tags currently mix informal keywords with religious-specific terms ("salve rainha", "sao_jorge", "virgem maria"). For matching against user's daily conversational text, all tags must sound like everyday speech. More tags per prayer (~12) also increases chance of match.

## Goals / Non-Goals

**Goals:**
- Remove all religious-specific terms from tags (saint names, prayer titles, latin titles)
- Expand each prayer to ~12 tags
- All tags must be purely informal/conversational Portuguese
- Update minimum tag assertion in tests from 3 to 10

**Non-Goals:**
- No changes to matching algorithm or PrayerMatcher service
- No changes to prayer body text or other fields
- No new data structures

## Decisions

1. **Tag curation approach** — Tags are hand-curated per prayer, derived from body themes but expressed in everyday language. Examples: "pedindo perdao", "me sentindo fraco", "preciso de ajuda", "gratidao". No saint names, no prayer titles, no latin.

2. **Tag count target** — ~12 tags per prayer, minimum 10. More tags = better coverage for varied user input. The matching algorithm already handles variable tag counts gracefully.

3. **Existing test updates** — `test_tags_are_non_empty_strings` minimum changes from `>= 3` to `>= 10`. `test_known_prayer_has_expected_tags` updated with purely informal expected tags.

## Risks / Trade-offs

- [Tag volume] Manually writing ~12 tags × 100+ prayers is significant effort. Mitigation: batch by theme, reuse patterns across similar prayers.
- [Loss of specificity] Removing religious terms may reduce match precision for users seeking specific devotional content. Mitigation: the conversational matching use case prioritizes broad emotional/situational matching.
