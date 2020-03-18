<?php


namespace backend\controllers;


use src\Core\Infrastructure\Mapper\Mapper;
use src\Modules\Category\Domain\Repository\CategoryItemRepositoryInterface;
use src\Modules\Category\Domain\Repository\CategoryRepositoryInterface;
use src\Modules\Category\Domain\Repository\ItemUrlRepositoryInterface;
use src\Modules\DynamicEntity\Domain\Entity\DynamicEntity;
use src\Modules\DynamicEntity\Infrastructure\Repository\DynamicEntityRepository;
use Yii;
use yii\web\Controller;

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

//    public function __construct(
//        $id,
//        $module,
//        DynamicEntityRepository $dynamicEntityRepository,
//        Mapper $mapper,
//        $config = []
//    ) {
//        parent::__construct($id, $module, $config);
//        $this->dynamicEntityRepository = $dynamicEntityRepository;
//        $this->mapper = $mapper;
//    }

    public function actionDelete($name)
    {
        $toDel = Yii::$app->request->post();
        if($toDel['id'] == '')
        {
            Yii::$app->session->setFlash('error', 'Поле не заполнено!');
            return $this->redirect(Yii::$app->request->referrer);
        }
        $record = $this->dynamicEntityRepository->findByRecordId($name, $toDel['id']);
        $this->dynamicEntityRepository->dynamicDel($record);
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionIndex($tableName, $recordId = null)
    {

    }

    public function actionSave($name)
    {
        $toSave = Yii::$app->request->post();
        foreach ($toSave as $key => $value) {

            if($key!='id')
            {
                if($value == '')
                {
                    Yii::$app->session->setFlash('error', 'Поле не заполнено!');
                    return $this->redirect(Yii::$app->request->referrer);
                }
            }
        }
        $toSave = $this->mapper->dynamicMap($toSave, $name);
        $this->dynamicEntityRepository->dynamicSave($toSave);

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionCurrentTable($name)
    {
        $records = $this->dynamicEntityRepository->findAll($name);
//        var_dump($records);die();
        return $this->render('view_current_table', ['columns' => $records, 'name' => $name]);
    }

}