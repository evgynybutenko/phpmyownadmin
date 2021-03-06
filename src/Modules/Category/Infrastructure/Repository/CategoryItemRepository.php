<?php
namespace src\Modules\Category\Infrastructure\Repository;


use src\Core\Infrastructure\Repository\AbstractRepository;
use src\Modules\Category\Domain\Entity\CategoryItem;
use src\Modules\Category\Domain\Repository\CategoryItemRepositoryInterface;
use yii\db\Query;

class CategoryItemRepository extends AbstractRepository implements CategoryItemRepositoryInterface
{
    public function findOneById($id): ?CategoryItem
    {
        $source = (new Query())
            ->from(CategoryItem::TABLE_NAME)
            ->where(['id' => $id])
            ->one();
        if(!$source){
            return null;
        }

        return $this->mapper->map($source, new CategoryItem());
    }

    public function findAll(): array
    {
        $source = (new Query())->from(CategoryItem::TABLE_NAME)->all();
        return $this->mapper->mapItems($source, new CategoryItem());
    }

    public function findOneByItemName($name_item): ?CategoryItem
    {
        $source = (new Query())
            ->from(CategoryItem::TABLE_NAME)
            ->where(['item_name' => $name_item])
            ->one();
        if(!$source)
        {
            return null;
        }

        return $this->mapper->map($source, new CategoryItem());
    }
}