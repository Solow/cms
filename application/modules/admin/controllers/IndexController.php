<?php
class Admin_IndexController extends Solow_Controller_Action
{
    public function _init()
    {
        
    }

    public function indexAction()
    {
        $this->view->content = "Admin dashboard goes here.";
    }
}