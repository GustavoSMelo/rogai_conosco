## ADDED Requirements

### Requirement: Content boxes display with icon and text layout
The Words view SHALL display 3 content boxes in a vertical list. Each box SHALL have a left-side Material icon and a right-side text content area. The boxes SHALL have white backgrounds with border radius and box shadow.

#### Scenario: Three boxes are displayed vertically
- **WHEN** the Words view is rendered
- **THEN** 3 content boxes are displayed in a vertical column below the title

#### Scenario: Each box has an icon on the left
- **WHEN** a content box is rendered
- **THEN** a Material UI icon is displayed on the left side of the box
- **AND** the first box displays a heart icon (Icons.favorite)
- **AND** the second box displays a cross icon (Icons.close)
- **AND** the third box displays a star icon (Icons.star)

### Requirement: Content box right side has description and Bible verse
The right side of each content box SHALL display a 2-line lorem ipsum description, followed by a Bible verse reference in the accent color, followed by the transcribed verse text.

#### Scenario: Right side content layout
- **WHEN** a content box is rendered
- **THEN** the right side displays a description text limited to 2 lines
- **AND** below the description, a Bible verse reference is displayed in the accent color (rgb(188, 126, 75))
- **AND** below the verse reference, the verse transcription text is displayed

#### Scenario: Mockup Bible verse content
- **WHEN** the content boxes are rendered
- **THEN** each box displays the verse reference "NT - John 1:1" in the accent color
- **AND** each box displays the verse transcription "In the beginning is a verb, and the verb was with God, and the verb is God"

### Requirement: Content boxes have styled appearance
Each content box SHALL have a white background, border radius, and box shadow for visual elevation against the cream scaffold background.

#### Scenario: Box styling
- **WHEN** a content box is rendered
- **THEN** the box has a white background
- **AND** the box has border radius for rounded corners
- **AND** the box has a box shadow for elevation effect
