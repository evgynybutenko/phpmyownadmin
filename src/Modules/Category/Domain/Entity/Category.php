<?php

namespace src\Modules\Category\Domain\Entity;

use src\Core\Domain\Entities\AbstractAttributesEntity;
use src\Core\Domain\Entities\EntityInterface;

class Category extends AbstractAttributesEntity implements EntityInterface
{

    public $id;
    public $category_name;

    public static function getTableName()
    {
        return "category";
    }

    public function getAttributes(): array
    {
        return parent::getAttributes();
    }
}