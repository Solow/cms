<?php
class Solow_Db_Mapper_Alias extends Solow_Db_Mapper_Abstract
{
    public function init()
    {
        $this->setClassPrefix('Solow_Db_Table_');
        $this->setDbTable('Alias');
    }

    public function getDefaultUri($pageId)
    {
        $db = $this->getDbTable()->getAdapter();
        $sql = "select alias from alias where `default` = 1 and pageId = ?";
        $result = ($result = $db->fetchOne($sql,$pageId))?$result:'error';
        return $result;
    }

    public function isBase($pageId)
    {
        $db = $this->getDbTable()->getAdapter();
        $sql = "select isBase from alias where `default` = 1 and pageId = ?";
        $result = ($result = $db->fetchOne($sql,$pageId))?$result:'error';
        return (bool)$result;
    }
}