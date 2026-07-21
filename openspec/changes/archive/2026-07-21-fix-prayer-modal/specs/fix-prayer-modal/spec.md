## ADDED Requirements

### Requirement: Select dropdown does not close modal
The `<select>` element for delivery preference SHALL NOT cause the modal to close when interacting with its dropdown options.

#### Scenario: Selecting an option keeps modal open
- **WHEN** user clicks on the delivery `<select>` and selects an option
- **THEN** the modal SHALL remain open

#### Scenario: Opening the select dropdown does not close modal
- **WHEN** user clicks on the delivery `<select>` to open the dropdown
- **THEN** the modal SHALL remain open

### Requirement: Contact fields visible when "recorded" selected
The email and WhatsApp contact fields SHALL be visible when the user selects "Oração gravada" and hidden otherwise.

#### Scenario: Recorded selected shows contact fields
- **WHEN** user selects "Oração gravada (áudio/vídeo, 24-48h)"
- **THEN** the email and WhatsApp fields SHALL be visible

#### Scenario: Instant prayer selected hides contact fields
- **WHEN** user selects "Oração instantânea"
- **THEN** the email and WhatsApp fields SHALL be hidden

#### Scenario: AI prayer selected hides contact fields
- **WHEN** user selects "Oração por IA"
- **THEN** the email and WhatsApp fields SHALL be hidden

### Requirement: Name field is required
The name input field SHALL be required for form submission.

#### Scenario: Name input has required attribute
- **WHEN** inspecting the name input element
- **THEN** it SHALL have a `required` attribute

#### Scenario: Name label does not show optional hint
- **WHEN** inspecting the name label
- **THEN** it SHALL NOT contain "(opcional)"

### Requirement: Modal has two steps
The prayer request modal SHALL display content in two sequential steps.

#### Scenario: Step 1 shows name, delivery, and contact fields
- **WHEN** the modal opens
- **THEN** the user SHALL see the name field, delivery preference select, and contact fields (if applicable)

#### Scenario: Step 2 shows prayer message and submit button
- **WHEN** user clicks "Continuar" on step 1
- **THEN** the user SHALL see the prayer message textarea and submit button

#### Scenario: Step 2 has back button
- **WHEN** user is on step 2
- **THEN** a "Voltar" button SHALL be visible to return to step 1

#### Scenario: Back button returns to step 1
- **WHEN** user clicks "Voltar" on step 2
- **THEN** step 1 content SHALL be visible again and step 2 content hidden

#### Scenario: Empty name blocks step 2
- **WHEN** user clicks "Continuar" with an empty name field
- **THEN** the form SHALL NOT advance to step 2 and SHALL show validation feedback

### Requirement: Step transition has smooth animation
The transition between step 1 and step 2 SHALL use a gentle fade/slide animation.

#### Scenario: Step transition is animated
- **WHEN** user clicks "Continuar" or "Voltar"
- **THEN** the content SHALL transition with a fade-up animation lasting ~300ms
