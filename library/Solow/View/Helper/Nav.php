<?php
class Solow_View_Helper_Nav
{
    public function nav()
    {
        return $this;
    }

    public function childrenHaveChildPages($pages)
    {
        foreach($pages as $page)
        {
            $childPages = $page->getPages();
            if(!empty($childPages))
            {
                return true;
            }
        }
        return false;
    }
}