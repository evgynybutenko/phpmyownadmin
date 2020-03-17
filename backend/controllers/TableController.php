<?php


namespace backend\controllers;


use src\Modules\Category\Domain\Repository\CategoryItemRepositoryInterface;
use src\Modules\Category\Domain\Repository\CategoryRepositoryInterface;
use src\Modules\Category\Domain\Repository\ItemUrlRepositoryInterface;
use src\Modules\Db\Domain\Repository\SysTableRepositoryInterface;
use src\Modules\DynamicEntity\Infrastructure\Repository\DynamicEntityRepository;

class TableController extends MyBeforeController
{
    private $sysTableRepository;
    private $dynamicEntityRepository;

    public function __construct($id,
                                $module,
                                CategoryRepositoryInterface $categoryRepository,
                                CategoryItemRepositoryInterface $categoryItemRepository,
                                ItemUrlRepositoryInterface $itemUrlRepository,
                                SysTableRepositoryInterface $sysTableRepository,
                                DynamicEntityRepository $dynamicEntityRepository,
                                $config = [])
    {
        parent::__construct($id, $module, $categoryRepository, $categoryItemRepository, $itemUrlRepository, $config);
        $this->sysTableRepository = $sysTableRepository;
        $this->dynamicEntityRepository = $dynamicEntityRepository;
    }


    public function actionList()
    {

        $sysTable = $this->sysTableRepository->findAll();
        return $this->render('table_list', [
            'sysTable' => $sysTable,
        ]);
    }

    public function actionCurrentTable($name)
    {
        $records = $this->dynamicEntityRepository->findAll($name);
//        var_dump($records); die;
        return $this->render('view_current_table', ['columns' => $records, 'name' => $name]);
    }
}