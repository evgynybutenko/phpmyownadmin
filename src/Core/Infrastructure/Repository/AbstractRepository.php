<?php

namespace src\Core\Infrastructure\Repository;

use src\Core\Domain\Entities\EntityInterface;
use src\Core\Infrastructure\Mapper\Mapper;

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

    public function update(EntityInterface $entity)
    {
        $columns = $this->mapper->toArray($entity);
        unset($columns['id']);

        $result =  (bool)\Yii::$app->db
                ->createCommand()
                ->update(
                    $entity->getTableName(),
                    $columns,
                    ['id' => $entity->id]
                )
                ->execute();
        return $result;
    }

    public function insert(EntityInterface $entity)
    {
        $columns = $this->mapper->toArray($entity);

        $result =  (bool)\Yii::$app->db
            ->createCommand()
            ->insert(
                $entity->getTableName(),
                $columns)
            ->execute();
        return $result;
    }

}