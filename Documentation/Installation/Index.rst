.. include:: /Includes.rst.txt

============
Installation
============

.. contents:: On this page
   :local:
   :depth: 2

Requirements
============

- PHP 8.2 or higher (up to 8.4)
- TYPO3 v12.4 LTS or v13.4 LTS
- The following TYPO3 system extensions must be available:

  - ``typo3/cms-extbase``
  - ``typo3/cms-fluid``
  - ``typo3/cms-frontend``

- For frontend editing: ``typo3/cms-felogin`` (see :ref:`configuration-felogin`)

Installation via Composer
=========================

This is the recommended way to install the extension.

.. code-block:: bash

   composer require davitec/dv-education-persons

Activate the extension
======================

After installation, activate the extension in the TYPO3 backend:

1. Go to :guilabel:`Admin Tools > Extensions`
2. Search for **Education Persons**
3. Click the activate icon

Alternatively, if you use Composer-based installations with ``typo3/cms-composer-installers``,
the extension is activated automatically.

Database update
===============

After activation, update the database schema:

1. Go to :guilabel:`Admin Tools > Maintenance > Analyze Database Structure`
2. Apply all suggested changes for the ``dv_education_persons`` tables

This creates the required database tables for sub-entities:

- ``tx_dveducationpersons_domain_model_vitaentry``
- ``tx_dveducationpersons_domain_model_publication``
- ``tx_dveducationpersons_domain_model_research``
- ``tx_dveducationpersons_domain_model_teaching``
- ``tx_dveducationpersons_domain_model_link``

It also extends the ``fe_users`` table with additional columns: room, department,
position, teaching_area, consultation_hours, mobile, fax, slug, and the IRRE
foreign fields for all sub-entities.

Include TypoScript
==================

The static TypoScript must be included for the extension to work:

1. Go to the root template of your site
2. Select :guilabel:`Includes`
3. Add **Education Persons (dv_education_persons)** to the selected static templates

Quick start after installation
==============================

1. Include the static TypoScript template
2. Create a sysfolder for person records
3. Set ``plugin.tx_dveducationpersons.persistence.storagePid`` to the sysfolder UID
4. Create a person directory page and add the **PersonList** content element
5. Create a detail page and add the **PersonDetail** content element
6. Configure ``settings.detailPid`` and ``settings.listPid`` (via TypoScript or
   FlexForm)
7. Create a Frontend User record in the sysfolder, set record type to
   **Education Person**, and fill in the profile fields
