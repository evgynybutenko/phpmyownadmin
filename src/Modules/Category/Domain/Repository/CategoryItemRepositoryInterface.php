<?php


namespace src\Modules\Category\Domain\Repository;

use src\Core\Domain\Entities\EntityInterface;
use src\Modules\Category\Domain\Entity\CategoryItem;

interface CategoryItemRepositoryInterface
{
    public function findOneById($id): ?CategoryItem;

    public function findAll(): array;

    public function findOneByItemName($name_item): ?CategoryItem;

    public function save(EntityInterface $entity): bool;

    public function delete(EntityInterface $entity): bool;
}