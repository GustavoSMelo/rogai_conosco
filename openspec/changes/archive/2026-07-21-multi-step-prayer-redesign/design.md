## Context

The current welcome page has a two-step modal (name/delivery then message/submit) with limited delivery options. The backend stores prayer requests but does not differentiate by prayer type or religion. There is no post-submission flow — after form submission the user sees a success message in the modal. No AI generation, instant prayer library, or person-led prayer routing exists.

## Goals / Non-Goals

**Goals:**
- Replace the existing modal with a new multi-step flow
- Step 1 captures name (optional), WhatsApp, email
- Step 2 captures prayer description, religion, and prayer type
- Route to a dedicated result page based on prayer type
- Show AI-generated prayer, instant prayer, or a thank-you message accordingly
- Cross-link between prayer types (AI ↔ instant) on result page
- Donation CTA on all result pages

**Non-Goals:**
- Real AI integration (stubbed initially)
- User accounts or history
- Audio/video recording in this change
- Email/WhatsApp delivery in this change

## Decisions

- **New route `/prayer/result`**: A dedicated GET route with query params (`?type=ai|instant|person` and `?religion=catholic|...`) to display the result. No need to store the prayer in a session — the form POSTs to a controller that validates and redirects to the result page with params.
- **Prayer types map to result behaviors**: `ai` → renders AI prayer text (stub), `instant` → renders pre-written prayer from library, `person` → renders thank-you with 48h message. All three show cross-links and donation button.
- **Religion as free-text or dropdown**: Use a `<select>` with common options (Catholic, Orthodox, Protestant, Muslim, Jewish, Buddhist, Hindu, Other) plus an optional custom text input.
- **Instant prayer library as static PHP array**: `resources/data/instant-prayers.php` returns an associative array keyed by religion, each containing an array of prayer texts. This avoids a database table for now.
- **No Livewire for result page**: Simpler to use a plain Blade view with a dedicated controller. The result page is read-only — no interactivity beyond navigation links.
- **Modal stays in `welcome.blade.php`** but with replaced content. Step animations remain.
- **Step transition animation**: When navigating between steps, the entering step first gets `.welcome-modal-step-enter` (opacity-0, -translate-y-3), then after `requestAnimationFrame` it gets `.welcome-modal-step-enter-active` (opacity-100, translate-y-0). The `transition-all duration-300 ease-out` on `.welcome-modal-step` animates the change. The leaving step gets `.welcome-modal-step-leave` (opacity-0, -translate-y-3) simultaneously.
- **Step indicator**: A row of two numbered circles (❶ ❷) centered above the form, with "Passo 1 de 2" / "Passo 2 de 2" text. The active step's circle is filled (bg-brand-accent), the inactive is outlined. Updates on every `goToStep()` call.
- **Step title labels**: Each step has a heading inside the step container — "Seus dados" above step 1 fields, "Seu pedido" above step 2 fields.
- **WhatsApp input mask**: IMask.js (`npm i imask`) with mask pattern `+{55} (00) 00000-0000`. Proper cursor handling — user can freely edit or delete any character. Imported and initialized in `welcome.ts`. Mask must be fully filled (all 11 digits) before "Continuar" is allowed.
- **Email validation**: Custom validation via `input` event listener that checks the email format and shows inline error. Blocks "Continuar" if invalid. No external library.
- **Textarea resize**: CSS `resize: none` on the prayer description textarea to maintain layout consistency.
- **Step 1 required fields**: Only `name` is optional. WhatsApp and email must both be non-empty and valid before "Continuar" is enabled. Error messages shown inline below the invalid field.
- **Name/Email max length**: HTML `maxlength` attribute on inputs — 100 for name, 255 for email. Prevents overflow without JS.
- **Step 2 description required**: Submit button disabled via JS when textarea is empty; inline error shown on attempt.

## Risks / Trade-offs

- [Stubbed AI] → Users clicking "AI prayer" will see placeholder text. Mitigation: document as stub in tasks, add a clear label.
- [Query params in URL] → Users can bookmark/share result URLs. Acceptable for MVP; can move to session if needed later.
- [Static prayer library] → Limited content initially. Easy to expand.
