<?php
class Lib_Application_Settings_Errors
{
    protected $configurable = array(
        'displayExceptions',
        'displayErrors',
        'displayStartupErrors',
        'errorReporting'
    );

    public function init($params)
    {
        foreach($params as $key=>$value)
        {
            if(in_array($key, $this->configurable))
            {
                if($key == "errorReporting")
                {
                    if(defined($value))
                    {
                        error_reporting($value);
                    }
                    else
                    {
                        Throw new Exception('Invalid error level '.$value);
                    }
                }
                elseif($value === '1' || $value === '0')
                {
                    switch($key)
                    {
                        case 'displayExceptions':
                            Lib_Registry::set('displayExceptions', (bool)$value);
                            break;
                        case 'displayErrors':
                            ini_set('display_errors', (bool)$value);
                            break;
                        case 'displayStartupErrors':
                            ini_set('display_startup_errors', (bool)$value);
                            break;
                    }
                }
                else
                {
                    Throw new Exception('Invalid value specified for '.$key);
                }
            }
            else
            {
                Throw new Exception('Non-configurable parameter given');
            }
        }
    }
}