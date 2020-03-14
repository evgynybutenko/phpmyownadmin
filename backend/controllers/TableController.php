<?php


namespace backend\controllers;


use src\Core\Infrastructure\Mapper\Mapper;
use src\Modules\Category\Domain\Repository\CategoryItemRepositoryInterface;
use src\Modules\Category\Domain\Repository\CategoryRepositoryInterface;
use src\Modules\Db\Domain\Repository\SysTableRepositoryInterface;
use yii\web\Controller;

class TableController extends Controller
{

    private $categoryRepository;
    private $categoryItemRepository;
    private $mapper;
    private $sysTableRepository;

    public function __construct($id, $module,
                                CategoryRepositoryInterface $categoryRepository,
                                CategoryItemRepositoryInterface $categoryItemRepository,
                                Mapper $mapper,
                                SysTableRepositoryInterface $sysTableRepository,
                                $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->categoryRepository = $categoryRepository;
        $this->categoryItemRepository = $categoryItemRepository;
        $this->mapper = $mapper;
        $this->sysTableRepository = $sysTableRepository;
    }


    public function actionList()
    {
        $categories = $this->categoryRepository->findAll();
        $categoryItems = $this->categoryItemRepository->findAll();
        $sysTable = $this->sysTableRepository->findAll();


        $this->view->params['categories'] = $categories;
        $this->view->params['categoryItems'] = $categoryItems;

        return $this->render('table_list', [
            'sysTable' => $sysTable,
        ]);
    }
}