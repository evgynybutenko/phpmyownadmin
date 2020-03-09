<?php

namespace src\Core\Domain\Entities;

/**
 * Interface EntityInterface
 * @package src\Core\Domain\Entities
 * @property int id
 */

interface EntityInterface
{
    public static function getTableName();
}