<?php

namespace src\Core\Infrastructure\Mapper;

use Yii;
use yii\db\Exception;

class Mapper
{
    /**
     * @param $source
     * @param $target
     * @return object
     * @throws Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function map($source, $target): object
    {
        if (is_array($source))
        {
            $source = (object)$source;
        }

        if (!is_object($source))
        {
            throw new Exception('The type of source is not supported.');
        }

        if (!is_object($target))
        {
            $target = Yii::createObject($target);
        }

        foreach ($source as $property => $value) { //отбрасывание лишней требухи из массива
            if (!in_array($property, array_keys(get_object_vars($target)))) {
                continue;
            }
            $target->{$property} = $value;
        }
        return $target;
    }


    public function mapItems(array $sources, $class): array
    {
        if (is_object($class))
        {
            $class = get_class($class);
        }
        $result = [];
        foreach ($sources as $source)
        {
            $result[] = $this->map($source, $class);
        }
        return $result;
    }

    public function toArray(object $source): array
    {
        $properties = array_keys(get_object_vars($source));

        $values = array_map(function ($property) use ($source) {
            return $source->$property;
        }, $properties);
        return array_combine($properties, $values);
    }
}