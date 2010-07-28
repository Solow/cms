<?php

class PagesController extends Zend_Controller_Action
{

    public function init()
    {
        echo "<pre>";
        print_r($this->_getParam('page'));
        die('you\'ve reached the pages controller init action!');
        $layout = new Solow_Pages_Layout();
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



