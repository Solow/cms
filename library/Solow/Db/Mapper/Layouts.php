<?php
class Solow_Db_Mapper_Layouts extends Solow_Db_Mapper_Abstract
{
    public function init()
    {
        $this->setClassPrefix('Solow_Db_Table_');
        $this->setDbTable('Layouts');
    }

    public function getOptions($layId)
    {
        $return = $this->fetchRow('id', $layId);
        return $return;
    }
}