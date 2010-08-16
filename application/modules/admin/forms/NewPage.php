<?php
class Admin_Form_NewPage extends Zend_Form
{
    public function init()
    {
        /*
         * [Required fields]
         * title
         * description //A description about the page
         * parent //none or {page}
         * visible //Publish, or draft.
         * rank //append {page} or prepand {page}
         *
         * [optional uri settings]
         * alias //by default /parent/child/title-of-page
         *
         * [SEO settings (optional, set by default.)]
         * keywords //Use description, and title by default.
         * lastmod
         * changefreq
         * priority
         */

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
        $parent = $this->addZendFormElementSelect('parent', 'Parent page:');


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

    protected function addZendFormElementSelect($name, $label)
    {
        $navObject = new Solow_Navigation_Container();
        $zendFormElementSelect = new Zend_Form_Element_Select($name);
        $zendFormElementSelect = $this->getPages($navObject->pages, $zendFormElementSelect);

        $zendFormElementSelect->setLabel($label);
        $zendFormElementSelect->loadDefaultDecorators();
        $this->addElement($zendFormElementSelect);
    }

    protected function getPages($pages, $object)
    {
        foreach($pages as $page)
        {
            $object->addMultiOption($page['label'], $page['uri']);
            if (isset($page['pages']))
            {
                $this->getPages($page['pages'], $object);
            }
        }
        return $object;
    }

}













