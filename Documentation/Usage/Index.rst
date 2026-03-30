.. include:: /Includes.rst.txt

=====
Usage
=====

The extension provides three plugins that are registered as **content elements**
(CType-based, not ``list_type``).

Adding plugins to pages
=======================

All plugins are available as content elements in the TYPO3 backend:

1. Open a page in the :guilabel:`Page` module
2. Click :guilabel:`+ Content`
3. Select the :guilabel:`Plugins` tab
4. Choose one of the available plugins

PersonList
----------

CType: ``dveducationpersons_personlist``

Displays a paginated list of person records with search, department filtering,
and A-Z letter navigation.

- **Controller action**: ``PersonController->list`` (non-cacheable)
- **HTTP method**: The search form submits via **POST**
- **FlexForm settings**: Detail page, Items per page, Departments whitelist
- Place this plugin on your person directory page
- Configure the :guilabel:`Detail page` in the FlexForm to link each person
  to their full profile

PersonDetail
------------

CType: ``dveducationpersons_persondetail``

Displays the full profile of a single person, including all sub-entities
(vita, publications, research, teaching, links).

- **Controller action**: ``PersonController->show`` (cacheable)
- **FlexForm settings**: List page (for the back link)
- Place this plugin on a separate detail page
- Configure the :guilabel:`List page` in the FlexForm for the back-to-list link
- The person record is passed via URL parameter from the list view

PersonEdit
----------

CType: ``dveducationpersons_personedit``

Allows logged-in frontend users to edit their own person profile.

- **Controller actions**: ``PersonEditController->edit``,
  ``PersonEditController->update`` (both non-cacheable)
- Place this plugin on a page protected by a frontend user group
- The logged-in user's own fe_users record is loaded automatically via the
  TYPO3 Context API
- The controller includes ``initializeUpdateAction()`` which configures
  property mapping for the allowed fields
- The edit form uses **manual form field names** (e.g. ``person[department]``)
  instead of Extbase object binding to avoid HMAC hash generation issues with
  the fe_users table mapping

.. important::

   Frontend login setup is required for this plugin. See
   :ref:`configuration-felogin` for the full setup instructions including
   ``config.storagePid`` and felogin configuration.

Creating person records
=======================

1. Create a sysfolder in the page tree to store person records
2. Open the sysfolder and click :guilabel:`+ Create new record`
3. Select :guilabel:`Frontend User`
4. Set the :guilabel:`Record Type` to **Education Person** (this sets the
   ``tx_extbase_type`` field to
   ``Davitec\DvEducationPersons\Domain\Model\Person``)
5. Fill in the base fields (username, password, usergroup) and the academic
   profile fields (first name, last name, title, department, position, etc.)
6. Save the record
7. Make sure the sysfolder is configured as the storage PID (see
   :ref:`Configuration <configuration>`)

.. _usage-department-filter:

Department filter (dynamic)
===========================

The department dropdown in the PersonList search form is populated **dynamically**
from existing person records. The ``PersonRepository->findDistinctDepartments()``
method uses a QueryBuilder query to:

1. Select distinct non-empty ``department`` values from ``fe_users``
2. Filter by ``tx_extbase_type = 'Davitec\DvEducationPersons\Domain\Model\Person'``
3. Exclude deleted and disabled records
4. Sort alphabetically

This means there is no static list of departments to maintain. When a new
department value is entered on a person record, it automatically appears in the
frontend dropdown. When the last person of a department is removed or disabled,
the department disappears from the filter.

The FlexForm ``Departments`` setting works differently: it is a backend-side
**whitelist** (comma-separated department names) that restricts which persons
are displayed after the query. It does not affect the dropdown options.

Search and filter behaviour
===========================

The PersonList plugin supports three filter modes that are mutually prioritized:

1. **Search term** -- free text search across first name, last name, position,
   department, and teaching area (highest priority)
2. **Department** -- filter by a specific department from the dropdown
3. **Letter** -- A-Z navigation filtering by last name initial

The search form submits via POST. All ``tx_dveducationpersons_*`` parameters are
excluded from cHash calculation (configured in ``ext_localconf.php``) to prevent
cHash validation errors.

Reset button
------------

A **Reset** link appears next to the submit button when any filter is active
(search term, department, or letter). Clicking it navigates to the list page
URL without any filter parameters, restoring the unfiltered list.

Adding sub-entities
===================

Sub-entities are managed as inline (IRRE) records within the person record.
Open a person record and use the **Vita & Publications** tab to add:

VitaEntry
---------

Career milestones and education history entries. Each entry typically includes
a date range and description.

Publication
-----------

Academic publications, papers, and articles. Add bibliographic data for each
publication.

Research
--------

Research projects and areas of interest. Describe ongoing or completed research
activities.

Teaching
--------

Courses, seminars, and teaching activities. Document the person's teaching
portfolio.

Link
----

External URLs and social profile links. Add links to personal websites,
ORCID profiles, ResearchGate, and similar.

Frontend editing
================

The **PersonEdit** plugin enables self-service profile editing for logged-in
frontend users.

Setup:

1. Ensure ``config.storagePid`` points to the fe_users storage folder
   (see :ref:`configuration-felogin`)
2. Install and configure the **felogin** system extension with redirect to
   the edit page
3. Create a page for profile editing
4. Protect the page with a frontend user group (via Access tab)
5. Add the **PersonEdit** plugin to the page
6. Ensure the frontend user has a person record of type **Education Person**
   (matching ``tx_extbase_type``)

When a user accesses the page, the edit form is pre-filled with their current
profile data. The editable fields are: department, position, room, telephone,
mobile, fax, www, teaching area, and consultation hours. Read-only fields
(username, name, email) are not exposed in the form.

After submitting, the ``update`` action validates that the submitted person UID
matches the logged-in user (ownership check) before persisting the changes.

.. tip::

   A typical page structure:

   - Person directory page with **PersonList** plugin
   - Detail page with **PersonDetail** plugin
   - Login page with **felogin** plugin (redirect target: edit page)
   - Edit page (access-restricted) with **PersonEdit** plugin
