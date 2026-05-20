## Context

The DescribePage currently allows users to select from three mood options (happy, neutral, saddiest) through tappable images. After selection, there's no mechanism for users to elaborate on their feelings or take further action. The app uses a consistent color scheme derived from seedColor: Color.fromRGBO(188, 126, 75, 1) as seen in main.dart.

## Goals / Non-Goals

**Goals:**
- Allow users to describe their day after selecting a mood
- Provide a clear call-to-action for prayer initiation
- Maintain visual consistency with existing app design
- Keep implementation simple and focused
- Add a subtitle on top of the textarea that appears when a mood is selected and describe the selected mood like "O seu dia foi bom", "O seu dia foi mais ou menos", "O seu dia foi ruim, sinto muito"

**Non-Goals:**
- Persisting the description beyond the current session
- Adding complex validation or formatting to the textarea
- Navigating to a new screen when the prayer button is pressed
- Implementing actual prayer functionality (beyond navigation)

## Decisions

### Textarea Visibility Control
**Decision:** Use the existing `selectedHumor` state to control textarea visibility
**Rationale:** We already have state tracking whether a mood is selected. Adding another boolean would be redundant. The textarea should only appear when selectedHumor is not empty, which perfectly matches our requirement.

### State Management for Textarea Content
**Decision:** Add a new String variable `descriptionText` to track textarea content
**Rationale:** We need to store what the user types. A simple String variable with setState updates is sufficient for this use case.

### Button Styling Approach
**Decision:** Use TextButton with style matching the primary button from main.dart
**Rationale:** The "Avancar" button in main.dart uses TextButton with backgroundColor: Color.fromRGBO(188, 126, 75, 1) and white text. We'll replicate this style for consistency.

### Layout Placement
**Decision:** Place textarea and button in a Column below the existing mood selection row, with appropriate spacing
**Rationale:** This maintains a logical flow: 1) Select mood, 2) Describe day, 3) Initiate prayer. Using Column keeps the layout clean and responsive.

### Prayer Button Action
**Decision:** For now, the button will have an empty onPressed handler
**Rationale:** The requirement is to create the button with proper styling. Actual prayer functionality would require additional context about what "prayer" means in this app's context, which is beyond scope.

## Risks / Trade-offs

[UI Clutter] → Mitigation: Keep textarea height reasonable and add proper padding to maintain balanced layout

[State Complexity] → Mitigation: Only adding one new state variable keeps complexity minimal

[Inconsistent Styling] → Mitigation: Directly copying the button styling from main.dart ensures consistency

## Open Questions

- Should the textarea have a character limit or placeholder text?
- What should happen when the prayer button is pressed? (Navigation? Prayer modal? etc.)
- Should we clear the textarea when a new mood is selected?

## Extra Notes

- Should the subtitle be above the textarea
- The textarea should have a border with rounded corners and the same color and padding as the button
