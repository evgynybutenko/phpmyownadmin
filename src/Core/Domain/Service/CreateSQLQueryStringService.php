<?php

namespace src\Core\Domain\Service;

class CreateSQLQueryStringService
{
    public function parseQuery($tableName, $dataToCreate)
    {
        $stringToCreate = "CREATE TABLE \"public\".\"".$tableName."\" ( ";
        $names = $dataToCreate['names'];
        $type = $dataToCreate['type'];
        $index = $dataToCreate['index'];

        for($i = 0; $i < count($names); $i++)
        {
            if($i == 0)
            {
                $stringToCreate = $stringToCreate."\"".$names[$i]."\" ".$type[$i]." NOT NULL ";
            } else
            {
                $stringToCreate = $stringToCreate.", \"".$names[$i]."\" ".$type[$i]." NOT NULL ";
            }
        }
        for($i = 0; $i < count($index); $i++)
        {
            if($index[$i] == 'PRIMARY')
            {
                $stringToCreate = $stringToCreate.", PRIMARY KEY (\"".$names[$i]."\")";
            }
        }
        $stringToCreate = $stringToCreate.")";
        return $stringToCreate;
    }

}