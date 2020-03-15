<?php


namespace src\Modules\SysQuery\Domain\Repository;


use src\Core\Domain\Entities\EntityInterface;
use src\Modules\SysQuery\Domain\Entity\SysQuery;

interface SysQueryRepositoryInterface
{
    public function findOneById($id): ?SysQuery;

    public function findAll(): array;

    public function save(EntityInterface $entity): bool;

}