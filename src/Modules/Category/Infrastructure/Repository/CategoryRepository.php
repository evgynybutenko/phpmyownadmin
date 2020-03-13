<?php
namespace src\Modules\Category\Infrastructure\Repository;

use src\Core\Domain\Entities\EntityInterface;
use src\Core\Infrastructure\Repository\AbstractRepository;
use src\Modules\Category\Domain\Entity\Category;
use src\Modules\Category\Domain\Repository\CategoryRepositoryInterface;
use yii\db\Query;

class CategoryRepository extends AbstractRepository implements CategoryRepositoryInterface
{

    public function findOneById($id): ?Category
    {
        $source = (new Query())
            ->from(Category::getTableName())
            ->where(['id' => $id])
            ->one();
        if(!$source){
            return null;
        }

        return $this->mapper->map($source, new Category());
    }

    public function findOneByCategoryName($name_category): ?Category
    {
        $source = (new Query())
            ->from(Category::getTableName())
            ->where(['category_name' => $name_category])
            ->one();
        if(!$source)
        {
            return null;
        }

        return $this->mapper->map($source, new Category());
    }

    public function findAll(): array
    {
        $source = (new Query())
            ->from(Category::getTableName())
            ->all();
        return $this->mapper->mapItems($source, new Category());
    }



}