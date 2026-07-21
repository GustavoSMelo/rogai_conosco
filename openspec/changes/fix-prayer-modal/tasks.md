## 1. Fix CSS for Contact Fields Visibility

- [x] 1.1 Remove `@apply hidden` from `.welcome-contact-fields` in `welcome.css`
- [x] 1.2 Add `.welcome-step-content` transition and two-step modal animation styles

## 2. Fix Select Dropdown Closing Modal

- [x] 2.1 Add `mousedown` event listener with `stopPropagation()` on the delivery `<select>` element in `welcome.ts`

## 3. Make Name Field Required

- [x] 3.1 Add `required` attribute to the name input in `welcome.blade.php`
- [x] 3.2 Replace "(opcional)" label text with appropriate text for required field

## 4. Refactor Modal to Two Steps

- [x] 4.1 Split modal content into step 1 (name, delivery, contact) and step 2 (message, submit) in Blade
- [x] 4.2 Add step navigation JS in `welcome.ts` (Continuar/Voltar handlers, show/hide logic)
- [x] 4.3 Add step transition CSS animations (fade-up between steps)
- [x] 4.4 Add "Continuar" button to step 1 and "Voltar" button to step 2

## 5. Verify

- [x] 5.1 Run `vite build` to confirm compilation
- [x] 5.2 Run `php artisan test` to confirm tests pass
