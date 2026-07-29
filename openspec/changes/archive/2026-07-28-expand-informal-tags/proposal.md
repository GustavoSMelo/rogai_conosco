## Why

Current tags mix religious-specific terms ("salve rainha", "virgem maria", "sao_jorge") with informal conversation. For matching against daily user text, all tags should be purely informal/natural — how people actually speak. More tags per prayer (~12) also improves match coverage.

## What Changes

- Remove all religious-specific terms from prayer tags (saint names, specific prayers, latin titles)
- Expand each prayer to ~12 tags from current ~5
- All tags must sound like something a person would say in casual conversation
- **BREAKING**: Existing tags will be replaced — tests and data must be updated

## Capabilities

### New Capabilities

- `tag-expansion`: Increase tag count per prayer to ~12 and ensure all tags are purely informal/natural language

### Modified Capabilities

- `prayer-tags`: Tags shift from mix of keywords+phrases to purely informal/conversational text; minimum tag count increases from 3 to 10

## Impact

- `resources/data/Prays.php` — every prayer's tags array rewritten (more tags, no religious-specific terms)
- `tests/Unit/PrayersDataTest.php` — update `test_tags_are_non_empty_strings` minimum from 3 to 10; update `test_known_prayer_has_expected_tags` with new informal tags
- `tests/Unit/PrayerMatcherTest.php` — update `test_score_calculation` scenario if needed
