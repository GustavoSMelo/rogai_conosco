## Context

The DescribePage currently allows users to select a mood and enter a description in a textarea. The prayer button at the bottom is always enabled and styled with the primary app color regardless of whether the user has entered sufficient text. Users can click the button without providing meaningful input, which leads to low-quality prayer requests.

## Goals / Non-Goals

**Goals:**
- Prevent users from proceeding with insufficient description (<20 characters)
- Provide clear visual feedback when input is insufficient (grayed-out button)
- Show a clear error message when users attempt to proceed with insufficient text
- Create a reusable error popup component for potential use elsewhere in the app
- Maintain existing app styling and patterns

**Non-Goals:**
- Persisting form data beyond the current session
- Implementing complex validation rules beyond minimum character count
- Changing the fundamental navigation flow of the app
- Adding success states or confirmation dialogs

## Decisions

### Validation Approach
**Decision:** Use the existing `descriptionText` state to track character count and determine button state
**Rationale:** We already have state tracking the textarea content. Adding validation logic based on this state is straightforward and efficient.

### Button State Management
**Decision:** Dynamically change button appearance based on validation state:
- Enabled with primary color when >= 20 characters
- Disabled/grayed out when < 20 characters
**Rationale:** This provides immediate visual feedback to users about whether they can proceed, reducing frustration from clicking an inactive button.

### Error Popup Implementation
**Decision:** Create a reusable global error popup component using Flutter's showDialog or similar approach
**Rationale:** A popup ensures the error message is noticeable and requires user acknowledgment before continuing. Making it reusable follows DRY principles.

### Character Count Threshold
**Decision:** Use 20 characters as the minimum threshold as specified in the requirements
**Rationale:** This provides a reasonable balance between ensuring meaningful input and not being overly burdensome for users.

### Text Update
**Decision:** Update button text to include the arrow ("Vamos orar pelo seu dia ->") to match previous implementation
**Rationale:** Maintains consistency with previously implemented features.

## Risks / Trade-offs

[User Frustration] → Mitigation: Clear visual feedback (grayed button) prevents futile clicks; clear error message explains why action is blocked

[Component Complexity] → Mitigation: Keeping error popup simple and focused on single responsibility

[Inconsistent UX] → Mitigation: Following existing app patterns for styling and behavior

## Open Questions

- Should the error popup have a specific title or just the message?
- Should there be a way to dismiss the error popup other than tapping outside or on a button?
- Should we provide character count feedback (e.g., "15/20 characters") to help users know how close they are to the limit?