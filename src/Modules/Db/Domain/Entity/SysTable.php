<?php

namespace src\Modules\Db\Domain\Entity;

use src\Core\Domain\Entities\AbstractAttributesEntity;
use src\Core\Domain\Entities\EntityInterface;

class SysTable extends AbstractAttributesEntity implements EntityInterface
{
    public $id;
    public $table_name;
    public $title;

    public static function getTableName()
    {
        return "sys_table";
    }

    public function getAttributes(): array
    {
        return parent::getAttributes();
    }
}