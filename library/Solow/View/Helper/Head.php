<?php
class Solow_View_Helper_Head
{
    protected $view;
    protected $contentLanguage = "en-US";
    protected $quirks=false;

    public function __toString()
    {
        return $this->renderHead();
    }

    public function Head()
    {
        return $this;
    }

    public function renderHead()
    {
        if($this->view->doctype()->isXhtml())
        {
            $head = $this->view->doctype().PHP_EOL;
            $head .= '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="'.$this->contentLanguage.'" lang="'.$this->contentLanguage.'">'.PHP_EOL;
        }
        else
        {
            if($this->quirks)
            {
                $head = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">'.PHP_EOL;
            }
            else
            {
                $head = ((bool)count($this->view->doctype())) ? $this->view->doctype().PHP_EOL."<html>".PHP_EOL : '<html>'.PHP_EOL;
            }
        }
        $head .= "<head>".PHP_EOL;

        if($this->contentLanguage != NULL)
        {
            $this->view->headMeta()->appendHttpEquiv('content-language', $this->contentLanguage);
        }
        $head .= ((bool)(count($this->view->headLink()))) ? $this->view->headLink().PHP_EOL : '';
        $head .= ((bool)(count($this->view->HeadMeta()))) ? $this->view->HeadMeta().PHP_EOL : '';
        $head .= ((bool)(count($this->view->HeadScript()))) ? $this->view->HeadScript().PHP_EOL : '';
        $head .= ((bool)(count($this->view->HeadStyle()))) ? $this->view->HeadStyle().PHP_EOL : '';
        $head .= ((bool)(count($this->view->HeadTitle()))) ? $this->view->HeadTitle().PHP_EOL : '';
        $head .= "</head>".PHP_EOL;
        return $head;
    }

    public function addCss($styleSheet)
    {
        $this->view->headLink()->appendStylesheet($styleSheet).PHP_EOL;
        return $this;
    }

    public function meta($name, $content)
    {
        $this->view->headMeta()->appendName($name, $content);
        return $this;
    }

    public function metaHE($name, $content)
    {
        $this->view->headMeta()->appendHttpEquiv($name, $content);
        return $this;
    }

    public function addJs($javascript)
    {
        $this->view->headScript()->appendFile($javascript).PHP_EOL;
        return $this;
    }

    public function setKeywords($keyWords)
    {
        $this->view->headMeta()->appendName('keywords', $keywords);
        return $this;
    }

    public function setDescription($description)
    {
        $this->view->headMeta()->appendName('description', $description);
        return $this;
    }

    public function disableCache()
    {
        $this->view->headMeta()->appendHttpEquiv('cache', 'NO-CACHE');
        $this->view->headMeta()->appendHttpEquiv('pragma', 'NO-CACHE');
        return $this;
    }

    public function disablePragma()
    {
        $this->view->headMeta()->appendHttpEquiv('cache', 'NO-CACHE');
        $this->view->headMeta()->appendHttpEquiv('pragma', 'NO-CACHE');
        return $this;
    }

    public function setFavicon($path)
    {
        $this->view->headLink()->headLink(array('rel' => 'favicon', 'href' => $this->favIcon));
        return $this;
    }

    public function setContentType($type="text/html; charset=UTF-8")
    {
        $this->view->headMeta()->appendHttpEquiv('content-type', $type);
        return $this;
    }

    public function setContentLanguage($lang = "en")
    {
        $this->contentLanguage = $lang;
        return $this;
    }

    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
        return $this;
    }

    public function appendTitle($title)
    {
        $this->view->headTitle($title);
        return $this;
    }

    public function titleSeperator($seperator)
    {
        $this->view->headTitle()->setSeparator($seperator);
        return $this;
    }

    public function setTitle($title)
    {
        $this->view->headTitle($title, 'SET');
        return $this;
    }

    public function setDoctype($docType)
    {
        $doctypeHelper = new Zend_View_Helper_Doctype();
        $doctypeHelper->doctype($docType);
        return $this;
    }

    public function triggerQuirksMode()
    {
        $doctypeHelper = new Zend_View_Helper_Doctype();
        $doctypeHelper->doctype('HTML4_LOOSE');
        $this->quirks = true;
        return $this;
    }
}