<?php
class Admin_PagesController extends Solow_Controller_Action
{
    public function _init()
    {
        
    }

    public function indexAction()
    {
        $form = new Admin_Form_NewPage();
        $request = $this->getRequest();
        if ($request->isPost())
        {
            if ($form->isValid($request->getPost()))
            {
                $formValues = $form->getValues();
                die($formValues['Pagename']);
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