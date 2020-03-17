<?php


namespace backend\controllers;


use src\Core\Infrastructure\Mapper\Mapper;
use src\Modules\Category\Domain\Repository\CategoryItemRepositoryInterface;
use src\Modules\Category\Domain\Repository\CategoryRepositoryInterface;
use src\Modules\Category\Domain\Repository\ItemUrlRepositoryInterface;
use src\Modules\SysQuery\Domain\Entity\SysQuery;
use src\Modules\SysQuery\Domain\Repository\SysQueryRepositoryInterface;
use Yii;
use yii\web\Controller;
use src\Modules\SysQuery\Infrastructure\Service\ExecuteQueryService;

class QueryController extends Controller
{
    private $categoryRepository;
    private $categoryItemRepository;
    private $sysQueryRepository;
    private $itemUrlRepository;
    private $executeQuery;
    private $mapper;

    public function __construct(
        $id,
        $module,
        CategoryRepositoryInterface $categoryRepository,
        CategoryItemRepositoryInterface $categoryItemRepository,
        SysQueryRepositoryInterface $sysQueryRepository,
        ItemUrlRepositoryInterface $itemUrlRepository,
        ExecuteQueryService $executeQuery,
        Mapper $mapper,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
        $this->categoryRepository = $categoryRepository;
        $this->categoryItemRepository = $categoryItemRepository;
        $this->sysQueryRepository = $sysQueryRepository;
        $this->itemUrlRepository = $itemUrlRepository;
        $this->executeQuery = $executeQuery;
        $this->mapper = $mapper;
    }

    public function actionApplyQuery()
    {
        $categories = $this->categoryRepository->findAll();
        $categoryItems = $this->categoryItemRepository->findAll();
        $itemUrl = $this->itemUrlRepository->findAll();

        $this->view->params['categories'] = $categories;
        $this->view->params['categoryItems'] = $categoryItems;
        $this->view->params['itemUrl'] = $itemUrl;

        return $this->render('query_apply');
    }

    public function actionExecuteQuery()
    {
        $executeQuery = Yii::$app->request->post();

        if ($executeQuery['sql_script'] == '')   //проверка на пустоту
        {
            Yii::$app->session->setFlash('success', 'Поле не заполнено!');
            return $this->redirect(Yii::$app->request->referrer);
        }

        try {
            $result = $this->executeQuery->executeQuery($executeQuery['sql_script']); //выполнение sql-крипта

            if ($result) {
                Yii::$app->session->setFlash('success', 'Successful sql-request!');
            }
        } catch (\Throwable $exception) {
            Yii::$app->session->setFlash('error', $exception->getMessage());
        }

        if(in_array('sql_script_save' ,array_keys($executeQuery)))  //сохранение скрипта в таблицу
        {
            unset($executeQuery['sql_script_save']);
            unset($executeQuery['id']);
            $queryToSave =  $this->mapper->map($executeQuery, new SysQuery());
            $this->sysQueryRepository->save($queryToSave);

            Yii::$app->session->setFlash('success', 'Successful sql-request was added!');
        }

        return $this->redirect(Yii::$app->request->referrer);
    }


    public function actionQueryTable()
    {
        $categoryItems = $this->categoryItemRepository->findAll();
        $itemUrl = $this->itemUrlRepository->findAll();
        $categories = $this->categoryRepository->findAll();

        $this->view->params['categories'] = $categories;
        $this->view->params['categoryItems'] = $categoryItems;
        $this->view->params['itemUrl'] = $itemUrl;

        $scripts = $this->sysQueryRepository->findAll();
        return $this->render('query_table', [
            'scripts' => $scripts,
        ]);
    }
}