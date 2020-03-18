<?php

namespace src\Modules\DynamicEntity\Domain\Repository;

use src\Modules\DynamicEntity\Domain\Entity\DynamicEntity;

interface DynamicEntityRepositoryInterface
{
    public function findAll($tableName): array;

    public function findByRecordId($tableName, $id): ?DynamicEntity;

    public function dynamicSave(DynamicEntity $entity);
}