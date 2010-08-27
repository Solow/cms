<?php                        
class Auth_IndexController extends Solow_Controller_Action
{     
    public function _init()
    {                              
    }

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

    public function indexAction()
    {
        $form = new Auth_Form_Login();
        $request = $this->getRequest();
        if ($request->isPost())
        {
            if ($form->isValid($request->getPost()))
            {
                if ($this->_process($form->getValues()))
                {
                    $successLocation = $this->authConfig->auth->validate->onAuthentication->location->toArray();
                    $successLocation = array_map('trim',$successLocation);
                    if(count($successLocation) > 1)
                    {
                        $redirUri = "/auth/index/success";
                    }  
                    else                                                  
                    {                                             
                        if(in_array('previous', $successLocation))
                        {              
                            $uriSessionCheck =  new Zend_Session_Namespace('prevUri');
                            if(isset($uriSessionCheck->uri))
                            {              
                                $modUri = explode('/', $uriSessionCheck->uri);   
                                if($modUri[1] != 'auth')
                                {
                                    $redirUri = $uriSessionCheck->uri;
                                    Zend_Session::namespaceUnset('prevUri');   
                                }
                                else
                                {
                                    $redirUri = '/admin';   
                                }                       
                            }
                            else
                            {
                                $redirUri = '/admin';   
                            }                       
                        }
                        elseif(in_array('root', $successLocation))
                        {
                            $redirUri = '/admin';      
                        }
                        else
                        {
                            $redirUri = $successLocation[0];
                        }               
                    }
                    $this->_helper->redirector->goToUrl($redirUri);                                                    
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
    
    public function successAction()
    {
        //List possible locations, with checkbox, 'make this my default location.'
    }
    
    public function logoutAction()
    {
        $this->getHelper('layout')->disableLayout();
        $this->getHelper('viewRenderer')->setNoRender();
        Zend_Auth::getInstance()->clearIdentity();
        return $this->_helper->redirector->goToUrl($this->authConfig->auth->validate->notValidated->location);
    }
}                        