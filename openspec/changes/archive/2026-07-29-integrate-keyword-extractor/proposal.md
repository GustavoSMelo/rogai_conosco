## Why

The `KeywordExtractor` can detect which prayer tags appear in a user's free-text input, but this information is never shown to the user. Surfacing detected keywords provides transparency about how prayer matching works and helps users understand what themes were recognized in their text.

## What Changes

- Integrate `KeywordExtractor::extract()` into the prayer matcher Volt component
- Display extracted keywords/tags as visual chips above or alongside matched prayer results
- **No changes** to matching algorithm or prayer data — this is a frontend transparency feature

## Capabilities

### New Capabilities

None. This is an integration change within the existing `prayer-matcher` Volt component.

### Modified Capabilities

None. No spec-level behavior changes.

## Impact

- `resources/views/livewire/prayer-matcher.blade.php` — integrate KeywordExtractor, display extracted tags
