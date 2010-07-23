<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initDoctype()
    {
        $doctypeHelper = new Zend_View_Helper_Doctype();
        $doctypeHelper->doctype('XHTML1_STRICT');
    }

    protected function _initRouter()
    {
        $this->bootstrap('frontController');
        $frontController = $this->getResource('frontController');
        $router = $frontController->getRouter();
        $router->addRoute(
            'aName',
            new Solow_Controller_Router_Route_DbRoute()
        );
    }
}

