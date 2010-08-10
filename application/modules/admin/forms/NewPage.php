<?php
class Admin_Form_NewPage extends Zend_Form
{
    public function init()
    {
        $username = new Zend_Form_Element_Text('Username');
        $username->setValidators(array(
                'Alpha',
                array('StringLength', false, array(3, 20)),
            ));

        $username->setRequired(true);
        $username->setFilters(array('StringTrim', 'StringToLower'));
        $username->setLabel('Username:');
        $username->loadDefaultDecorators();
        $username->removeDecorator('Errors');
        $this->addElement($username);

        $password = new Zend_Form_Element_Password('Password');
        $password->setValidators(array(
                'Alnum',
                array('StringLength', false, array(6, 20)),
            ));

        $password->setRequired(true);
        $password->setFilters(array('StringTrim'));
        $password->setLabel('Password:');
        $password->loadDefaultDecorators();
        $password->removeDecorator('Errors');
        $this->addElement($password);




        $login = $this->addElement('submit', 'login', array(
            'required' => false,
            'ignore'   => true,
            'label'    => 'Login',
        ));

        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'dl', 'class' => 'zend_form')),
            array('Description', array('placement' => 'prepend')),
            'Form'
        ));
    }
}