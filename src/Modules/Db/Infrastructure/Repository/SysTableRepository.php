<?php

namespace src\Modules\Db\Infrastructure\Repository;

use src\Core\Infrastructure\Repository\AbstractRepository;
use src\Modules\Db\Domain\Entity\SysTable;
use src\Modules\Db\Domain\Repository\SysTableRepositoryInterface;
use yii\db\Query;


class SysTableRepository extends AbstractRepository implements SysTableRepositoryInterface
{
    public function findOneById($id): ?SysTable
    {
        $source = (new Query())
            ->from(SysTable::getTableName())
            ->where(['id' => $id])
            ->one();
        if(!$source){
            return null;
        }

        return $this->mapper->map($source, new SysTable());
    }

    public function findAll(): array
    {
        $source = (new Query())
            ->from(SysTable::getTableName())
            ->all();

        return $this->mapper->mapItems($source, new SysTable());
    }
}