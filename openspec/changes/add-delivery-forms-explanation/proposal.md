## Why

The "Como sua oração chega até você" section on the welcome page explains the three delivery forms (recorded, instant, AI), but the recorded option ("Oração gravada") hides three distinct sub-options that the user can select in the prayer modal: **pray only** (a person prays for you), **word only** (a Bible verse is searched for your situation), and **pray + word** (both combined in a single audio/video). Visitors cannot understand the difference before submitting, causing confusion and wrong choices.

## What Changes

- Add a new section on `resources/views/welcome.blade.php` explaining the three recorded-prayer sub-options, placed after the "Como sua oração chega até você" section
- Explain in plain Portuguese: **Apenas oração** (a real person prays for you), **Apenas palavra** (a perfect Bible verse for your situation is found and delivered), **Oração + palavra** (both in a single audio/video)
- Reuse the existing visual language (welcome cards, chips, brand colors) and `reveal` animations
- No backend or modal changes — informational UI only

## Capabilities

### New Capabilities
- `welcome-delivery-options`: Explains the three recorded-delivery sub-options (pray only, word only, pray + word) on the welcome page so users understand the difference before submitting a prayer request

### Modified Capabilities
<!-- No existing spec-level behavior changes -->

## Impact

- `resources/views/welcome.blade.php` — new informational section
- `resources/css/welcome.css` — any new styles needed for the section (following the `@apply` convention)
- No changes to routes, controllers, models, or the prayer modal