<?php
class Solow_Pages_Layout
{
    protected $options;
    protected $view;
    protected $page;

    public function __construct($page)
    {
        $this->page = $page;
        $this->getLayout()->setView();
        $this->view->SetTheme($this->getOption('path'));
        $this->setHead();
    }

    protected function getLayout()
    {
        $layoutId = Solow_Mapper::_('settings')->getOption('layoutId');
        $this->options = Solow_Mapper::_('layouts')->getOptions($layoutId);
        return $this;
    }

    public function getOption($key)
    {
        return $this->options[$key];
    }

    public function setView()
    {
        $this->view = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer')->view;
        return $this;
    }

    protected function setHead()
    {
        $this->view->head()->setKeywords($this->page->keywords);
        $this->view->head()->setDescription($this->page->description);
        $siteTitle = Solow_Mapper::_('settings')->getOption('websiteName');
        $this->view->head()->titleSeperator(' '.Solow_Mapper::_('settings')->getOption('titleSeperator').' ');
        $titleOrder = Solow_Mapper::_('settings')->getOption('titleOrder');
        $pageTitle = $this->page->title;

        if($titleOrder == "append")
        {
            $this->view->head()->appendTitle($siteTitle);
            $this->view->head()->appendTitle($this->page->title);
        }
        else
        {
            $this->view->head()->appendTitle($this->page->title);
            $this->view->head()->appendTitle($siteTitle);
        }

    }
}