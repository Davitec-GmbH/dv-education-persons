<?php

declare(strict_types=1);

use Davitec\DvEducationPersons\Controller\PersonController;
use Davitec\DvEducationPersons\Controller\PersonEditController;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

// Exclude all plugin parameters from cHash calculation
$GLOBALS['TYPO3_CONF_VARS']['FE']['cacheHash']['excludedParametersIfEmpty'][] = 'tx_dveducationpersons_personlist[searchTerm]';
$GLOBALS['TYPO3_CONF_VARS']['FE']['cacheHash']['excludedParametersIfEmpty'][] = 'tx_dveducationpersons_personlist[department]';
$GLOBALS['TYPO3_CONF_VARS']['FE']['cacheHash']['excludedParametersIfEmpty'][] = 'tx_dveducationpersons_personlist[letter]';
$GLOBALS['TYPO3_CONF_VARS']['FE']['cacheHash']['requireCacheHashPresenceParameters'] = array_filter(
    $GLOBALS['TYPO3_CONF_VARS']['FE']['cacheHash']['requireCacheHashPresenceParameters'] ?? [],
    static fn(string $param): bool => !str_starts_with($param, 'tx_dveducationpersons_'),
);
// Exclude all tx_dveducationpersons_* parameters from cHash
$GLOBALS['TYPO3_CONF_VARS']['FE']['cacheHash']['excludedParameters'] = array_merge(
    $GLOBALS['TYPO3_CONF_VARS']['FE']['cacheHash']['excludedParameters'] ?? [],
    [
        'tx_dveducationpersons_personlist[searchTerm]',
        'tx_dveducationpersons_personlist[department]',
        'tx_dveducationpersons_personlist[letter]',
        'tx_dveducationpersons_personlist[action]',
        'tx_dveducationpersons_personlist[controller]',
        'tx_dveducationpersons_personlist[__referrer]',
        'tx_dveducationpersons_personlist[__referrer][@extension]',
        'tx_dveducationpersons_personlist[__referrer][@controller]',
        'tx_dveducationpersons_personlist[__referrer][@action]',
        'tx_dveducationpersons_personlist[__referrer][@request]',
        'tx_dveducationpersons_personlist[__trustedProperties]',
        'tx_dveducationpersons_persondetail[person]',
        'tx_dveducationpersons_persondetail[action]',
        'tx_dveducationpersons_persondetail[controller]',
    ],
);

ExtensionUtility::configurePlugin(
    'DvEducationPersons',
    'PersonList',
    [
        PersonController::class => 'list',
    ],
    [
        PersonController::class => 'list',
    ],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

ExtensionUtility::configurePlugin(
    'DvEducationPersons',
    'PersonDetail',
    [
        PersonController::class => 'show',
    ],
    [],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

ExtensionUtility::configurePlugin(
    'DvEducationPersons',
    'PersonEdit',
    [
        PersonEditController::class => 'edit,update',
    ],
    [
        PersonEditController::class => 'edit,update',
    ],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);
