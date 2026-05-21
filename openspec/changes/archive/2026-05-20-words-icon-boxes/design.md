## Context

The Words view (`lib/words.dart`) is a Flutter StatelessWidget with a cream background (`rgb(245, 237, 220)`) and dark brown text (`rgb(74, 56, 43)`). Currently it only displays a title. The app uses `Color.fromRGBO(188, 126, 75, 1)` as its accent/seed color throughout other views (main.dart, describe.dart). All colors are hardcoded inline - no centralized theme constants exist.

## Goals / Non-Goals

**Goals:**
- Add 3 content boxes with consistent styling (box shadow, border radius)
- Each box: left icon + right content area with description, verse reference, verse text
- Use the existing accent color `rgb(188, 126, 75)` for Bible verse references
- Match the app's existing warm brown visual language

**Non-Goals:**
- Centralizing color definitions (out of scope)
- Making boxes interactive/tappable
- Loading real Bible verse data (mockup only)

## Decisions

**1. Box layout: Row with icon on left, text content on right**
- Rationale: User explicitly requested left icon, right content. Row widget is the natural Flutter approach.
- Alternative: ListTile - rejected because it limits customization of shadow and padding.

**2. Icons: Icons.favorite, Icons.close (cross-like), Icons.star**
- Rationale: Material Icons provide `Icons.favorite` (heart) and `Icons.star` (star) directly. For a cross, `Icons.close` is the closest Material icon. Alternative: `Icons.add` or a custom cross icon, but `Icons.close` is more recognizable as a cross shape.
- Alternative: Custom SVG icons - rejected to avoid adding dependencies.

**3. Box styling: Container with BoxDecoration**
- Rationale: BoxDecoration supports both boxShadow and borderRadius natively. White background for contrast against cream scaffold.
- Alternative: Card widget - rejected for less control over shadow customization.

**4. Bible verse reference styling: accent color with fontWeight bold**
- Rationale: The accent color `rgb(188, 126, 75)` is already used for primary actions (buttons) in other views. Using it for verse references creates visual consistency.

## Risks / Trade-offs

- [Icons.close as cross] → The close icon isn't a traditional cross. User may want a different icon later. Can be swapped easily since it's just an icon constant.
- [Hardcoded colors] → Continues existing pattern of inline colors. Consistent with codebase, but fragile if palette changes.
