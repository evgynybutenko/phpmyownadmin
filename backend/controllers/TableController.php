<?php

namespace backend\controllers;

use src\Modules\Category\Domain\Repository\CategoryItemRepositoryInterface;
use src\Modules\Category\Domain\Repository\CategoryRepositoryInterface;
use src\Modules\Category\Domain\Repository\ItemUrlRepositoryInterface;
use src\Modules\Db\Domain\Repository\SysTableRepositoryInterface;

class TableController extends MyBeforeController
{
    private $sysTableRepository;

    public function __construct(
        $id,
        $module,
        CategoryRepositoryInterface $categoryRepository,
        CategoryItemRepositoryInterface $categoryItemRepository,
        ItemUrlRepositoryInterface $itemUrlRepository,
        SysTableRepositoryInterface $sysTableRepository,
        $config = []
    ) {
        parent::__construct($id, $module, $categoryRepository, $categoryItemRepository, $itemUrlRepository, $config);
        $this->sysTableRepository = $sysTableRepository;
    }

    public function actionList()
    {
        $sysTable = $this->sysTableRepository->findAll();
        return $this->render('table_list', [
            'sysTable' => $sysTable,
        ]);
    }

}