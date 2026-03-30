<?php

declare(strict_types=1);

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

ExtensionUtility::registerPlugin(
    'DvEducationPersons',
    'PersonList',
    'LLL:EXT:dv_education_persons/Resources/Private/Language/locallang_db.xlf:plugin.person_list.title',
    'ext-dveducationpersons-plugin-personlist'
);

ExtensionUtility::registerPlugin(
    'DvEducationPersons',
    'PersonDetail',
    'LLL:EXT:dv_education_persons/Resources/Private/Language/locallang_db.xlf:plugin.person_detail.title',
    'ext-dveducationpersons-plugin-persondetail'
);

ExtensionUtility::registerPlugin(
    'DvEducationPersons',
    'PersonEdit',
    'LLL:EXT:dv_education_persons/Resources/Private/Language/locallang_db.xlf:plugin.person_edit.title',
    'ext-dveducationpersons-plugin-personedit'
);
