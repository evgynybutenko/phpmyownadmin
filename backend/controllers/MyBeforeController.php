<?php


namespace backend\controllers;

use src\Modules\Category\Domain\Repository\CategoryItemRepositoryInterface;
use src\Modules\Category\Domain\Repository\CategoryRepositoryInterface;
use src\Modules\Category\Domain\Repository\ItemUrlRepositoryInterface;
use yii\web\Controller;

class MyBeforeController extends Controller
{
    private $categoryRepository;
    private $categoryItemRepository;
    private $itemUrlRepository;


    public function __construct(
        $id,
        $module,
        CategoryRepositoryInterface $categoryRepository,
        CategoryItemRepositoryInterface $categoryItemRepository,
        ItemUrlRepositoryInterface $itemUrlRepository,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
        $this->categoryRepository = $categoryRepository;
        $this->categoryItemRepository = $categoryItemRepository;
        $this->itemUrlRepository = $itemUrlRepository;
    }

    public function beforeAction($action)
    {
        $itemUrl = $this->itemUrlRepository->findAll();
        $categories = $this->categoryRepository->findAll();
        $categoryItems = $this->categoryItemRepository->findAll();
        $this->view->params['categories'] = $categories;
        $this->view->params['categoryItems'] = $categoryItems;
        $this->view->params['itemUrl'] = $itemUrl;
        return parent::beforeAction($action);
    }
}