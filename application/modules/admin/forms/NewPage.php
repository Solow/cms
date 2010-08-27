<?php
class Admin_Form_NewPage extends Zend_Form
{
    public function init()
    {
        $this->setAction('/admin/pages/new');

         //Uri of the page
        $uri = new Zend_Form_Element_Text('uri');
        $uri->setValidators(array(
            array('StringLength', false, array(3, 80))
        ));

        $uri->setRequired(true);
        $uri->addFilter(new Zend_Filter_StringToLower());
        $uri->setLabel('Page uri:');
        $uri->loadDefaultDecorators();
        $uri->setValue('/');
        $this->addElement($uri);

         //Name of the page
        $Pagename = new Zend_Form_Element_Text('Pagename');
        $Pagename->setValidators(array(
            array('StringLength', false, array(3, 80))
        ));

        $Pagename->setRequired(true);
        $Pagename->addFilter(new Zend_Filter_StringTrim())
                 ->addFilter(new Zend_Filter_Alnum(true))
                 ->addFilter(new Zend_Filter_StringToLower())
                 ->addFilter(new Zend_Filter_Word_SeparatorToDash());
        $Pagename->setLabel('Page name:');
        $Pagename->loadDefaultDecorators();
        $this->addElement($Pagename);

        //Description of the page
        $description = new Zend_Form_Element_Text('description');
        $description->setValidators(array(
            array('StringLength', false, array(3, 160)),
            array('alnum')
        ));
        $description->setRequired(true);
        $description->addFilter(new Zend_Filter_StringTrim())
                    ->addFilter(new Zend_Filter_Alnum(true))
                    ->addFilter(new Zend_Filter_StringToLower());
        $description->setLabel('Page description:');
        $description->loadDefaultDecorators();
        $this->addElement($description);

        //Choose parent page
        $select = new Solow_Form_Element_SelectIterate('Parent');
        $select->setLabel('Parent page: ');
        $select->setOptionKeys('label', 'uri');
        $select->setIterateOver($this->getPages());
        $select->setIterateOn(new Solow_Validate_InArray('pages'));
        $select->setChildrenIteratorKey('pages');
        $select->buildElement();
        $this->addElement($select);



        //Keywords
        $keywords = new Zend_Form_Element_Text('keywords');
        $keywords->setValidators(array(
            array('StringLength', false, array(3, 80))
        ));
        $keywords->setRequired(true);
        $keywords->addFilter(new Zend_Filter_StringToLower());
        $keywords->setLabel('keywords:');
        $keywords->loadDefaultDecorators();
        $keywords->setValue('/');
        $this->addElement($keywords);



        $changefreqArr = array('always', 'hourly', 'daily', 'weekly', 'monthly', 'yearly', 'never');
        $changefreq = new Solow_Form_Element_SelectIterate('changefreq');
        $changefreq->setLabel('Change frequenty: ');
        $changefreq->setIterateOver($changefreqArr);
        $changefreq->buildElement();
        $this->addElement($changefreq);



        $priortyArr = array('0.0', '0.1', '0.2', '0.3', '0.4', '0.5', '0.6', '0.7', '0.8', '0.9', '1.0');
        $priority = new Solow_Form_Element_SelectIterate('priority');
        $priority->setLabel('Priority: ');
        $priority->setIterateOver($priortyArr);
        $priority->setDefault('0.5');
        $priority->buildElement();
        $this->addElement($priority);

        $elements = array('keywords', 'changefreq', 'priority');

        $dpGroup = $this->addDisplayGroup($elements, 'optional');
        $this->getDisplayGroup('optional')->setAttrib('id', 'optionalField');


        $login = $this->addElement('submit', 'newpage', array(
            'required' => false,
            'ignore'   => true,
            'label'    => 'Create Page',
        ));

        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'dl', 'class' => 'zend_form')),
            array('Description', array('placement' => 'prepend')),
            'Form'
        ));
    }

    protected function getPages()
    {
        $navObject = new Solow_Navigation_Container();
        return $navObject->pages;
    }

}