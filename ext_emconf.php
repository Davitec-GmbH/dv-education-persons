<?php

declare(strict_types=1);

$EM_CONF[$_EXTKEY] = [
    'title' => 'Education Persons',
    'description' => 'Generic person directory for the education sector. Extends fe_users with academic profile data and sub-entities (vita, publications, research, teaching, links).',
    'category' => 'plugin',
    'author' => 'Davitec GmbH',
    'author_email' => 'info@davitec.de',
    'author_company' => 'Davitec GmbH',
    'state' => 'stable',
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '12.4.0-13.4.99',
            'php' => '8.2.0-8.4.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
