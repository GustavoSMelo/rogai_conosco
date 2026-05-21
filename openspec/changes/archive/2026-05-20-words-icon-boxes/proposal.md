## Why

The Words view currently only has a title and no content cards. It needs icon-based content boxes to visually present word categories (love, faith, hope) with associated descriptions and Bible verse references, making the view informative and visually engaging.

## What Changes

- Add 3 styled content boxes to the Words view with box shadow and border radius
- Each box has a left-side Material UI icon (heart, cross, star) and right-side content area
- Right side contains a 2-line lorem ipsum description, a Bible verse reference in the accent color, and the verse transcription below it

## Capabilities

### New Capabilities
- `words-content-boxes`: Three icon-based content cards with descriptions and Bible verse references in the Words view

### Modified Capabilities

## Impact

- `lib/words.dart` - major UI update to add the 3 content boxes
