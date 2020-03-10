<?php


namespace src\Modules\Category\Domain\Repository;

use src\Modules\Category\Domain\Entity\CategoryItem;

interface CategoryItemRepositoryInterface
{
    public function findOneById($id): ?CategoryItem;

    public function findAll(): array;
}