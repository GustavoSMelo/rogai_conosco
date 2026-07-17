## ADDED Requirements

### Requirement: DOMContentLoaded initialization
The extracted JS module SHALL execute all initialization logic inside a `DOMContentLoaded` event listener, preserving the original behavior.

#### Scenario: Script initializes on page load
- **WHEN** the page finishes loading
- **THEN** the splash screen, navigation, modal, form, and scroll-spy logic are all initialized

### Requirement: Splash screen lifecycle
The module SHALL manage the splash screen: show on load, hide after 800ms with animation, and reveal the page content.

#### Scenario: Splash hides after timeout
- **WHEN** 800ms elapse after page load
- **THEN** the splash element receives the `splash-hide` class
- **THEN** after 400ms the splash is hidden (`display: none`)
- **THEN** the page receives the `page-show` class

### Requirement: Mobile navigation toggle
The module SHALL handle open/close of the mobile side navigation, overlay click-to-close, Escape key, and nav-link click-to-close.

#### Scenario: Menu button opens nav
- **WHEN** user clicks the menu button
- **THEN** the side nav and overlay receive the `open` class
- **THEN** `aria-expanded` is set to `true`
- **THEN** body overflow is set to `hidden`

#### Scenario: Close button closes nav
- **WHEN** user clicks the close button in the side nav
- **THEN** the `open` class is removed from side nav and overlay

#### Scenario: Overlay click closes nav
- **WHEN** user clicks the overlay backdrop
- **THEN** the side nav closes

#### Scenario: Escape key closes nav
- **WHEN** user presses the Escape key while the nav is open
- **THEN** the side nav closes

### Requirement: Delivery method toggles contact fields
The module SHALL show/hide the email and WhatsApp contact fields when the delivery select changes to/from "recorded".

#### Scenario: Selecting recorded delivery shows contact fields
- **WHEN** the delivery select value changes to "recorded"
- **THEN** the contact fields container removes the `hidden` class

#### Scenario: Selecting non-recorded delivery hides contact fields
- **WHEN** the delivery select value changes to "instant" or "ai"
- **THEN** the contact fields container receives the `hidden` class

### Requirement: Modal backdrop click closes
The module SHALL close the prayer modal when the user clicks outside the `.modal-content` area.

#### Scenario: Click outside modal content closes it
- **WHEN** user clicks on the backdrop area of the open modal
- **THEN** the modal is closed

### Requirement: Modal body scroll lock
The module SHALL lock body scroll when the modal opens and restore it when the modal closes.

#### Scenario: Modal open locks scroll
- **WHEN** the modal opens
- **THEN** `document.body.style.overflow` is set to `"hidden"`

#### Scenario: Modal close restores scroll
- **WHEN** the modal closes
- **THEN** `document.body.style.overflow` is set to `""`

### Requirement: Scroll-based reveal animations
The module SHALL use IntersectionObserver to add the `visible` class to `.reveal` elements when they enter the viewport.

#### Scenario: Reveal element becomes visible on scroll
- **WHEN** a `.reveal` element scrolls into the viewport (threshold 0.08, rootMargin -40px)
- **THEN** the element receives the `visible` class
- **THEN** the observer stops observing that element

### Requirement: Form submission disables button
The module SHALL disable the submit button and show a spinner when the prayer form is submitted.

#### Scenario: Form submit disables button
- **WHEN** the prayer form is submitted
- **THEN** the submit button is disabled
- **THEN** the submit text is hidden
- **THEN** the spinner is shown

### Requirement: Character count updates on input
The module SHALL update the character count display as the user types in the message textarea.

#### Scenario: Typing updates character count
- **WHEN** user types in the message textarea
- **THEN** the char count element updates to show the current length

### Requirement: Scroll spy for sidebar navigation
The module SHALL highlight the current section link in the sidebar based on scroll position using IntersectionObserver.

#### Scenario: Section in view highlights nav link
- **WHEN** a section enters the viewport (threshold 0.2, rootMargin -80px 0px -40% 0px)
- **THEN** the corresponding sidebar link receives the `nav-link-active` class
- **THEN** other sidebar links lose the `nav-link-active` class
