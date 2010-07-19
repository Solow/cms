<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        $this->view->layout()->setLayout('default');
        $this->view->SetTheme();

        /* Initialize action controller here */
    }

    public function indexAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity())
        {
            $username = $auth->getStorage()->read()->salt;
            $url = $this->view->url(array('controller'=>'auth',
            'action'=>'logout'), null, true);
            $this->view->message = 'Welcome '.$username.'<a href="'.$url.'">Logout</a>';
        }
        else
        {
            $url = $this->view->url(array('controller'=>'auth',
            'action'=>'index'), null, true);
            $this->view->message = 'You\'re currently not logged in. <a href="'.$url.'">Login</a>';
        }
    }


}

