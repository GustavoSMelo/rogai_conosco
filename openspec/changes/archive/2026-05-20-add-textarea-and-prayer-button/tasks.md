## 1. State Management

- [x] 1.1 Add descriptionText state variable to DescribePageState class
- [x] 1.2 Initialize descriptionText as empty string

## 2. UI Implementation

- [x] 2.1 Add conditional rendering logic for textarea based on selectedHumor state
- [x] 2.2 Add subtitle text above the textarea that describe which mood was selected like "O seu dia foi feliz/mais ou menos /triste (sinto muito), the word 'feliz', 'mais ou menos', 'triste' should be colorized based on mood"
- [x] 2.3 Implement TextFormField/TextField for description input with onChanged handler
- [x] 2.3.1 Add a placeholder text to the textarea based on the selected mood
- [x] 2.4 Add conditional rendering logic for prayer button based on selectedHumor state
- [x] 2.5 Implement prayer button with correct text "Vamos orar pelo seu dia ->"
- [x] 2.6 Style prayer button to match main.dart primary button (backgroundColor: Color.fromRGBO(188, 126, 75, 1))
- [x] 2.7 Style prayer button text (fontSize: 18, fontWeight: FontWeight.bold, color: Color.fromRGBO(245, 237, 220, 1))
- [x] 2.8 Position textarea and button appropriately in the layout with proper spacing

## 3. Integration & Testing

- [x] 3.1 Verify textarea appears only after mood selection
- [x] 3.2 Verify textarea content updates as user types
- [x] 3.3 Verify prayer button appears only after mood selection
- [x] 3.4 Verify prayer button has correct styling
- [x] 3.5 Verify both elements are hidden when no mood is selected
