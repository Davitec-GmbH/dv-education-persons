<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

return [
    'ext-dveducationpersons-person' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:dv_education_persons/Resources/Public/Icons/Extension.svg',
    ],
    'ext-dveducationpersons-vitaentry' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:dv_education_persons/Resources/Public/Icons/VitaEntry.svg',
    ],
    'ext-dveducationpersons-publication' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:dv_education_persons/Resources/Public/Icons/Publication.svg',
    ],
    'ext-dveducationpersons-research' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:dv_education_persons/Resources/Public/Icons/Research.svg',
    ],
    'ext-dveducationpersons-teaching' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:dv_education_persons/Resources/Public/Icons/Teaching.svg',
    ],
    'ext-dveducationpersons-link' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:dv_education_persons/Resources/Public/Icons/Link.svg',
    ],
];
