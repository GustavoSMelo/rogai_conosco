## Context

Current `type === 'instant'` branch calls `PrayerMatcherService::match()` for keyword-based prayer matching. `AiService::findBestPrayMatch()` makes an OpenRouter API call but is unused. The `mount()` method is fully synchronous — no loading state exists.

## Goals / Non-Goals

**Goals:**
- Instant prayer type calls LLM via `findBestPrayMatch` first to select the best prayer
- Fall back to `PrayerMatcherService` + `KeywordExtractorService` if LLM fails
- Show loading spinner while LLM request is in flight
- Use Livewire's `wire:init` for async initialization

**Non-Goals:**
- No changes to AI prayer flow (stays with `AiService::generate()` hardcoded template)
- No new API routes or endpoints
- No database schema changes

## Decisions

1. **Async initialization via `wire:init`** — Mount sets `$loading = true`, render shows spinner. `wire:init="$wire.loadInstantPrayer()"` triggers the async call. This avoids blocking initial page render on the external API.

2. **Fallback chain** — `loadInstantPrayer()` calls `AiService::findBestPrayMatch()`. If it returns null or throws, silently fall back to `PrayerMatcherService::match()` + `KeywordExtractorService::extract()`.

3. **Loading state** — Add `$loadingInstant` boolean property. When true, render a centered spinner (Tailwind animate-spin). Respect `prefers-reduced-motion`.

4. **Error transparency** — No error message shown to user on LLM failure. The fallback prayer is seamless — user sees a valid prayer either way.

## Risks / Trade-offs

- [LLM API latency] External API call may take 2-10s → Mitigated by loading spinner + async init (page renders instantly, spinner shows during API call)
- [LLM API cost/failure] Token limits, rate limits, outages → Fallback to keyword matcher is silent and identical in UX
- [wire:init complexity] Adds lifecycle complexity → Simple approach: mount sets loading, wire:init triggers loadInstantPrayer
