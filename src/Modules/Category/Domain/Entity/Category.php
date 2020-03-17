<?php

namespace src\Modules\Category\Domain\Entity;

use src\Core\Domain\Entities\AbstractAttributesEntity;
use src\Core\Domain\Entities\EntityInterface;

class Category extends AbstractAttributesEntity implements EntityInterface
{
    public CONST TABLE_NAME = "category";

    public $id;
    public $category_name;

    public function getTableName()
    {
        return self::TABLE_NAME;
    }

    public function getAttributes(): array
    {
        return parent::getAttributes();
    }
}