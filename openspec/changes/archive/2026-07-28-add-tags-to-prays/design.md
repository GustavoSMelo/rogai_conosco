## Context

Prayers in `Prays.php` have `title`, `category`, `subcategory`, and `body` fields. No machine-readable keyword index exists for relevance scoring. The `tags` array will store extracted keywords from each prayer's `body` for future matching against user queries.

## Goals / Non-Goals

**Goals:**
- Add a `tags` array of strings to every prayer entry (catholic + protestant)
- Tags represent key concepts, nouns, themes, and named entities from the `body` text
- Update `Prays` class public API to expose tags
- Update tests to validate tag structure, non-emptiness, and relevance

**Non-Goals:**
- Do not implement the scoring/matching engine — that is future work
- Do not automate tag extraction via NLP — tags are hand-curated per prayer
- Do not modify existing fields (`title`, `category`, `subcategory`, `body`)

## Decisions

1. **Inline static tags vs. computed method** — Tags are static data, so they live as a literal `tags` array in the prayer array structure. No separate method needed since `getPrays()` already returns the full structure.

2. **Tag derivation** — Tags are hand-curated per prayer by extracting key themes (e.g., `"perdao"`, `"virgem_maria"`, `"fe"`, `"abandono"`), not NER/AI. This ensures consistency and avoids runtime cost.

3. **Existing `subcategory` vs. new `tags`** — `subcategory` holds liturgical categories. `tags` holds free-form keywords for scoring. They serve different purposes; both coexist.

## Risks / Trade-offs

- [Manual curation] Hand-writing 100+ prayer tags is labor-intensive but ensures quality. Mitigation: batch similar prayers together.
- [Tag drift] Tags may become stale if body is updated. Mitigation: tag review as part of prayer edits (document in spec).
