<?php
class Solow_Navigation_Container
{
    public $nav;
    public $pages;

    public function __construct($renew=false)
    {
        return $this->initNavObject();
    }

    protected function initNavObject()
    {
        $pages = Solow_Cache::load('nav');
        if($pages)
        {
            $this->nav = $pages->nav;
            $this->pages = $pages->pages;
            return $this;
        }
        else
        {
            return $this->renewCache();
        }
    }

    public function renewCache()
    {
        $this->nav = new Zend_Navigation();
        $this->getPages();
        $this->nav->addPages($this->pages);
        Solow_Cache::save($this, 'nav');
        return $this;
    }

    protected function getPages()
    {
        $this->pages = $this->getChildPages('0');
    }

    protected function getChildPages($id)
    {
        $pages = array();
        $where = array
        (
            'parent = ?'=>$id,
            'visible = ?'=>'1'
        );
        $childPages = Solow_Mapper::_('pages')->getPages($where);
        foreach($childPages as $page)
        {
            $pages[] = array
            (
                'uri'=>$this->assembleUri($page->id),
                "label"=>$page->title,
                'lastmod'=>$page->lastmod,
                'changefreq'=>$page->changefreq,
                'priority'=>$page->priority

            );
            if(Solow_Mapper::_('pages')->hasChildren($page->id))
            {
                $children = $this->getChildPages($page->id);
                end($pages);
                $key = key($pages);
                $pages[$key]['pages'] = $children;
            }
        }
        return $pages;
    }

    protected function assembleUri($pageId)
    {
        //Get alias, on default and page id, and render url.
        #$fullUrl = Solow_Mapper::_('settings')->getOption('fullUrl');
        $seperator = Solow_Mapper::_('settings')->getOption('uriFormat');
        $pageAlias = Solow_Mapper::_('alias')->getDefaultUri($pageId);
        if($seperator == "/")
        {
            return $pageAlias;
        }
        switch($seperator)
        {
            case '_':
                //do stuff
                $pageAlias = '/'.str_replace('/', '_', substr($pageAlias,1));
                break;
        }
        return $pageAlias;
    }
}





