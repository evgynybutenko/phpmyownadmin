<?php

namespace backend\controllers;

use src\Core\Infrastructure\Mapper\Mapper;
use src\Modules\Category\Domain\Repository\CategoryItemRepositoryInterface;
use src\Modules\Category\Domain\Repository\CategoryRepositoryInterface;
use src\Modules\Category\Domain\Repository\ItemUrlRepositoryInterface;
use src\Modules\DynamicEntity\Infrastructure\Repository\DynamicEntityRepository;
use Yii;

class RecordController extends MyBeforeController
{
    public $dynamicEntityRepository;
    public $mapper;

    public function __construct(
        $id,
        $module,
        CategoryRepositoryInterface $categoryRepository,
        CategoryItemRepositoryInterface $categoryItemRepository,
        ItemUrlRepositoryInterface $itemUrlRepository,
        DynamicEntityRepository $dynamicEntityRepository,
        Mapper $mapper,
        $config = []
    ) {
        parent::__construct($id, $module, $categoryRepository, $categoryItemRepository, $itemUrlRepository, $config);
        $this->dynamicEntityRepository = $dynamicEntityRepository;
        $this->mapper = $mapper;
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
        if($toCreate['col'] == '' || $toCreate['tableName'] == '')
        {
            Yii::$app->session->setFlash('error', 'Поле не заполнено!');
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->render('create_table_next', [
            'col' => $toCreate['col'],
            'tableName' => $toCreate['tableName']]
        );
    }

    public function actionCreateLast($tableName)
    {
        $dataToCreate = Yii::$app->request->post();
        var_dump($dataToCreate);die;
        $example = "CREATE TABLE `db_project1`.`FILMS` ( `id` INT NOT NULL , `Jenre` VARCHAR(255) NOT NULL , `Year` TEXT NOT NULL ) ENGINE = InnoDB;";
        $stringToCreate = "CREATE TABLE `phpmyownadmin`.`".$tableName."` ( ";
        $names = $dataToCreate['names'];
        $type = $dataToCreate['type'];
        for($i = 0; $i < count($dataToCreate['names']); $i++)
        {
            if($i = 0)
            {
                $stringToCreate = $stringToCreate."`".$names[$i]."` ".$type[$i]." NOT NULL ";
            } else
            {
                $stringToCreate = $stringToCreate.", `".$names[$i]."` ".$type[$i]." NOT NULL ";
            }
        }
        $stringToCreate = $stringToCreate.")";
        var_dump($stringToCreate);die;
    }
}