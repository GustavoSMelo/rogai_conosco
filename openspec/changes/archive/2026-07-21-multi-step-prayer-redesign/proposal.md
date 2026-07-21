## Why

The current prayer modal lacks religion context and flexible prayer delivery options. Users need to specify their religious tradition and choose between AI, instant, or person-led prayers. The post-submission experience is also missing — users should land on a tailored result page with alternatives and a donation call-to-action.

## What Changes

- Remove the existing single-form prayer modal from `welcome.blade.php`
- Replace with a multi-step modal (Step 1: contact info; Step 2: prayer details)
- Add a religion selector (Catholic, Orthodox, Protestant, Muslim, etc.)
- Add prayer option selector: AI, instant (pre-written), person-only prayer, person-only Bible word, person Bible word + prayer
- Create a dedicated prayer result view (`/prayer/result`) that shows different content based on the chosen option
- Add AI prayer generation endpoint (stub for now)
- Add instant prayer library (static pre-written Catholic prayers)
- Add donation button to all result pages
- Create a new route, controller, and Livewire component for the result view

## Capabilities

### New Capabilities
- `prayer-request-modal`: Multi-step modal with contact info, religion, prayer type selection
- `prayer-result-page`: Post-submission page showing the prayer result with cross-links to other formats and donation CTA
- `prayer-ai-generation`: AI-generated prayer endpoint (stubbed, returns placeholder)
- `prayer-instant-library`: Static library of pre-written biblical/denominational prayers

### Modified Capabilities

- `<existing-name>`: <what requirement is changing>

## Impact

- `resources/views/welcome.blade.php` — replace modal HTML
- `resources/css/welcome.css` — update modal styles for new step fields
- `resources/css/app.css` — potential modal/dialog style changes
- `resources/js/welcome.ts` — update modal JS logic for new steps and fields
- New route `GET|POST /prayer/result` and controller `PrayerResultController`
- New view `resources/views/prayer/result.blade.php`
- New Livewire component or Blade component for the result page
- New service/action `GenerateAiPrayer` (stub)
- New data file `resources/data/instant-prayers.php`
