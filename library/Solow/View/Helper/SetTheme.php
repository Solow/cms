<?php
class Solow_View_Helper_SetTheme
{
    public $view;

    public function SetTheme($theme)
    {
        $themePath = rtrim(Zend_Controller_Front::getInstance()->getBaseUrl()).'/themes/'.$theme;
        $this->view->layout()->setLayoutPath(THEMES_PATH.'/'.$theme.'/');
        $this->view->layout()->setLayout($theme);
        $this->view->themePath = $themePath;
    }

    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
    }
}
