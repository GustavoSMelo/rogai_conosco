# KeywordExtractor

Extract known prayer tags from free-text input using the tag vocabulary in `Prays.php`.

## Behavior

- Receives a text string and returns array of known tags found within it
- Matches multi-word tags as phrases (e.g., "paz interior" matches only when both words appear together)
- Matches single-word tags as isolated tokens
- Case-insensitive matching
- Sorts results: multi-word matches first (descending length), then single-word (alphabetical)
- Returns empty array when no known tags match
- Returns empty array for empty/null-like input

## Constructor

- `__construct(?array $tags = null)` — accepts optional custom tag list; defaults to loading all tags from `Prays::getPrays()`

## Methods

### `extract(string $text): array`

Returns matching tags from the known vocabulary.

### `getKnownTags(): array`

Returns the full list of known tags (for introspection / testing).

## Edge Cases

- Empty string → `[]`
- Text with only stop words → `[]`
- Text with single-word tag match → returns `['tag']`
- Text with multi-word tag match → returns `['multi word tag']`
- Partial multi-word match (e.g., "paz" without "interior") → NOT matched as "paz interior", but "paz" as single-word tag if it exists
- Accented characters handled via mb_* functions
- No false positives from substring matches
