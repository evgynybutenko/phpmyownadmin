<?php

namespace src\Modules\DynamicEntity\Infrastructure\Repository;

use src\Core\Infrastructure\Repository\AbstractRepository;
use src\Modules\DynamicEntity\Domain\Entity\DynamicEntity;
use src\Modules\DynamicEntity\Domain\Repository\DynamicEntityRepositoryInterface;
use yii\db\Query;

class DynamicEntityRepository extends AbstractRepository implements DynamicEntityRepositoryInterface
{
    public function findAll($tableName): array
    {
        $records = (new Query())
            ->from($tableName)
            ->all();
        return $this->mapper->dynamicMapItems($records, $tableName);
    }

    public function findByRecordId($tableName, $id): DynamicEntity
    {
        $record = (new Query())
            ->from($tableName)
            ->where(['id' => $id])
            ->one();

        return $this->mapper->dynamicMap($record, $tableName);
    }
}