<?php
class Lib_Config
{
    public function parseConfig()
    {
        $config = parse_ini_file("Application/Configs/Application.ini");
        $sortedConfig = $this->devideConfig($config);
        $this->callResources($sortedConfig);
    }

    protected function devideConfig($iniArray)
    {
        $sortedConfig = array();
        foreach($iniArray as $object => $value)
        {
            $diffs = explode('.',$object);
            try
            {
                if(count($diffs) < 3)
                {
                    Throw new Exception('Invalid resource specified in file: Application.ini:
                                         "'.$object.' = '.$value.'"');
                }
            }
            catch(Exception $cError)
            {
                if(!Lib_Registry::get('displayExceptions'))
                    echo $cError->getMessage();
            }
            $class = "Lib_Application_".ucfirst($diffs[0])."_".ucfirst($diffs[1]);
            $aSlice = array_slice($diffs, 2);
            $aSlice = implode('.',$aSlice);
            $sortedConfig[$class][$aSlice] = $value;
        }
        return $sortedConfig;
    }

    protected function callResources($resources)
    {
        foreach($resources as $resource=>$pArray)
        {
            $tmpObject = new $resource();
            $tmpObject->init($pArray);
        }
    }
}