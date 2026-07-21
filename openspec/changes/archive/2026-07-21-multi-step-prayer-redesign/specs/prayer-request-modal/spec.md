## ADDED Requirements

### Requirement: Multi-step prayer modal
The welcome page SHALL display a multi-step dialog modal for submitting prayer requests.

#### Scenario: Modal opens on button click
- **WHEN** user clicks "Pedir oração" or "Pedido de oração"
- **THEN** the modal SHALL open with step 1 visible

#### Scenario: Select interaction does not close modal
- **WHEN** user interacts with a `<select>` dropdown inside the modal
- **THEN** the modal SHALL remain open

#### Scenario: Step 1 shows contact fields
- **WHEN** the modal opens
- **THEN** step 1 SHALL show name (optional), WhatsApp, and email fields

#### Scenario: Name has max length
- **WHEN** user types in the name field
- **THEN** the input SHALL accept at most 100 characters

#### Scenario: Email has max length
- **WHEN** user types in the email field
- **THEN** the input SHALL accept at most 255 characters

#### Scenario: WhatsApp has input mask
- **WHEN** user types in the WhatsApp field
- **THEN** the input SHALL display a visual mask formatted as `+55 (xx) xxxxx-xxxx`

#### Scenario: Email validation blocks proceed
- **WHEN** user types an invalid email in the email field
- **THEN** clicking "Continuar" SHALL NOT advance to step 2 and SHALL show an inline error

#### Scenario: Step 2 shows prayer details
- **WHEN** user clicks "Continuar" from step 1
- **THEN** step 2 SHALL show prayer description textarea, religion selector, and prayer type selector

#### Scenario: Back button returns to step 1
- **WHEN** user clicks "Voltar" from step 2
- **THEN** step 1 SHALL be visible again

#### Scenario: Empty name advances without error
- **WHEN** user clicks "Continuar" with empty name
- **THEN** the form SHALL advance to step 2

#### Scenario: WhatsApp required to proceed
- **WHEN** user clicks "Continuar" with the WhatsApp field not fully filled
- **THEN** the form SHALL NOT advance to step 2 and SHALL show an inline error on the WhatsApp field

#### Scenario: Email required to proceed
- **WHEN** user clicks "Continuar" with email field empty
- **THEN** the form SHALL NOT advance to step 2 and SHALL show an inline error on the email field

#### Scenario: Religion selector has common options
- **WHEN** user views the religion dropdown
- **THEN** it SHALL include Catholic, Orthodox, Protestant, Muslim, Jewish, Buddhist, Hindu, Other

#### Scenario: Prayer type selector has five options
- **WHEN** user views the prayer type selector
- **THEN** it SHALL include: AI prayer, Instant prayer, Prayer by person (only prayer), Prayer by person (only Bible word), Prayer by person (Bible word + prayer)

### Requirement: Textarea not resizable
The prayer description textarea SHALL NOT be manually resizable.

#### Scenario: Textarea resize disabled
- **WHEN** user views the prayer description textarea
- **THEN** it SHALL NOT show a resize handle

### Requirement: Step 2 description required
The prayer description SHALL be required before form submission.

#### Scenario: Submit blocked when description empty
- **WHEN** user clicks "Enviar pedido de oração" with empty description
- **THEN** the form SHALL NOT submit and SHALL show an inline error on the textarea

### Requirement: Step indicator visible
The modal SHALL display a visual step indicator showing the current step and total steps.

#### Scenario: Step indicator shows on modal open
- **WHEN** the modal opens
- **THEN** a step indicator SHALL display "Passo 1 de 2" with step 1 highlighted

#### Scenario: Step indicator updates on navigation
- **WHEN** user clicks "Continuar"
- **THEN** the step indicator SHALL update to show "Passo 2 de 2" with step 2 highlighted

### Requirement: Step title labels
Each step SHALL have a distinct title label describing its purpose.

#### Scenario: Step 1 has contact title
- **WHEN** the modal is on step 1
- **THEN** the step title SHALL read "Seus dados"

#### Scenario: Step 2 has prayer title
- **WHEN** the modal is on step 2
- **THEN** the step title SHALL read "Seu pedido"

### Requirement: Step 2 animated transition
Transitioning between steps SHALL use a smooth fade-up animation.

#### Scenario: Step 2 fades in on continue
- **WHEN** user clicks "Continuar"
- **THEN** step 2 SHALL fade in with a smooth ~300ms animation (opacity 0 → 100, translateY -3 → 0)

#### Scenario: Step 1 fades out on continue
- **WHEN** user clicks "Continuar"
- **THEN** step 1 SHALL fade out with a smooth ~300ms animation (opacity 100 → 0, translateY 0 → -3)

### Requirement: Step 2 displays user name
The second step SHALL display the name the user entered on step 1.

#### Scenario: Name shown when advancing to step 2
- **WHEN** user clicks "Continuar" with name filled
- **THEN** step 2 SHALL display the entered name

#### Scenario: Anonymous shown when name is empty
- **WHEN** user clicks "Continuar" with name left blank
- **THEN** step 2 SHALL display "Anônimo"
