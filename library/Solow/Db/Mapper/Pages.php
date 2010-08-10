<?php
class Solow_Db_Mapper_Pages extends Solow_Db_Mapper_Abstract
{
    public function init()
    {
        $this->setClassPrefix('Solow_Db_Table_');
        $this->setDbTable('Page');
    }

    public function getPages($where)
    {
        $value = array
        (
            "table"=>"current",
            "where"=>$where,
            "order"=>"rank ASC"
        );
        return $this->fetchAllSingle($value, 'Solow_Pages_Page');
    }

    public function addPage($pageDetails)
    {
        
    }

    public function hasChildren($id)
    {
        return $this->checkExistence('parent', $id);
    }

    public function find($path, $error=false)
    {
        //500, ask for explanation, and send to bug tracker.
        //In app, use 'uri' component to link within the website. When a page or alias gets removed, or changed, either change the uri component as well,
        //Or set the uri component to status 404, so that the uri will become bold, with a stroke.
        ////Also include language packages, and language page to page redirects with a message.
        $uriFormat = Solow_Mapper::_('settings')->getOption('uriFormat');
        $preSlug = (!$error) ? trim($path->getPathInfo(), '/') : trim($path, '/');

        switch($uriFormat)
        {
            case '_':
                $preSlug = explode('_p_', $preSlug);
                $params = (isset($preSlug[1])) ? explode('/',$preSlug[1]) : array();
                $preSlug = explode('_', $preSlug[0]);
                $us = true;
                break;
            case '/':
                $preSlug = explode('/p/', $preSlug);
                $params = (isset($preSlug[1])) ? $preSlug[1] : '';
                $preSlug = explode('/', $preSlug[0]);
                $us = true;
                break;
            default:
                break;
        }
        $slug = implode('/', $preSlug);
        $slug = strtolower((empty($slug)) ? '/index' : '/'.$slug);
        $db = $this->getDbTable()->getAdapter();
        $sql = "SELECT * FROM `alias` where ? LIKE concat(alias, '%') AND LENGTH(alias)>1 ORDER BY LENGTH(alias) DESC LIMIT 1";
        $result = $db->fetchRow($sql, $slug);
        if($result)
        {
            $row = $this->fetchRow('alias', $result['alias'], 'alias');
            $page = new Solow_Pages_Page();
            $page->setPageDetails($row);
            $page->setPageDetails($this->fetchRow('id', $page->pageId));

            if($result['alias'] != $slug)
            {
                if(Solow_Mapper::_('settings')->getOption('smartBrowse') == 1)
                {
                    $page->smartBrowse = array('notFound'=>$slug, 'found'=>$result['alias']);
                }
                else
                {
                    return false;
                }
            }
            if(!empty($params))
            {
                if (preg_match_all('/([^\/]+)(\/([^\/]+)+)?/', $params, $matches))
                $page->params = array_combine($matches[1], $matches[3]);
            }
        }
        else
        {
            return false;
        }
        return $page;
    }
}
?>
