<?php

namespace src\Modules\Category\Domain\Entity;

use src\Core\Domain\Entities\EntityInterface;

class CategoryItem implements EntityInterface
{
    public $id;
    public $item_name;
    public $id_category;

    public static function getTableName()
    {
        return "category_item";
    }
}