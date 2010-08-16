<?php
class Solow_Db_Storage_Content
{
    protected $_dbData = array();

    public function __set($key, $value)
    {
        $this->_dbData[$key] = $value;
        return $this;
    }

    public function __get($key)
    {
        return $this->_dbData[$key];
    }
}