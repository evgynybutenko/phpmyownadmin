<?php


namespace backend\controllers;


use src\Modules\Category\Domain\Repository\CategoryItemRepositoryInterface;
use src\Modules\Category\Domain\Repository\CategoryRepositoryInterface;
use src\Modules\Category\Domain\Repository\ItemUrlRepositoryInterface;
use src\Modules\Db\Domain\Repository\SysTableRepositoryInterface;
use yii\web\Controller;

class TableController extends Controller
{
    private $categoryRepository;
    private $categoryItemRepository;
    private $sysTableRepository;
    private $itemUrlRepository;

    public function __construct($id, $module,
                                CategoryRepositoryInterface $categoryRepository,
                                CategoryItemRepositoryInterface $categoryItemRepository,
                                SysTableRepositoryInterface $sysTableRepository,
                                ItemUrlRepositoryInterface $itemUrlRepository,
                                $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->categoryRepository = $categoryRepository;
        $this->categoryItemRepository = $categoryItemRepository;
        $this->sysTableRepository = $sysTableRepository;
        $this->itemUrlRepository = $itemUrlRepository;
    }

    public function actionList()
    {
        $categories = $this->categoryRepository->findAll();
        $categoryItems = $this->categoryItemRepository->findAll();
        $sysTable = $this->sysTableRepository->findAll();
        $itemUrl = $this->itemUrlRepository->findAll();

        $this->view->params['categories'] = $categories;
        $this->view->params['categoryItems'] = $categoryItems;
        $this->view->params['itemUrl'] = $itemUrl;

        return $this->render('table_list', [
            'sysTable' => $sysTable,
        ]);
    }

    public function actionCurrentTable()
    {

    }
}