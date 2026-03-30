<?php

declare(strict_types=1);

return [
    'ctrl' => [
        'title' => 'LLL:EXT:dv_education_persons/Resources/Private/Language/locallang_db.xlf:tx_dveducationpersons_domain_model_publication',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'default_sortby' => 'sorting ASC',
        'iconfile' => 'EXT:dv_education_persons/Resources/Public/Icons/tx_dveducationpersons_domain_model_publication.svg',
        'iconIdentifier' => 'ext-dveducationpersons-publication',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'security' => [
            'ignorePageTypeRestriction' => true,
        ],
        'searchFields' => 'title,description',
    ],
    'columns' => [
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        'label' => '',
                        'invertStateDisplay' => true,
                    ],
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'datetime',
                'default' => 0,
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'datetime',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2106),
                ],
            ],
        ],
        'title' => [
            'exclude' => false,
            'label' => 'LLL:EXT:dv_education_persons/Resources/Private/Language/locallang_db.xlf:tx_dveducationpersons_domain_model_publication.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
                'required' => true,
            ],
        ],
        'description' => [
            'exclude' => true,
            'label' => 'LLL:EXT:dv_education_persons/Resources/Private/Language/locallang_db.xlf:tx_dveducationpersons_domain_model_publication.description',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'cols' => 40,
                'rows' => 15,
            ],
        ],
        'date' => [
            'exclude' => true,
            'label' => 'LLL:EXT:dv_education_persons/Resources/Private/Language/locallang_db.xlf:tx_dveducationpersons_domain_model_publication.date',
            'config' => [
                'type' => 'datetime',
                'format' => 'date',
                'default' => 0,
            ],
        ],
        'url' => [
            'exclude' => true,
            'label' => 'LLL:EXT:dv_education_persons/Resources/Private/Language/locallang_db.xlf:tx_dveducationpersons_domain_model_publication.url',
            'config' => [
                'type' => 'link',
            ],
        ],
        'sorting' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'person' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
    ],
    'types' => [
        '1' => [
            'showitem' => '
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                    title, description, date, url,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                    hidden, starttime, endtime,
            ',
        ],
    ],
];
