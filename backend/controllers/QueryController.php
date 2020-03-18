<?php

namespace backend\controllers;

use src\Core\Infrastructure\Mapper\Mapper;
use src\Modules\Category\Domain\Repository\CategoryItemRepositoryInterface;
use src\Modules\Category\Domain\Repository\CategoryRepositoryInterface;
use src\Modules\Category\Domain\Repository\ItemUrlRepositoryInterface;
use src\Modules\SysQuery\Domain\Entity\SysQuery;
use src\Modules\SysQuery\Domain\Repository\SysQueryRepositoryInterface;
use Yii;
use src\Modules\SysQuery\Infrastructure\Service\ExecuteQueryService;

class QueryController extends MyBeforeController
{

    private $sysQueryRepository;
    private $executeQuery;
    private $mapper;

    public function __construct(
        $id,
        $module,
        CategoryRepositoryInterface $categoryRepository,
        CategoryItemRepositoryInterface $categoryItemRepository,
        ItemUrlRepositoryInterface $itemUrlRepository,
        SysQueryRepositoryInterface $sysQueryRepository,
        ExecuteQueryService $executeQuery,
        Mapper $mapper,
        $config = []
    ) {
        parent::__construct($id, $module, $categoryRepository, $categoryItemRepository, $itemUrlRepository, $config);
        $this->sysQueryRepository = $sysQueryRepository;
        $this->executeQuery = $executeQuery;
        $this->mapper = $mapper;
    }

    public function actionApplyQuery()
    {
        return $this->render('query_apply');
    }

    public function actionExecuteQuery()
    {
        $executeQuery = Yii::$app->request->post();

        if ($executeQuery['sql_script'] == '')
        {
            Yii::$app->session->setFlash('success', 'Поле не заполнено!');
            return $this->redirect(Yii::$app->request->referrer);
        }

        try {
            $result = $this->executeQuery->executeQuery($executeQuery['sql_script']);

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
        $scripts = $this->sysQueryRepository->findAll();
        return $this->render('query_table', [
            'scripts' => $scripts,
        ]);
    }
}