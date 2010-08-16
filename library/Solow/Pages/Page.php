<?php
class Solow_Pages_Page
{
    protected $pageDetails = array();
    protected $params = array();

    public function setPageDetails($arr)
    {
        $this->pageDetails = $arr;
        return $this;
    }

    public function setPageDetail($key, $value)
    {
        $this->params[$key] = $value;
        return $this;
    }

    public function __get($key)
    {
        $return = (isset($this->pageDetails[$key])) ? $this->pageDetails[$key] : $this->params[$key];
        return $return;
    }

    public function __set($key, $value)
    {
        $this->setPageDetail($key, $value);
    }
}

#<link rel="canonical" href="http://www.voorbeeld.nl/game-naam/" />
#if(page != default use canonica