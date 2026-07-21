## Context

The prayer modal is a single-page `<dialog>` with all fields visible at once. Three bugs exist: (1) the `<select>` dropdown click bubbles to the dialog's click-outside handler, closing the modal; (2) `.welcome-contact-fields` CSS uses `@apply hidden` in the base rule, so the `.hidden` class toggle cannot override it; (3) the name field says "(opcional)" but should be required. uses the skill /impeccable to help with fix and craft

## Goals / Non-Goals

**Goals:**
- Fix `<select>` closing the modal by stopping event propagation on the `<select>` element's mousedown/click
- Fix contact fields visibility by removing `@apply hidden` from `.welcome-contact-fields` and relying on the `.hidden` class
- Make name field required (add `required`, remove "(opcional)", update label text)
- Refactor into two steps: Step 1 (name, delivery preference, contact info), Step 2 (prayer message, submit)

**Non-Goals:**
- No changes to server-side form handling or validation
- No styling redesign — only functional fixes and step navigation
- No changes to the success message display

## Decisions

1. **Two-step with CSS show/hide, not separate dialogs** — Keep a single `<dialog>` and single `<form>`. Use CSS classes to toggle between step 1 and step 2 content. This avoids duplicating the dialog shell, form element, and event bindings.

2. **Fix select by capturing mousedown on the `<select>` element** — The native `<select>` dropdown fires events outside the modal content area. Adding a `mousedown` listener with `stopPropagation()` on the `<select>` element prevents the dialog's click handler from receiving the event.

3. **Contact fields fix** — Remove `@apply hidden` from `.welcome-contact-fields` CSS rule. Keep the class-based toggle via `.hidden` class in the JS. The HTML starts with the `hidden` class already present.

4. **Step transitions** — Use smooth fade/slide between steps with CSS transitions. Step 2 content starts hidden via a `.step-2-hidden` class. A "Continuar" button advances to step 2; a "Voltar" button returns to step 1.

5. **Form submission only on step 2** — The submit button lives in step 2. Step 1 has "Continuar" which validates the required name field before advancing.

## Risks / Trade-offs

- **[Low risk]** Two-step modal may confuse users expecting a single form. Mitigation: clear visual step indicator and explicit "Voltar" button.
- **[Low risk]** The `<select>` fix with `stopPropagation` could mask legitimate click events. Mitigation: only intercept `mousedown` on the `<select>` element, not on its parent.
