## Why

The prayer request modal has three bugs: (1) clicking on the `<select>` delivery dropdown closes the modal because the click-outside handler fires when option list extends beyond `.modal-content`; (2) the email/WhatsApp contact fields never show because `.welcome-contact-fields` has `display: none` baked into its base CSS rule, so toggling the `.hidden` class has no effect; (3) the name field shows "(opcional)" but should be required — the server expects a name.

## What Changes

- Fix modal click-outside handler to ignore clicks on `<select>` element dropdowns (stop propagation on `<select>` change events)
- Fix contact fields visibility by removing `@apply hidden` from `.welcome-contact-fields` base rule and relying on the `.hidden` class toggle instead
- Make name field required — add `required` attribute, remove "(opcional)" hint, update label
- Refactor modal into two steps: Step 1 collects name, delivery preference, and contact info (email/WhatsApp shown conditionally); Step 2 collects the prayer message

## Capabilities

### New Capabilities
- `fix-prayer-modal`: Fix select-closes-modal bug, fix contact fields visibility, make name required, refactor to two-step modal with sliding transition

### Modified Capabilities
- None

## Impact

- `resources/views/welcome.blade.php` — modal section rewritten with two-step layout
- `resources/js/welcome.ts` — update modal click handler, add step navigation logic
- `resources/css/welcome.css` — update `.welcome-contact-fields` rule, add step transition styles
