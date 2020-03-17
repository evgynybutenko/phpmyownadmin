<?php


namespace backend\controllers;


use src\Modules\DynamicEntity\Infrastructure\Repository\DynamicEntityRepository;
use yii\web\Controller;

class RecordController extends Controller
{
    public $dynamicEntityRepository;

    public function __construct(
        $id,
        $module,
        DynamicEntityRepository $dynamicEntityRepository,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
        $this->dynamicEntityRepository = $dynamicEntityRepository;
    }

    public function actionDelete($tableName, $recordId)
    {
        $record = $this->dynamicEntityRepository->findByRecordId($tableName, $recordId);
    }

    public function actionUpdate()
    {

    }

    public function actionIndex($tableName, $recordId = null)
    {

    }
}