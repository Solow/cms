<?php
class Admin_PagesController extends Solow_Controller_Action
{
    public function _init()
    {
        
    }

    public function indexAction()
    {
        
    }
    public function newAction()
    {
        $form = new Admin_Form_NewPage();
        $request = $this->getRequest();
        if ($request->isPost())
        {
            if ($form->isValid($request->getPost()))
            {
                $formValues = $form->getValues();
                #Array ( [uri] => /asasa [Pagename] => asasas [description] => asasas [Parent] => Homepage [keywords] => /asasas [changefreq] => always [priority] => 0.5 )
                #$this->_helper->redirector('index', 'index');
            }
            else
            {
                echo "Proccesing failed.";
            }
        }

        $this->view->form = $form;

    }
}