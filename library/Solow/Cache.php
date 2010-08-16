<?php
class Solow_Cache
{
    private static $cache;

    private function __construct()
    {
    }

    protected static function initCache()
    {
        $cacheOptions = array(
            'lifetime'                => null,
            'automatic_serialization' => true
        );
        $backendOptions = array(
            'cache_dir' => realpath('../cache'),
        );

        self::$cache = Zend_Cache::factory('Core', 'File', $cacheOptions, $backendOptions);
    }

    public static function getInstance()
    {
        if (null === self::$cache) {
            self::initCache();
        }

        return self::$cache;
    }

    public static function save($data, $id, $tags = array(), $specificLifetime = false)
    {
        $cache = self::getInstance();
        $cache->save($data, $id, $tags, $specificLifetime);
    }

    public static function load($id, $doNotTestCacheValidity = false)
    {
        $cache = self::getInstance();
        $load = $cache->load($id, $doNotTestCacheValidity);
        return $load;
    }
}