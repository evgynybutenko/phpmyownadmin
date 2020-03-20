<?php

namespace backend\controllers;

use src\Core\Infrastructure\Mapper\Mapper;
use src\Core\Domain\Service\CreateSQLQueryStringService;
use src\Modules\Category\Domain\Repository\CategoryItemRepositoryInterface;
use src\Modules\Category\Domain\Repository\CategoryRepositoryInterface;
use src\Modules\Category\Domain\Repository\ItemUrlRepositoryInterface;
use src\Modules\DynamicEntity\Infrastructure\Repository\DynamicEntityRepository;
use Yii;
use yii\helpers\Url;

class RecordController extends MyBeforeController
{
    public $dynamicEntityRepository;
    public $mapper;
    public $stringSQL;

    public function __construct(
        $id,
        $module,
        CategoryRepositoryInterface $categoryRepository,
        CategoryItemRepositoryInterface $categoryItemRepository,
        ItemUrlRepositoryInterface $itemUrlRepository,
        DynamicEntityRepository $dynamicEntityRepository,
        CreateSQLQueryStringService $stringSQL,
        Mapper $mapper,
        $config = []
    ) {
        parent::__construct($id, $module, $categoryRepository, $categoryItemRepository, $itemUrlRepository, $config);
        $this->dynamicEntityRepository = $dynamicEntityRepository;
        $this->mapper = $mapper;
        $this->stringSQL = $stringSQL;
    }

    public function actionDelete($name)
    {
        $toDel = Yii::$app->request->post();
        if($toDel['id'] == '')
        {
            Yii::$app->session->setFlash('error', 'Поле не заполнено!');
            return $this->redirect(Yii::$app->request->referrer);
        } else
        {
            $record = $this->dynamicEntityRepository->findByRecordId($name, $toDel['id']);//
            $this->dynamicEntityRepository->dynamicDel($record); //DeleteRecordCommand
            Yii::$app->session->setFlash('success', 'Item was deleted!');
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionSave($name)
    {
        $toSave = Yii::$app->request->post();
        foreach ($toSave as $key => $value) {  //в сервис
            if($key!='id')
            {
                if($value == '')
                {
                    Yii::$app->session->setFlash('error', 'Поле не заполнено!');
                    return $this->redirect(Yii::$app->request->referrer);
                }
            }
        }
        $toSave = $this->mapper->dynamicMap($toSave, $name);   // в saveCommand
        $this->dynamicEntityRepository->dynamicSave($toSave);  //

        Yii::$app->session->setFlash('success', 'Item was added!');
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionCurrentTable($name)
    {
        $records = $this->dynamicEntityRepository->findAll($name);  //searchService
        return $this->render('view_current_table', ['columns' => $records, 'name' => $name]);
    }

    public function actionCreate()
    {
        return $this->render('create_table');
    }

    public function actionCreateNext()
    {
        $toCreate = Yii::$app->request->post();
        if($toCreate['col'] == '' || $toCreate['tableName'] == '' || $toCreate['description'] == '')
        {
            Yii::$app->session->setFlash('error', 'Поле не заполнено!');
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->render('create_table_next', [
            'col' => $toCreate['col'],
            'tableName' => $toCreate['tableName'],
            'description' => $toCreate['description']]
        );
    }

    public function actionCreateLast($tableName)
    {
        $dataToCreate = Yii::$app->request->post();

        $urlList = "/table/list";
        $urlCreate = "/record/create";
        $description = $dataToCreate['description'];
        $indexes = $dataToCreate['index'];
        $i = 0;
        $sysTable = 'sys_table';

        $toSave = [
            'id' => null,
            'table_name' => $tableName,
            'title' => $description,
        ];

        foreach ($indexes as $index)
        {
            if ($index == 'PRIMARY')
            {
                $i++;
            }
        }
        if($i > 1)
        {
            Yii::$app->session->setFlash('error', 'Может быть только один первичный ключ!');
            return $this->redirect(Url::to($urlCreate));
        }

        $stringToCreate = $this->stringSQL->parseQuery($tableName, $dataToCreate);
        Yii::$app->db->createCommand($stringToCreate)->execute();

        $toSaveNext = $this->mapper->dynamicMap($toSave, $sysTable);
        $this->dynamicEntityRepository->dynamicSave($toSaveNext);

        Yii::$app->session->setFlash('success', 'Таблица успешно создана!');
        return $this->redirect(Url::to($urlList));
    }
}