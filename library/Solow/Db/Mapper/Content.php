<?php
class Solow_Db_Mapper_Content extends Solow_Db_Mapper_Abstract
{
    public function init()
    {
        $this->setClassPrefix('Solow_Db_Table_');
        $this->setDbTable('Content');
    }

    public function getContents($pageId)
    {
        $selectInfo = array
        (
            "table"=>'current',
            "where" => array
            (
                "pageId = ?" => $pageId
            ),
            "order"=>"rank ASC"
        );
        if($this->checkExistence('pageId', $pageId))
        {
            $return = $this->fetchAllSingle($selectInfo, 'Solow_Db_Storage_Content');
        }
        else
        {
            $return = '';
        }
        return $return;
    }
}