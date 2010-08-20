<?php
class Solow_Validate_InArray extends Zend_Validate_Abstract
{
    protected $matchTag;

    public function __construct($matchTag)
    {
        $this->_setValue($matchTag);
    }

    public function isValid($array)
    {
        if(isset($array[$this->value]))
        {
            $setArray = $array[$this->value];
            return $setArray;
        }
        else
        {
            return false;
        }
    }
}