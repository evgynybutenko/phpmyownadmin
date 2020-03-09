<?php

namespace src\Modules\Category\Domain\Repository;

use src\Modules\Category\Domain\Entity\Category;

interface CategoryRepositoryInterface
{
    public function findOneById($id): ?Category;  //Вернет либо нулл либо сущность.

    public function findAll(): array;
}