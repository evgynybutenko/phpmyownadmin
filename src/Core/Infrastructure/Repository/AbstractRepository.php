<?php

namespace src\Core\Infrastructure\Repository;

use src\Core\Domain\Entities\EntityInterface;
use src\Core\Infrastructure\Mapper\Mapper;
use Yii;
use yii\db\Expression;

abstract class AbstractRepository
{
    protected $mapper;

    public function __construct(Mapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function save(EntityInterface $entity): bool {
        return $entity->id ?
            $this->update($entity) :
            $this->insert($entity);
    }

    public function delete(EntityInterface $entity): bool
    {
        return (bool)\Yii::$app->db->createCommand()
            ->delete($entity->getTableName(), ['category_name' => $entity->category_name])
            ->execute();
    }

    public function deleteItem(EntityInterface $entity): bool
    {
        return (bool)\Yii::$app->db->createCommand()
            ->delete($entity->getTableName(), ['item_name' => $entity->item_name])
            ->execute();
    }

    public function update(EntityInterface $entity)
    {
        $columns = $this->mapper->toArray($entity);


        return (bool)\Yii::$app->db
                ->createCommand()
                ->update(
                    $entity->getTableName(),
                    $columns,
                    ['id' => $entity->id]
                )
                ->execute();

    }

    public function insert(EntityInterface $entity)
    {
        $columns = $this->mapper->toArray($entity);


        foreach ($columns as $key => $value) {
            if(is_null($value))
            {
                $columns[$key] = new Expression("DEFAULT");
            }
        }

        return (bool)\Yii::$app->db
            ->createCommand()
            ->insert(
                $entity->getTableName(),
                $columns)
            ->execute();
    }



}