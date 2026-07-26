## 1. Instant Prayer Library

- [x] 1.1 Create `resources/data/prays.php` with prayers keyed by religion (Catholic, Orthodox, Protestant, Muslim), each with title and body
- [x] 1.2 Add generic/Christian (psalms) fallback prayers for unknown religions

## 2. AI Prayer Action

- [x] 2.1 Create `app/Actions/GenerateAiPrayer.php` with a `generate(string $description, string $religion): string` method returning placeholder text

## 3. Prayer Result Page

- [x] 3.1 Create `app/Http/Controllers/PrayerResultController.php` with `__invoke(Request $request)` that reads `type` and `religion` query params
- [x] 3.2 Create `resources/views/prayer/result.blade.php` with conditional sections for AI, instant, and person prayer types
- [x] 3.3 Add cross-links: AI result shows "Pedir oração instantânea" button, instant result shows "Pedir oração por IA" button, person result shows both
- [x] 3.4 Add donation CTA button ("Apoie esta missão") to all result variants
- [x] 3.5 Add route `GET /prayer/result` to `routes/web.php` pointing to `PrayerResultController`

## 4. Update Prayer Request Form Submission

- [x] 4.1 Update `PrayerRequestController@store` to accept new fields: `religion`, `prayer_type`, `whatsapp` (already exists), `email` (already exists)
- [x] 4.2 Change submit action to redirect to `/prayer/result?type={prayer_type}&religion={religion}` instead of back to welcome page
- [x] 4.3 Remove old `delivery` field validation, add `prayer_type` validation (`in:ai,instant,person-prayer,person-bible,person-bible-prayer`)

## 5. Replace Modal in Welcome Page

- [x] 5.1 Remove existing modal HTML (lines 450–603) from `welcome.blade.php`
- [x] 5.2 Add new modal with step 1: name (optional, no required attribute), WhatsApp, email
- [x] 5.3 Add step 2: prayer description textarea, religion select (Catholic, Orthodox, Protestant, Muslim, Jewish, Buddhist, Hindu, Other), prayer type select (IA, Instantânea, Apenas oração (pessoa), Apenas palavra bíblica (pessoa), Palavra bíblica + oração (pessoa))
- [x] 5.4 Add step navigation (Continuar/Voltar) with fade-up animation
- [x] 5.5 Remove `.welcome-contact-fields` visibility toggle (no longer needed — contact fields are always visible in step 1)
- [x] 5.6 Remove the old delivery-related CSS classes and JS logic if unused

## 6. Update JavaScript

- [x] 6.1 Update `welcome.ts` step navigation to work with new field IDs
- [x] 6.2 Remove delivery select change handler (contact fields show on step 1 always now)
- [x] 6.3 Ensure `goToStep(1)` is called on modal open/close (already exists)

## 7. Verify

- [x] 7.1 Run `vite build` to confirm TypeScript and CSS compilation
- [x] 7.2 Run `php artisan test` to confirm tests pass
- [x] 7.3 Test modal flow manually: open, fill step 1, advance to step 2, submit, confirm redirect to result page

## 8. Fix Step Animation and Add Step Indicator

- [x] 8.1 Fix `goToStep()` in `welcome.ts` to apply `welcome-modal-step-enter-active` via `requestAnimationFrame` after adding `welcome-modal-step-enter`, so step 2 actually fades in
- [x] 8.2 Add step indicator HTML to modal in `welcome.blade.php`: two numbered circles with "Passo 1 de 2" text, active/inactive styling
- [x] 8.3 Add step title labels inside each step container: "Seus dados" for step 1, "Seu pedido" for step 2
- [x] 8.4 Add CSS for step indicator in `welcome.css` (numbered circles, active state, spacing)
- [x] 8.5 Update `goToStep()` to also update the step indicator active state on every navigation
- [x] 8.6 Verify with `vite build` and manual test that both steps are visible and animate correctly

## 9. Fix Continue Button (Missing Name Display Element)

- [x] 9.1 Add `step-2-name-display` span back to step 2 HTML in `welcome.blade.php` inside an info box showing "Oração para: <name>"
- [x] 9.2 Verify with `vite build` and manual test that clicking "Continuar" advances to step 2

## 10. Input Mask and Textarea Resize Fixes
- [x] 10.1 Implement WhatsApp input mask in vanilla JS formatting digits as `+55 (XX) XXXXX-XXXX` in `welcome.ts`
- [x] 10.2 Add `resize: none` to textarea CSS in `welcome.css`
- [x] 10.3 Implement email mask
- [x] 10.4 Verify with `vite build` and manual test

## 11. Fix Mask, Validation, and Step Navigation

- [x] 11.1 Fix WhatsApp mask format to `+55 (xx) xxxxx-xx` and allow deleting DDD digits
- [x] 11.2 Fix email validation to properly block invalid formats
- [x] 11.3 Add step 1 validation: require WhatsApp and email before enabling "Continuar"
- [x] 11.4 Verify with `vite build` and manual test

## 12. Replace WhatsApp Mask with IMask

- [x] 12.1 Install IMask: `npm i imask`
- [x] 12.2 Import IMask in `welcome.ts` and apply mask `+{55} (00) 00000-0000`
- [x] 12.3 Remove previous vanilla mask and validation for WhatsApp digits
- [x] 12.4 Verify with `vite build` and manual test

## 13. Fix Modal Closing on Select Interaction

- [x] 13.1 Change modal click guard from `target.tagName === 'SELECT'` to `target.closest('select')`
- [x] 13.2 Verify with `vite build` and manual test

## 14. Max Length and Description Validation

- [x] 14.1 Add `maxlength="100"` to name input, `maxlength="255"` to email input in Blade
- [x] 14.2 Block form submit in step 2 if prayer description is empty, show inline error
- [x] 14.3 Verify with `vite build` and manual test

## 15. Require Full WhatsApp Mask

- [x] 15.1 Change WhatsApp validation from `length < 4` to require complete IMask mask (all 11 digits)
- [x] 15.2 Verify with `vite build` and manual test
