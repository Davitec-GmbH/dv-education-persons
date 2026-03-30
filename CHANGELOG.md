# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.0] - 2026-03-28

### Added
- Full German translation (locallang.xlf + locallang_db.xlf)
- TYPO3 v13.4 LTS compatibility verified and tested
- Comprehensive unit tests (95+ test methods across all models, repositories, controllers)
- Functional tests for repository queries with CSV fixtures
- reStructuredText documentation (Introduction, Installation, Configuration, Usage)

### Changed
- Extension declared stable for production use

## [0.3.0] - 2026-02-14

### Added
- PersonEdit plugin for frontend profile editing by logged-in users
- `initializeUpdateAction()` with explicit property mapping configuration
- Ownership validation: update action verifies person UID matches logged-in FE user
- Context API integration for secure frontend user identification
- Login setup documentation (config.storagePid, felogin redirect configuration)

### Fixed
- Frontend editing form uses manual field names instead of Extbase object binding to avoid `InvalidArgumentForHashGenerationException` with fe_users mapping
- PersistenceManager explicitly called after update for reliable persistence

## [0.2.0] - 2025-11-20

### Added
- Dynamic department dropdown populated from `PersonRepository->findDistinctDepartments()` via QueryBuilder
- Reset button in search form (appears only when filters are active)
- A-Z letter navigation for filtering by last name initial
- Search across multiple fields (firstName, lastName, position, department, teachingArea)
- FlexForm configuration for PersonList plugin (detailPid, listPid, itemsPerPage, departments whitelist)
- TypoScript constants for global settings (storagePid, detailPid, listPid, itemsPerPage)

### Fixed
- cHash exclusion for all `tx_dveducationpersons_*` parameters to prevent 404 on search/filter
- PersonList action set to non-cacheable to support POST-based search
- Search form changed from GET to POST to avoid cHash issues

## [0.1.0] - 2025-08-12

### Added
- Initial extension scaffolding extracted from HS Mainz mpm_persons project
- Person model extending `AbstractEntity` with manual fe_users property mapping (username, firstName, lastName, email, telephone, www, company, title, image)
- `getName()` helper method returning trimmed full name
- Persistence mapping to `fe_users` table via `Configuration/Extbase/Persistence/Classes.php` with record type `Davitec\DvEducationPersons\Domain\Model\Person`
- TCA record type on `fe_users` using `tx_extbase_type` as type selector
- Backend tabs: General, Academic Profile, Contact, Vita & Publications, Access
- Slug field with auto-generation from first_name + last_name
- Five sub-entity models: VitaEntry, Publication, Research, Teaching, Link
- IRRE inline relations with drag-and-drop sorting for all sub-entities
- Cascade remove on all sub-entity relations
- PersonRepository with default ordering (lastName ASC, firstName ASC)
- PersonList plugin (`dveducationpersons_personlist`) — filterable person list
- PersonDetail plugin (`dveducationpersons_persondetail`) — full profile display with sub-entities
- All plugins registered as content elements (CType, not list_type)
- Fluid templates with semantic HTML, accessibility attributes (aria-labels, sr-only)
- Partials: Person/Card (reusable list card), Person/SubEntities (generic sub-entity renderer)
- Static TypoScript registration via `sys_template` override
- Icon registration via `Configuration/Icons.php`
- TYPO3 v12.4 LTS and v13.4 LTS support
- PHP 8.2 - 8.4 support
