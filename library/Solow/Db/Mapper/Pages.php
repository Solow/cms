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

        /*
         * Wat sla ik op bij een pagina?
         * - Controller
         * - Action
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
         */
    }
}
?>
