<?php
class PagesController extends Zend_Controller_Action
{

    public function init()
    {
        $nav = new Solow_Navigation_Container();
        $this->view->navigation($nav->nav);
        $layout = new Solow_Pages_Layout($this->_getParam('page'));
        $components = new Solow_Components_Components($this->_getParam('page'));
        $components->setComponents();
    }

    public function indexAction()
    {
        // action body
    }

    public function pageAction()
    {
        // action body
    }


}



