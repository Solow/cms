<?php
class Solow_Db_Mapper_Pages extends Solow_Db_Mapper_Abstract
{
    public function init()
    {
        $this->setClassPrefix('Solow_Db_Table_');
        $this->setDbTable('Page');
    }

    public function find($path)
    {
        /*
         *
         * Gesprek met mezelf:
         *
         * Waar check ik de seperator/ type?
         * - pages mapper
         *
         * Wat sla ik op bij een pagina?
         * - slug
         *
         * Waar match ik op?
         * - slug OF page/sub/sub/sub, where the current used 'lets say _' is replaced by '/', so i can match.
         * - id (ligt aan de settings)
         *
         * mogelijke methodes:
         * - slug
         * - parent/child/child/
         * - /id
         *
         * gebruik:
         * voor Zend_Navigation_Page, de uri.
         * http://framework.zend.com/manual/en/zend.navigation.pages.html#zend.navigation.pages.uri
         * 
         */

        $uriFormat = Solow_Mapper::_('settings')->getOption('uriFormat');
        $preSlug = trim($path->getPathInfo(), '/');
        switch($uriFormat)
        {
            case '.html':
                $preSlug = rtrim($preSlug, '.html');
                $preSlug = explode('_', $preSlug);
                $us = true;
                break;
            case '_':
                $preSlug = explode('_', $preSlug);
                $us = true;
                break;
            case '/':
                $preSlug = explode('/', $preSlug);
                $us = true;
                break;
            case 'id':
                $preSlug = explode('/', $preSlug);
                $id = array_shift($preSlug);
                $us = false;
                break;
            default:
                break;
        }
        if($us)
        {
            $slug = implode('/', $preSlug);
            $slug = strtolower((empty($slug)) ? '/index' : '/'.$slug);
            if($this->checkExistence('alias', $slug, 'alias'))
            {
                $page = new Solow_Pages_Page();
                $row = $this->fetchRow('alias', $slug, 'alias');
                $page->setPageDetails($row);
            }
            else
            {
                return false;
            }
        }
        else
        {
            if($this->checkExistence('id', $id))
            {
                $page = new Solow_Pages_Page();
                $row = $this->fetchRow('id', $id);
                $page->setPageDetails('page', $row);
            }
            else
            {
                return false;
            }
        }
        return $page;
    }
}
?>
