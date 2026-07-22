## ADDED Requirements

### Requirement: All CSS files use @apply consistently
All custom CSS selectors SHALL use Tailwind `@apply` directives instead of raw CSS values whenever a corresponding utility class exists.

#### Scenario: app.css uses @apply for all possible selectors
- **WHEN** inspecting `resources/css/app.css`
- **THEN** all custom selectors SHALL use `@apply` directives instead of raw CSS values, except for `@keyframes`, `@media` at-rules, and values without Tailwind equivalents

#### Scenario: result.css uses @apply for all possible selectors
- **WHEN** inspecting `resources/css/result.css`
- **THEN** all custom selectors SHALL use `@apply` directives instead of raw CSS values, except for `@keyframes`, `@media` at-rules, and values without Tailwind equivalents

#### Scenario: No visual regression after refactor
- **WHEN** the refactored CSS is built
- **THEN** all existing tests SHALL continue to pass without modification
- **AND** the rendered pages SHALL maintain identical visual appearance

### Requirement: Keyframes and reduced-motion preserved
CSS `@keyframes` animations and `@media (prefers-reduced-motion: reduce)` overrides SHALL remain as raw CSS.

#### Scenario: Keyframes unchanged
- **WHEN** inspecting any CSS file after refactor
- **THEN** all `@keyframes` blocks SHALL be identical to the original (same names, same keyframe percentages, same property values)

#### Scenario: Reduced-motion unchanged
- **WHEN** inspecting any CSS file after refactor
- **THEN** all `@media (prefers-reduced-motion: reduce)` overrides SHALL be identical to the original
