## ADDED Requirements

### Requirement: Welcome page explains the three recorded delivery sub-options
The welcome page SHALL include a section, placed after the "Como sua oração chega até você" section, that explains the difference between the three recorded prayer delivery sub-options: **Apenas oração**, **Apenas palavra**, and **Oração + palavra**.

#### Scenario: Section exists after delivery section
- **WHEN** a user views the welcome page
- **THEN** the page SHALL render a section explaining the recorded delivery sub-options positioned after the "Como sua oração chega até você" section

#### Scenario: Three sub-options are presented
- **WHEN** the user scrolls to the recorded delivery options section
- **THEN** the section SHALL present three distinct options named "Apenas oração", "Apenas palavra", and "Oração + palavra"

### Requirement: Pray option explained
The "Apenas oração" option SHALL be explained as a prayer in which a real person prays for the requester, delivered in a single audio or video.

#### Scenario: Pray option description
- **WHEN** the user reads the "Apenas oração" option
- **THEN** the description SHALL state that a real person prays for the requester

### Requirement: Word option explained
The "Apenas palavra" option SHALL be explained as a Bible verse searched for the requester's specific situation, delivered in a single audio or video.

#### Scenario: Word option description
- **WHEN** the user reads the "Apenas palavra" option
- **THEN** the description SHALL state that a Bible verse is searched to match the requester's situation

### Requirement: Pray + word option explained
The "Oração + palavra" option SHALL be explained as combining both the prayer and the Bible verse in a single audio or video.

#### Scenario: Combined option description
- **WHEN** the user reads the "Oração + palavra" option
- **THEN** the description SHALL state that the option combines both the prayer and the Bible verse in one audio or video