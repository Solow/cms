<?php
class Lib_Autoloader
{
    function autoload($class_name)
    {
        $incFile = PROJECT_ROOT."/Application/".str_replace('_', DIRECTORY_SEPARATOR, $class_name).'.php';
        if(file_exists($incFile))
        {
            require_once($incFile);
        }
        else
        {
            Throw new Exception('Class <'.$class_name.'> not found. File not found:'.$incFile);
        }
    }
}       