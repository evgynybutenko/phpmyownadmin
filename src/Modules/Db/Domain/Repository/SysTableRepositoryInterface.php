<?php

namespace src\Modules\Db\Domain\Repository;

use src\Core\Domain\Entities\EntityInterface;
use src\Modules\Db\Domain\Entity\SysTable;

interface SysTableRepositoryInterface
{
    public function findOneById($id): ?SysTable;

    public function findAll(): array;

    public function save(EntityInterface $entity): bool;
}