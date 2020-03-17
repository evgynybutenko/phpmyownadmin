<?php


namespace src\Modules\Category\Infrastructure\Repository;


use src\Core\Infrastructure\Repository\AbstractRepository;
use src\Modules\Category\Domain\Entity\ItemUrl;
use src\Modules\Category\Domain\Repository\ItemUrlRepositoryInterface;
use yii\db\Query;

class ItemUrlRepository extends AbstractRepository implements ItemUrlRepositoryInterface
{
    public function findOneById($id): ?ItemUrl
    {
        $source = (new Query())
            ->from(ItemUrl::TABLE_NAME)
            ->where(['id' => $id])
            ->one();
        if(!$source){
            return null;
        }

        return $this->mapper->map($source, new ItemUrl());
    }

    public function findAll(): array
    {
        $source = (new Query())
            ->from(ItemUrl::TABLE_NAME)
            ->all();
        return $this->mapper->mapItems($source, new ItemUrl());
    }
}