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
}

#<link rel="canonical" href="http://www.voorbeeld.nl/game-naam/" />
#if(page != default use canonical