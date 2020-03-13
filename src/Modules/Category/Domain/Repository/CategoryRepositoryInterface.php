<?php

namespace src\Modules\Category\Domain\Repository;

use src\Core\Domain\Entities\EntityInterface;
use src\Modules\Category\Domain\Entity\Category;

interface CategoryRepositoryInterface
{
    public function findOneById($id): ?Category;  //Вернет либо нулл либо сущность.

    public function findAll(): array;

    public function findOneByCategoryName($name_category): ?Category;

    //insert

    public function save(EntityInterface $entity): bool;

    public function delete(EntityInterface $entity): bool;
}