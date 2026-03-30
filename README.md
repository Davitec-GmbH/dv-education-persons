# Education Persons (dv_education_persons)

Generic person directory for the education sector. Extends `fe_users` with academic profile data and sub-entities.

## Features

- Person profiles mapped to `fe_users` with department, position, room, teaching area, consultation hours
- Sub-entities: Vita, Publications, Research, Teaching, Links (IRRE inline records)
- Three frontend plugins: PersonList (search/filter), PersonDetail, PersonEdit
- Department filter (dynamic from records), A-Z letter navigation
- Frontend profile editing for logged-in users
- TYPO3 v12 LTS and v13 LTS support

## Requirements

- PHP 8.2+
- TYPO3 v12.4 LTS or v13.4 LTS

## Installation

```bash
composer require davitec/dv-education-persons
```

Then activate the extension and run database schema updates.

## Documentation

Full documentation is available in `Documentation/` (reStructuredText).

## License

GPL-2.0-or-later
