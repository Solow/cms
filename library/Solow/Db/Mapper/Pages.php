<?php
class Solow_Db_Mapper_Pages extends Solow_Db_Mapper_Abstract
{
    public function init()
    {
        $this->setDbTable('Solow_Db_Mapper_Table_Page');
    }

    public function find($what, $where)
    {
        $fetchTable = array(
            'table'=> 'current',
            'what' => array(
                'id'
            ),
            'where'=>array(
                $where.' = ?' => $what
            )
        );
        $resTables = $this->fetchAllSingle($fetchTable, 'Customers_Model_Customers');
    }
}
?>
