<?php

namespace src\Modules\Db\Domain\Entity;

use src\Core\Domain\Entities\AbstractAttributesEntity;
use src\Core\Domain\Entities\EntityInterface;

class SysTable extends AbstractAttributesEntity implements EntityInterface
{
    public CONST TABLE_NAME = "sys_table";

    public $id;
    public $table_name;
    public $title;

    public function getTableName()
    {
        return self::TABLE_NAME;
    }

    public function getAttributes(): array
    {
        return parent::getAttributes();
    }
}