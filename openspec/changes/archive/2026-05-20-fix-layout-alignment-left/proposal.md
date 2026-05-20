## Why

The current layout in describe.dart uses center alignment and space distribution that doesn't align with the desired left-aligned design. Users expect a clean, left-aligned form layout that's consistent with typical form designs where labels, inputs, and buttons start from the left edge.

## What Changes

- Change the Row containing mood images from MainAxisAlignment.spaceEvenly to MainAxisAlignment.start for left alignment
- Change the Container with instructional text from Alignment.center to Alignment.centerLeft
- Adjust the conditional section layout to use proper left alignment with consistent padding
- Remove uneven spacing that pushes elements away from the left edge
- Ensure all elements (labels, inputs, buttons) align to the left side of the screen

## Capabilities

### New Capabilities
- `left-aligned-layout`: All UI elements in DescribePage are properly left-aligned

### Modified Capabilities
- None (no existing specs to modify)

## Impact

- lib/describe.dart: Layout structure will be modified to use proper left alignment
- No functional changes, only visual/layout adjustments
- No breaking changes
- No dependencies affected