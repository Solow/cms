<?php
class Auth_Form_Login extends Zend_Form
{

    public function init()
    {
        $this->addElement('text', 'username', array(
            'filters' => array('StringTrim', 'StringToLower'),
            'required' => true,
            'label' => 'Username:',
        ));
        $this->addElement('password', 'password', array(
            'filters' => array('StringTrim'),
            'required' => true,
            'label' => 'Password:',
        ));
        $this->addElement('submit', 'login', array(
            'required' => false,
            'ignore' => true,
            'label' => 'Login',
        ));
    }
}

