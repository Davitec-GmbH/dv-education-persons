.. include:: /Includes.rst.txt

.. _configuration:

=============
Configuration
=============

TypoScript Constants
====================

All constants are available in the TYPO3 constant editor under the category
``plugin.tx_dveducationpersons``.

.. confval:: plugin.tx_dveducationpersons.persistence.storagePid

   :type: int
   :Default: (empty)

   UID of the page (sysfolder) where person records (fe_users) are stored.
   This is required for the plugins to find records.

.. confval:: plugin.tx_dveducationpersons.settings.detailPid

   :type: int
   :Default: (empty)

   UID of the page containing the PersonDetail plugin. Used by the list view
   to generate links to the detail page.

.. confval:: plugin.tx_dveducationpersons.settings.listPid

   :type: int
   :Default: (empty)

   UID of the page containing the PersonList plugin. Used by the detail view
   to generate the back-to-list link.

.. confval:: plugin.tx_dveducationpersons.settings.itemsPerPage

   :type: int
   :Default: 20

   Number of person records shown per page in the list view.

FlexForm settings
=================

Each plugin instance can override the global TypoScript settings via its FlexForm.
The FlexForm is available in the plugin content element's :guilabel:`Plugin` tab.

.. t3-field-list-table::
   :header-rows: 1

   - :Field: Field
     :Description: Description

   - :Field: Detail page
     :Description: Page containing the PersonDetail plugin. Overrides
       ``settings.detailPid``.

   - :Field: List page
     :Description: Page containing the PersonList plugin. Overrides
       ``settings.listPid``.

   - :Field: Items per page
     :Description: Number of records per page. Overrides
       ``settings.itemsPerPage``. Default: 20.

   - :Field: Departments
     :Description: Comma-separated list of department names to restrict the
       person list. This is a backend-side whitelist filter applied after the
       query. If empty, all departments are shown. Note: the frontend
       department dropdown is populated dynamically from existing records
       (see :ref:`usage-department-filter`).

Plugins (Content Elements)
==========================

The three plugins are registered as **content elements** (not as ``list_type``
plugins). Their CType values are:

.. t3-field-list-table::
   :header-rows: 1

   - :Plugin: Plugin
     :CType: CType

   - :Plugin: PersonList
     :CType: ``dveducationpersons_personlist``

   - :Plugin: PersonDetail
     :CType: ``dveducationpersons_persondetail``

   - :Plugin: PersonEdit
     :CType: ``dveducationpersons_personedit``

This means the plugins are available under the :guilabel:`Plugins` tab in the
new content element wizard and do **not** appear in the generic plugin dropdown.

Caching behaviour
-----------------

- **PersonList**: the ``list`` action is registered as **non-cacheable**
  because the search form submits via POST. All ``tx_dveducationpersons_*``
  parameters are excluded from cHash calculation in ``ext_localconf.php``.
- **PersonDetail**: the ``show`` action is **cacheable**.
- **PersonEdit**: both ``edit`` and ``update`` actions are **non-cacheable**
  (user-specific content).

fe_users record type (TCA)
==========================

The extension registers a custom record type on the ``fe_users`` table.

Type selector
-------------

The column ``tx_extbase_type`` is used as the type field for ``fe_users``.
The extension adds a new type option with the value
``Davitec\DvEducationPersons\Domain\Model\Person`` (the FQCN of the domain
model). This is also the ``recordType`` configured in
``Configuration/Extbase/Persistence/Classes.php``.

To create a person record in the backend:

1. Open a sysfolder in the TYPO3 backend
2. Create a new **Frontend User** record
3. Set the :guilabel:`Record Type` field to **Education Person**
4. Fill in the academic profile fields

Backend tabs
------------

When the record type is set to *Education Person*, the backend form shows the
following tabs:

- **General** -- tx_extbase_type, username, password, usergroup, slug
- **Academic Profile** -- first_name, last_name, title, name, image, department,
  position, teaching_area
- **Contact** -- email, telephone, mobile, fax, www, room, consultation_hours
- **Vita & Publications** -- vita_entries, publications, researches, teachings,
  person_links (all IRRE inline records)
- **Access** -- disable, starttime, endtime

Storage PID
===========

Person records must be stored in a dedicated sysfolder. Configure the storage PID
in one of two ways:

**Via TypoScript** (recommended for site-wide configuration):

.. code-block:: typoscript

   plugin.tx_dveducationpersons.persistence.storagePid = 42

**Via plugin content element** -- set the :guilabel:`Record Storage Page` in the
content element's :guilabel:`Behaviour` tab.

.. _configuration-felogin:

Frontend login setup (config.storagePid)
========================================

For the **PersonEdit** plugin to work, the logged-in frontend user must be
resolved from the same sysfolder that contains the person records. This requires
``config.storagePid`` in your site TypoScript setup:

.. code-block:: typoscript

   config.storagePid = 42

Replace ``42`` with the UID of the sysfolder containing your fe_users / person
records. Without this setting, TYPO3 cannot match the logged-in fe_user to the
Person record.

Additionally, you need a working **felogin** setup:

1. Install and activate the ``felogin`` system extension
   (``typo3/cms-felogin``)
2. Create a page for the login form
3. Add the **Login Form** (felogin) content element to that page
4. Configure the felogin plugin to redirect to the page containing the
   **PersonEdit** plugin after successful login
5. Protect the edit page with a frontend user group (via the page's
   :guilabel:`Access` tab)

.. tip::

   A typical page structure looks like this:

   - **Person Directory** (PersonList plugin)
   - **Person Detail** (PersonDetail plugin)
   - **Login** (felogin plugin, redirects to Edit page after login)
   - **Edit Profile** (PersonEdit plugin, access-restricted)

Template overrides
==================

To customize the Fluid templates, copy the original templates and configure
alternative template paths via TypoScript:

.. code-block:: typoscript

   plugin.tx_dveducationpersons {
     view {
       templateRootPaths.10 = EXT:my_sitepackage/Resources/Private/Templates/DvEducationPersons/
       partialRootPaths.10 = EXT:my_sitepackage/Resources/Private/Partials/DvEducationPersons/
       layoutRootPaths.10 = EXT:my_sitepackage/Resources/Private/Layouts/DvEducationPersons/
     }
   }

.. note::

   Always use a numeric key higher than ``0`` to keep the original templates as
   fallback.
