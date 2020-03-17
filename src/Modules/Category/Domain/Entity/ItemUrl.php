<?php


namespace src\Modules\Category\Domain\Entity;


use src\Core\Domain\Entities\AbstractAttributesEntity;
use src\Core\Domain\Entities\EntityInterface;

class ItemUrl extends AbstractAttributesEntity implements EntityInterface
{
    public CONST TABLE_NAME = "item_url";

    public $id;
    public $url;
    public $item_name;

    public function getTableName()
    {
        return self::TABLE_NAME;
    }

    public function getAttributes(): array
    {
        return parent::getAttributes();
    }
}