<?php

namespace src\Modules\SysQuery\Infrastructure\Repository;

use src\Core\Infrastructure\Repository\AbstractRepository;
use src\Modules\SysQuery\Domain\Entity\SysQuery;
use src\Modules\SysQuery\Domain\Repository\SysQueryRepositoryInterface;
use yii\db\Query;

class SysQueryRepository extends AbstractRepository implements SysQueryRepositoryInterface
{
    public function findOneById($id): ?SysQuery
    {
        $source = (new Query())
            ->from(SysQuery::TABLE_NAME)
            ->where(['id' => $id])
            ->one();
        if(!$source){
            return null;
        }

        return $this->mapper->map($source, new SysQuery());
    }

    public function findAll(): array
    {
        $source = (new Query())
            ->from(SysQuery::TABLE_NAME)
            ->all();

        return $this->mapper->mapItems($source, new SysQuery());
    }


}