## Why

When a user submits a prayer request with type "instant" (Oração instantânea), the prayer "Pai Nosso" is always returned regardless of the prayer description they entered. The welcome form redirects to the prayer result page without passing the user's message, and the fallback logic always picks the first prayer in the list.

## What Changes

- Pass `message` as `description` query param in the redirect from welcome form to prayer result page
- Improve fallback behavior in prayer-result when description is empty: instead of deterministic crc32(0) always selecting the first prayer, show a random prayer or a curated default selection
- No breaking changes

## Capabilities

### New Capabilities
- `instant-prayer-selection`: prayer description from the welcome form is carried through to the prayer result page and used to match an appropriate instant prayer

### Modified Capabilities

None.

## Impact

- `resources/views/welcome.blade.php` — redirect query params
- `resources/views/prayer-result.blade.php` — fallback logic for empty description
