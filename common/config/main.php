<?php

use src\Modules\Category\Domain\Repository\CategoryItemRepositoryInterface;
use src\Modules\Category\Domain\Repository\CategoryRepositoryInterface;
use src\Modules\Category\Infrastructure\Repository\CategoryItemRepository;
use src\Modules\Category\Infrastructure\Repository\CategoryRepository;

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
    'container' => [
        'singletons' => [
            CategoryRepositoryInterface::class => CategoryRepository::class,
            CategoryItemRepositoryInterface::class => CategoryItemRepository::class
        ]
    ]
];
