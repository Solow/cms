<?php
abstract class Solow_Components_Abstract
{
    protected $page;
    protected $view;

    public function __construct($pageDetails)
    {
        $this->page = $pageDetails;
        $this->init();
    }

    abstract protected function init();

    abstract protected function render();
}