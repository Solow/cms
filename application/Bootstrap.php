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
    
    protected function _initPrevUri()
    {  
        $strArr = explode('/', $_SERVER['REQUEST_URI']);
        if($strArr[1] != 'auth')
        {
            $prevSession =  new Zend_Session_Namespace('prevUri');    
            $prevSession->uri = $_SERVER['REQUEST_URI'];    
        }
    }
}   