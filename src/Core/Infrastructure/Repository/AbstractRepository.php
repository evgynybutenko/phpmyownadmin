<?php

namespace src\Core\Infrastructure\Repository;

use src\Core\Domain\Entities\EntityInterface;
use src\Core\Infrastructure\Mapper\Mapper;
use src\Modules\DynamicEntity\Domain\Entity\DynamicEntity;
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
            ->delete($entity->getTableName(), ['id' => $entity->id])
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
                $columns[$key] = new Expression("DEFAULT");
        }

        return (bool)\Yii::$app->db
            ->createCommand()
            ->insert(
                $entity->getTableName(),
                $columns)
            ->execute();
    }

    public function dynamicSave(DynamicEntity $entity)    //использовать обычный save/del
    {
        $columns = $entity->attributes;
        unset($columns['_csrf-backend']);

        if($columns['id'] == '')
            $columns['id'] = null;

        foreach ($columns as $key => $value) {
            if(is_null($value))
                $columns[$key] = new Expression("DEFAULT");
        }

        return (bool)\Yii::$app->db
            ->createCommand()
            ->insert(
                $entity->getTableName(),
                $columns)
            ->execute();
    }

    public function dynamicDel(DynamicEntity $entity)
    {
        return (bool)\Yii::$app->db->createCommand()
            ->delete($entity->getTableName(), ['id' => $entity->id])
            ->execute();
    }
}