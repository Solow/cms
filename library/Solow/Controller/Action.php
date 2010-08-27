<?php
class Solow_Controller_Action extends Zend_Controller_Action
{
    protected $identity;
    protected $authConfig;
    
    public function init()
    {
        $this->parseConfig();
        $this->authCheck();
        $this->view->SetTheme('auth');     
        $this->_init();
    }
    
    protected function authCheck()
    {                                                                                                    
        $exceptions = $this->authConfig->auth->validate->exceptions->toArray();
        if( !in_array( $this->getRequest()->getControllerName(), $exceptions) && $this->getRequest()->getModuleName() != 'auth' )
        {
            $auth = Zend_Auth::getInstance();
            if($auth->hasIdentity())
            {
                $this->identity = $auth->getIdentity();    
            }
            else
            {
                if(isset($this->authConfig->auth->validate->notValidated->location))
                {                       
                    return $this->_helper->redirector->goToUrl($this->authConfig->auth->validate->notValidated->location);
                }
                else
                {
                    Throw new Exception('no on-fail action specified in config file.');
                }
            }     
        }
    }
                                      
    protected function parseConfig()
    {
        $this->authConfig = new Zend_Config_Ini(APPLICATION_PATH.'/modules/auth/configs/auth.ini', 'auth');    
        return $this->authConfig;
    }
}