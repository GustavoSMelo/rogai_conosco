## Why

Enable keyword-based search over prayers by adding a `tags` index to each prayer entry. Currently prayers have `title`, `category`, `subcategory`, and `body` but no machine-readable tags for scoring relevance across arbitrary keywords.

## What Changes

- Add `tags` array of strings to every prayer entry in `resources/data/Prays.php`
- Tags are derived from the prayer's `body` text — key nouns, themes, concepts, and people mentioned
- Update `Prays` class with a `getTags()` method (or compute tags inline)  
- Update tests to verify tag structure and coverage
- Tags support keyword scoring pipeline (future use)

## Capabilities

### New Capabilities
- `prayer-tags`: Add keyword tags to each prayer entry for scoring/relevance matching

### Modified Capabilities

None — this is a new data enrichment.

## Impact

- `resources/data/Prays.php` — every prayer entry gets a new `tags` key
- `app/Data/Prays.php` — class may gain a helper method
- `tests/Unit/PraysDataTest.php` — new assertions for tag structure
