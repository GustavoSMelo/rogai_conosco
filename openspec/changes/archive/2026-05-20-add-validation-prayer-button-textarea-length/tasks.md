## 1. State Management & Validation Logic

- [x] 1.1 Add helper method to validate description text length (>= 20 characters)
- [x] 1.2 Add helper method to determine button state based on validation
- [x] 1.3 Add method to show error popup with custom message

## 2. UI Implementation

- [x] 2.1 Update prayer button styling to be conditional based on validation state
- [x] 2.2 Update prayer button onPressed handler to check validation before proceeding
- [x] 2.3 Update prayer button text to include arrow: "Vamos orar pelo seu dia ->"
- [x] 2.4 Implement global error popup component/function
- [x] 2.5 Ensure button is visually disabled (gray) when validation fails
- [x] 2.6 Ensure button is enabled (primary color) when validation passes

## 3. Integration & Testing

- [x] 3.1 Verify button is gray/disabled when < 20 characters in textarea
- [x] 3.2 Verify button is primary color/enabled when >= 20 characters in textarea
- [x] 3.3 Verify error popup appears when button clicked with < 20 characters
- [x] 3.4 Verify error popup shows correct message: "voce precisa digitar ao menos 20 caracteres para avancar"
- [x] 3.5 Verify button functions normally when validation passes