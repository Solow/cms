<?php          
abstract class Solow_Db_Mapper_Abstract
{
    protected $_dbTable;   
    protected $_prefix;   
    
    public function __construct()
    {
        $this->init();
    }
    
    abstract public function init();
    
    public function setClassPrefix($prefix)
    {
        $this->_prefix = $prefix;
    }
                                      
    public function setDbTable($dbTable)   
    {                                             
        if (is_string($dbTable)) 
        {                    
            $class = $this->_prefix.$dbTable;
            $this->validateTableSetDbTable(new $class());
        }              
        elseif(is_object($dbTable))
        {
            $this->validateTableSetDbTable($dbTable);
        }                                  
        else
        {     
            print_r($dbTable);
            die();                     
            #throw new Exception('Invalid data type for setDbTable().');  
        }
        return $this;       
    }
    
    public function getDbTable($dbTable = NULL)
    {                 
        if(isset($this->_dbTable))
        {                                    
            return $this->_dbTable;  
        }
        else
        {
            throw new Exception('No table set.');
        }
    }
    
    public function validateTableSetDbTable($table)
    {
        $this->validateTable($table);
        $this->_dbTable = $table;  
        return $this;        
    } 
    
    public function validateTable($table)
    {
        if (!$table instanceof Zend_Db_Table_Abstract) 
        {           
            throw new Exception('Invalid table data gateway provided. No table methods available');   
        }                           
        return true;       
    }    
    
    public function fetchAllArray($fetch, $objectName, $page=false)
    {                                  
        $entries = array();                                
        if(is_array($fetch))
        {
            foreach($fetch as $tag=>$value)
            {
                $page = (!$page) ? false : $page;        
                $entries[$tag] = $this->fetchAllSingle($value, $objectName, $page);  
            } 
        }     
        else
        {
            $entries = $this->fetchAllSingle($value, $objectName, $page); 
        }
        return $entries;
    }                              
    
    public function fetchAllSingle($value, $objectName, $page=false)
    {
        if(array_key_exists('table', $value))
        {
            if($value['table'] != 'current')
            {
                $this->setDbTable($value['table']);
            }
        }
        else
        {
            Throw new Exception('No table assigned in '.__CLASS__.' on line '.__LINE__);            
        }  
        $select = $this->getDbTable()->select();
        if(array_key_exists('what', $value))
        {
            $tableName = $this->getDbTable()->info(Zend_Db_Table::NAME);  
            $select->from($tableName, $value['what']);    
        }
        else
        {
            $tableName = $this->getDbTable()->info(Zend_Db_Table::NAME);  
            $select->from($tableName, '*');
        }
        if(array_key_exists('where', $value))
        {
            foreach($value['where'] as $where => $is)
            {                                     
                $select->where($where, $is);   
            }                                               
        }       
        $rowsPerPage = 20;
        $entries = array();       
        if(is_numeric($page) && $page > 0 && $page != false)
        {                                    
            $offset = ($page - 1) * $rowsPerPage;
            $select->limit($rowsPerPage, $offset);
        } 
        $results = $this->getDbTable()->fetchAll($select); 
        foreach($results as $row)
        {      
            $entry = new $objectName();  
            foreach($row as $rowa=>$value)
            {                           
                $entry->$rowa = $value;
            }              
            $entries[] = $entry;  
        }                     
        return $entries;   
    }

    protected function fetchValue($col, $row)
    {
        $table = $this->getDbTable()->info(Zend_Db_Table::NAME);
        $db = $this->getDbTable()->getAdapter();
        $sql = "select $col from $table where id = ?";
        $result = ($result = $db->fetchOne($sql,$row))?$result:'error';
        return $result;
    }

    protected function checkExistence($col, $value)
    {
        $table = $this->getDbTable()->info(Zend_Db_Table::NAME);
        $db = $this->getDbTable()->getAdapter();
        $sql = "select $col from $table where $col = ?";
        $result = $db->fetchRow($sql,$value);
        return (bool)$result;
    }
}                                        
