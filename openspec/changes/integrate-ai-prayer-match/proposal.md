## Why

The instant prayer flow selects a prayer via keyword matching (`PrayerMatcherService`), which often returns generic results. `AiService::findBestPrayMatch()` exists but is unused. An LLM-powered selection would return a more contextually relevant prayer for the user's description.

## What Changes

- Call `AiService::findBestPrayMatch()` in the `type === 'instant'` branch of `prayer-result.blade.php` before falling back to keyword matching
- Fall back to existing `PrayerMatcherService::match()` + `KeywordExtractorService::extract()` if the LLM API fails (rate limit, timeout, token exceeded)
- Add loading state with visual spinner while LLM request is in flight
- No changes to the AI prayer type (`AiService::generate()` stays as is)

## Capabilities

### New Capabilities
- `instant-prayer-llm-match`: LLM-powered instant prayer selection with keyword-based fallback and loading UI

### Modified Capabilities
- `prayer-result-page`: Instant prayer requirement changes — now tries LLM match first with fallback chain

## Impact

- `resources/views/prayer-result.blade.php` — component logic + template changes for instant prayer
- `app/Services/AiService.php` — may need error handling improvements
