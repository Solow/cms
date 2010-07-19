<?php

class AuthController extends Zend_Controller_Action
{

    protected function _process($values)
    {
        // Get our authentication adapter and check credentials
        $adapter = $this->_getAuthAdapter($values);
        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate($adapter);
        if ($result->isValid())
        {
            $data = $adapter->getResultRowObject(null, array('password', 'salt'));
            $auth->getStorage()->write($data);
            return true;
        }
        return false;
    }

    protected function _getAuthAdapter($formData)
    {
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
        $authAdapter->setTableName('users')
            ->setIdentityColumn('username')
            ->setCredentialColumn('password')
            ->setCredentialTreatment('SHA1(concat(salt,?))');

        $fc = Zend_Controller_Front::getInstance();
        $options = $fc->getParam('bootstrap')->getOptions();
        $password = $formData['password'];

        $authAdapter->setIdentity($formData['username']);
        $authAdapter->setCredential($password);

        return $authAdapter;
    }


    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $form = new Application_Form_Login();
        $request = $this->getRequest();
        if ($request->isPost())
        {
            if ($form->isValid($request->getPost()))
            {
                if ($this->_process($form->getValues()))
                {
                    // Success: Redirect to the home page
                    $this->_helper->redirector('index', 'index');
                }
                else
                {
                    echo "Proccesing failed.";
                }
            }
            else
            {
                echo "Invalid password and/or username";
            }
        }
        $this->view->form = $form;
    }
}

