.. include:: /Includes.rst.txt

============
Introduction
============

What does it do?
================

The **Education Persons** extension provides a generic person directory tailored for
the education and research sector. It extends the TYPO3 ``fe_users`` table with
academic profile data and introduces several sub-entity types for structured
profile information.

The Person model extends ``AbstractEntity`` (not ``FrontendUser``, which was removed
in TYPO3 v12) and manually maps the relevant fe_users fields (username, firstName,
lastName, email, telephone, www, company, title, image). The persistence mapping to
the ``fe_users`` table is configured via
``Configuration/Extbase/Persistence/Classes.php``.

The extension ships three content element plugins that cover the full lifecycle:
listing, detail view, and frontend editing of person records.

Features
========

- **Person model based on fe_users** -- extends ``AbstractEntity`` with manual
  property mapping to ``fe_users``, no dependency on ``FrontendUser``
- **Record type via tx_extbase_type** -- uses the ``tx_extbase_type`` column as
  type selector; the record type value is the FQCN
  ``Davitec\DvEducationPersons\Domain\Model\Person``
- **Academic profile fields** -- title, department, position, teaching area,
  consultation hours, room, slug, and more
- **Sub-entities** for structured data:

  - **VitaEntry** -- career milestones and education history
  - **Publication** -- academic publications and papers
  - **Research** -- research projects and interests
  - **Teaching** -- courses and teaching activities
  - **Link** -- external links and social profiles

- **PersonList plugin** (CType ``dveducationpersons_personlist``) -- paginated
  list view with text search, dynamic department filter, A-Z letter navigation,
  and a reset button when filters are active. Uses POST method; the list action
  is non-cacheable.
- **PersonDetail plugin** (CType ``dveducationpersons_persondetail``) -- full
  profile display with all sub-entities
- **PersonEdit plugin** (CType ``dveducationpersons_personedit``) -- frontend
  editing for logged-in users; both edit and update actions are non-cacheable.
  Uses manual form field names (not Extbase object binding) to avoid HMAC hash
  issues with the fe_users mapping.
- **Dynamic department filter** -- department options in the search form are
  loaded dynamically from existing person records via ``findDistinctDepartments()``
  (QueryBuilder-based), not from a static list
- **cHash exclusion** -- all plugin parameters are excluded from cHash calculation
  in ``ext_localconf.php`` to prevent cHash errors with the search form
- **FlexForm configuration** -- per-plugin settings for detail page, list page,
  items per page, and department whitelist filter
- **TypoScript constants** -- global configuration via the TYPO3 constant editor
- **Full German translation** included
- **TYPO3 v12 and v13 LTS** support

Screenshots
===========

.. note::

   Screenshots will be added in a future version of this documentation.
