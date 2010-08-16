<?php
class Solow_Controller_Action extends Zend_Controller_Action
{
    public function init()
    {
        $this->view->SetTheme('admin');
        $this->_init();
    }
}