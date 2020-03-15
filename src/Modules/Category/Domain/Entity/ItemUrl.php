<?php


namespace src\Modules\Category\Domain\Entity;


use src\Core\Domain\Entities\AbstractAttributesEntity;
use src\Core\Domain\Entities\EntityInterface;

class ItemUrl extends AbstractAttributesEntity implements EntityInterface
{
    public $id;
    public $url;
    public $item_name;

    public static function getTableName()
    {
        return "item_url";
    }

    public function getAttributes(): array
    {
        return parent::getAttributes();
    }
}