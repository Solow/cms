<?php
class Solow_Components_Components
{
    protected $page;
    protected $contents;
    protected $view;

    public function __construct($pageDetails)
    {
        $this->page = $pageDetails;
        $this->setView()->setContents();
    }

    public function setContents()
    {
        $contents = Solow_Mapper::_('content')->getContents($this->page->id);
        $this->contents = $contents;
    }

    public function getContents()
    {
        return $this->contents;
    }
    
    public function setComponents()
    {
        if(!empty($this->contents))
        {
            foreach($this->contents as $conObj)
            {
                $compObj = "Solow_Components_Component_".ucfirst($conObj->type);
                $componentHandler = new $compObj($conObj);
                $this->view->page()->appendArea($conObj->area, $componentHandler);
            }
        }
    }

    public function setView()
    {
        $this->view = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer')->view;
        return $this;
    }


}

/*
 * Render all content components, and send them to the view helper. Only output should be sent, like this:
 * $this->view->page()->setAreaContent('content', $content);
 * in the view file (layout) I can call all content output at once with:
 * echo $this->page()->getArea('content');
 */