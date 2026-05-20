## Why

The current prayer button in DescribePage allows users to proceed regardless of how much they've typed in the description textarea. This can lead to users submitting insufficient descriptions for prayer requests. Adding validation ensures users provide meaningful input (minimum 20 characters) before proceeding, improving the quality of prayer requests and user engagement.

## What Changes

- Add character count validation to the prayer button (disable/gray when <20 characters)
- Implement error popup mechanism that shows when button is clicked with insufficient text
- Create reusable global error popup component
- Add visual feedback (button styling) based on validation state
- Update button text to include arrow as previously implemented ("Vamos orar pelo seu dia ->")

## Capabilities

### New Capabilities
- `textarea-validation`: Validates minimum character count in description textarea
- `global-error-popup`: Reusable component for displaying error messages globally
- `button-state-management`: Controls button appearance and behavior based on form validity

### Modified Capabilities
- None (no existing specs to modify)

## Impact

- lib/describe.dart: Will be modified to add validation logic, button state management, and error handling
- Will need to create a global error popup component (location to be determined)
- No breaking changes as this enhances existing functionality
- No dependencies affected