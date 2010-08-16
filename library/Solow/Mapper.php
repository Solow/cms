<?php
class Solow_Mapper
{
    public static function _($mapper)
    {
        $mapper = "Solow_Db_Mapper_".ucfirst($mapper);
        return new $mapper();
    }
}