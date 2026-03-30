<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

$ll = 'LLL:EXT:dv_education_persons/Resources/Private/Language/locallang_db.xlf:fe_users.';

$temporaryColumns = [
    'room' => [
        'exclude' => true,
        'label' => $ll . 'room',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'max' => 255,
        ],
    ],
    'department' => [
        'exclude' => true,
        'label' => $ll . 'department',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'max' => 255,
        ],
    ],
    'position' => [
        'exclude' => true,
        'label' => $ll . 'position',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'max' => 255,
        ],
    ],
    'teaching_area' => [
        'exclude' => true,
        'label' => $ll . 'teaching_area',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'max' => 255,
        ],
    ],
    'consultation_hours' => [
        'exclude' => true,
        'label' => $ll . 'consultation_hours',
        'config' => [
            'type' => 'text',
            'cols' => 40,
            'rows' => 5,
        ],
    ],
    'mobile' => [
        'exclude' => true,
        'label' => $ll . 'mobile',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'max' => 255,
        ],
    ],
    'fax' => [
        'exclude' => true,
        'label' => $ll . 'fax',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'max' => 255,
        ],
    ],
    'slug' => [
        'exclude' => true,
        'label' => $ll . 'slug',
        'config' => [
            'type' => 'slug',
            'generatorOptions' => [
                'fields' => ['first_name', 'last_name'],
                'fieldSeparator' => '-',
                'replacements' => [
                    '/' => '-',
                ],
            ],
            'fallbackCharacter' => '-',
            'prependSlash' => false,
        ],
    ],
    'vita_entries' => [
        'exclude' => true,
        'label' => $ll . 'vita_entries',
        'config' => [
            'type' => 'inline',
            'foreign_table' => 'tx_dveducationpersons_domain_model_vitaentry',
            'foreign_field' => 'person',
            'foreign_sortby' => 'sorting',
            'maxitems' => 9999,
            'appearance' => [
                'collapseAll' => true,
                'expandSingle' => true,
                'useSortable' => true,
                'enabledControls' => [
                    'dragdrop' => true,
                ],
            ],
        ],
    ],
    'publications' => [
        'exclude' => true,
        'label' => $ll . 'publications',
        'config' => [
            'type' => 'inline',
            'foreign_table' => 'tx_dveducationpersons_domain_model_publication',
            'foreign_field' => 'person',
            'foreign_sortby' => 'sorting',
            'maxitems' => 9999,
            'appearance' => [
                'collapseAll' => true,
                'expandSingle' => true,
                'useSortable' => true,
                'enabledControls' => [
                    'dragdrop' => true,
                ],
            ],
        ],
    ],
    'researches' => [
        'exclude' => true,
        'label' => $ll . 'researches',
        'config' => [
            'type' => 'inline',
            'foreign_table' => 'tx_dveducationpersons_domain_model_research',
            'foreign_field' => 'person',
            'foreign_sortby' => 'sorting',
            'maxitems' => 9999,
            'appearance' => [
                'collapseAll' => true,
                'expandSingle' => true,
                'useSortable' => true,
                'enabledControls' => [
                    'dragdrop' => true,
                ],
            ],
        ],
    ],
    'teachings' => [
        'exclude' => true,
        'label' => $ll . 'teachings',
        'config' => [
            'type' => 'inline',
            'foreign_table' => 'tx_dveducationpersons_domain_model_teaching',
            'foreign_field' => 'person',
            'foreign_sortby' => 'sorting',
            'maxitems' => 9999,
            'appearance' => [
                'collapseAll' => true,
                'expandSingle' => true,
                'useSortable' => true,
                'enabledControls' => [
                    'dragdrop' => true,
                ],
            ],
        ],
    ],
    'person_links' => [
        'exclude' => true,
        'label' => $ll . 'person_links',
        'config' => [
            'type' => 'inline',
            'foreign_table' => 'tx_dveducationpersons_domain_model_link',
            'foreign_field' => 'person',
            'foreign_sortby' => 'sorting',
            'maxitems' => 9999,
            'appearance' => [
                'collapseAll' => true,
                'expandSingle' => true,
                'useSortable' => true,
                'enabledControls' => [
                    'dragdrop' => true,
                ],
            ],
        ],
    ],
];

ExtensionManagementUtility::addTCAcolumns('fe_users', $temporaryColumns);

// Register tx_extbase_type as the type field for fe_users (if not already set)
$GLOBALS['TCA']['fe_users']['ctrl']['type'] = 'tx_extbase_type';

// Add the type option for Education Person
$GLOBALS['TCA']['fe_users']['columns']['tx_extbase_type']['config']['items'][] = [
    'label' => $ll . 'tx_extbase_type.person',
    'value' => 'Davitec\DvEducationPersons\Domain\Model\Person',
];

// Define the showitem for our custom type
$GLOBALS['TCA']['fe_users']['types']['Davitec\DvEducationPersons\Domain\Model\Person'] = [
    'showitem' => '
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            tx_extbase_type, username, password, usergroup, slug,
        --div--;' . $ll . 'tab.academic,
            first_name, last_name, title, name, image,
            department, position, teaching_area,
        --div--;' . $ll . 'tab.contact,
            email, telephone, mobile, fax, www,
            room, consultation_hours,
        --div--;' . $ll . 'tab.subentities,
            vita_entries, publications, researches, teachings, person_links,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
            disable, starttime, endtime,
    ',
];

// Also add our fields to the default fe_users type so they're visible when switching types
ExtensionManagementUtility::addToAllTCAtypes(
    'fe_users',
    'tx_extbase_type',
    '',
    'before:username'
);
ExtensionManagementUtility::addToAllTCAtypes(
    'fe_users',
    'room, department, position, teaching_area, consultation_hours, mobile, fax, slug, vita_entries, publications, researches, teachings, person_links',
    '',
    'after:www'
);
