<?php

namespace src\Modules\SysQuery\Infrastructure\Service;

use Yii;

class ExecuteQueryService
{
    public function executeQuery($sqlQuery): bool
    {
        return Yii::$app->db->createCommand($sqlQuery)->execute();
    }
}