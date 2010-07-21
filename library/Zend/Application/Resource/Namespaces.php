<?php
    class Zend_Application_Resource_Namespaces extends Zend_Application_Resource_ResourceAbstract 
    {                                                         
        public function init()
        {                                            
            $autoloader = Zend_Loader_Autoloader::getInstance();
            foreach ($this->getOptions() as $key => $value) 
            {                    
                $autoloader->registerNamespace($value);  
            }                                                        
        }        
             
    }   