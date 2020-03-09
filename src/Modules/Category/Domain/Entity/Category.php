<?php

namespace src\Modules\Category\Domain\Entity;

use src\Core\Domain\Entities\EntityInterface;

class Category implements EntityInterface
{
    public $id;
    public $category_name;

    public static function getTableName()
    {
        return "category";
    }
}