## Why

Current prayer tags use snake_case keywords (`"perdao"`, `"virgem_maria"`). Users describe their day in natural, informal language — not keyword lists. To match real user input, tags must be natural phrases people actually say, paired with a scoring engine that ranks words from daily text and finds the best-matching prayer.

## What Changes

- Rewrite prayer tags from snake_case keywords to a mix of single keywords and natural/conversational phrases (e.g., `"perdao"`, `"luto"`, `"beijei hoje"`, `"primeira vez"`, `"conversando com Maria"`)
- Build a word-ranking/scoring engine that accepts informal daily text, scores words by relevance, and ranks prayers by tag match
- Replace `prayer-tags` spec: tags are now natural language phrases, snake_case constraint removed
- Update `prayer-tags` main spec with new requirements for tag format and matching behavior

## Capabilities

### New Capabilities
- `conversational-matching`: Accept user's informal daily text, tokenize/rank words, score each prayer's tags against ranked words, return best-match prayer

### Modified Capabilities
- `prayer-tags`: Tags change from snake_case keywords to natural/conversational phrases; add matching/scoring contract

## Impact

- `resources/data/Prays.php` — all tags rewritten as mix of single keywords and natural language phrases
- `app/Services/PrayerMatcher.php` — new service for word ranking and prayer scoring
- `app/Data/Prays.php` — optional helper for tag access
- `tests/Unit/PrayerMatcherTest.php` — matching engine tests
- `tests/Unit/PrayersDataTest.php` — updated tag format tests
