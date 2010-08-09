<?php
class Solow_Db_Mapper_Text extends Solow_Db_Mapper_Abstract
{
    public function init()
    {
        $this->setClassPrefix('Solow_Db_Table_');
        $this->setDbTable('Text');
    }

    public function getText($txtId)
    {
        $return = $this->fetchRow('id', $txtId);
        return $return;
    }
}