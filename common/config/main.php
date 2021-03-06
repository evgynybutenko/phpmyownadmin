<?php

use src\Modules\Category\Domain\Repository\CategoryItemRepositoryInterface;
use src\Modules\Category\Domain\Repository\CategoryRepositoryInterface;
use src\Modules\Category\Domain\Repository\ItemUrlRepositoryInterface;
use src\Modules\Category\Infrastructure\Repository\CategoryItemRepository;
use src\Modules\Category\Infrastructure\Repository\CategoryRepository;
use src\Modules\Category\Infrastructure\Repository\ItemUrlRepository;
use src\Modules\Db\Domain\Repository\SysTableRepositoryInterface;
use src\Modules\Db\Infrastructure\Repository\SysTableRepository;
use src\Modules\SysQuery\Domain\Repository\SysQueryRepositoryInterface;
use src\Modules\SysQuery\Infrastructure\Repository\SysQueryRepository;

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
            CategoryItemRepositoryInterface::class => CategoryItemRepository::class,
            SysTableRepositoryInterface::class => SysTableRepository::class,
            SysQueryRepositoryInterface::class => SysQueryRepository::class,
            ItemUrlRepositoryInterface::class => ItemUrlRepository::class,
        ]
    ]
];
