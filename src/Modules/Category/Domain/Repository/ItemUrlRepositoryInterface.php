<?php


namespace src\Modules\Category\Domain\Repository;


use src\Core\Domain\Entities\EntityInterface;
use src\Modules\Category\Domain\Entity\ItemUrl;

interface ItemUrlRepositoryInterface
{
    public function findOneById($id): ?ItemUrl;

    public function findAll(): array;

    public function save(EntityInterface $entity): bool;

    public function delete(EntityInterface $entity): bool;  //!!!!Дописать удаление универсальное!
}