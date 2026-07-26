## 1. Data restructure

- [x] 1.1 Restructure `resources/data/prays.php` with `catholic`, `protestant`, `orthodox` keys
- [x] 1.2 Duplicate prayers common across traditions (Pai Nosso, Cordeiro de Deus, etc.) in each section with tradition-appropriate wording
- [x] 1.3 Ensure Catholic section has at least 25 entries

## 2. Protestant prayers

- [x] 2.1 Add biblical prayers (Oração de Jabez, Oração de Salomão, Bênção de Aarão, Salmo 23, Salmo 91)
- [x] 2.2 Add protestant devotional prayers (Oração da manhã, Oração da noite, Oração de ação de graças, Oração pela família)
- [x] 2.3 Add protestant intercessory prayers (pelos enfermos, pela paz, pelos missionários, pela pátria, pelos pastores)
- [x] 2.4 Ensure protestant section has at least 25 entries

## 3. Orthodox prayers

- [x] 3.1 Add daily prayers (Orações da manhã, Orações da noite, antes/depois das refeições)
- [x] 3.2 Add liturgical prayers (Triságio, Ó Rei Celestial, Tropário à Trindade, Credo Niceno)
- [x] 3.3 Add intercessory prayers (à Theotokos, ao Anjo da Guarda, pelos vivos, pelos falecidos, pelos inimigos)
- [x] 3.4 Add prayers of the saints (São Basílio, São Macário, São João Crisóstomo, Santo Efrém)
- [x] 3.5 Ensure orthodox section has at least 25 entries

## 4. Validation

- [x] 4.1 Write unit test verifying file has exactly 3 top-level keys
- [x] 4.2 Write unit test verifying each section has required minimum entries
- [x] 4.3 Write unit test verifying all entries have required fields (title, category, subcategory, body)
- [x] 4.4 Verify all tests pass with `php artisan test`
