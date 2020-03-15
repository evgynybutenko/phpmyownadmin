<?php


namespace backend\controllers;


use src\Modules\Category\Domain\Repository\CategoryItemRepositoryInterface;
use src\Modules\Category\Domain\Repository\CategoryRepositoryInterface;
use src\Modules\Category\Domain\Repository\ItemUrlRepositoryInterface;
use src\Modules\SysQuery\Domain\Repository\SysQueryRepositoryInterface;
use yii\web\Controller;

class QueryController extends Controller
{
    private $categoryRepository;
    private $categoryItemRepository;
    private $sysQueryRepository;
    private $itemUrlRepository;

    public function __construct(
        $id,
        $module,
        CategoryRepositoryInterface $categoryRepository,
        CategoryItemRepositoryInterface $categoryItemRepository,
        SysQueryRepositoryInterface $sysQueryRepository,
        ItemUrlRepositoryInterface $itemUrlRepository,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
        $this->categoryRepository = $categoryRepository;
        $this->categoryItemRepository = $categoryItemRepository;
        $this->sysQueryRepository = $sysQueryRepository;
        $this->itemUrlRepository = $itemUrlRepository;
    }

    public function actionApplyQuery()
    {
        $categories = $this->categoryRepository->findAll();
        $categoryItems = $this->categoryItemRepository->findAll();
        $sysQueries = $this->sysQueryRepository->findAll();
        $itemUrl = $this->itemUrlRepository->findAll();

        $this->view->params['categories'] = $categories;
        $this->view->params['categoryItems'] = $categoryItems;
        $this->view->params['itemUrl'] = $itemUrl;

        return $this->render('query_apply', [
            'sysQueries' => $sysQueries,
        ]);
    }

}