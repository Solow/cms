<?php
class Lib_Registry
{
    protected static $registry;

    static public function set($key, $value)
    {
        self::$registry[$key] = $value;
    }

    static public function get($key)
    {
        if(isset (self::$registry[$key]))
        {
            return self::$registry[$key];
        }
    }
}