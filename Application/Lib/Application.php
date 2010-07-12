<?php
Class Lib_Application
{
    public function __construct()
    {
        $this->defineProjectRoot();
        $this->newAutoloader();
        $this->setExceptionHandler();
        $this->setErrorHandler();
        $this->parseConfig();
    }

    protected function parseConfig()
    {
        $config = new Lib_Config();
        $config->parseConfig();
    }

    public function newAutoloader()
    {
        require_once(PROJECT_ROOT.'/Application/Lib/Autoloader.php');
        $autoloader = new Lib_Autoloader();
        spl_autoload_register( array($autoloader, 'autoload') );
    }

    public function setExceptionHandler($array=array('Lib_Error_Exception', 'exceptionHandler'))
    {
        set_exception_handler($array);
    }

    public function setErrorHandler($array=array('Lib_Error_Error', 'errorHandler'))
    {
        set_error_handler($array);
    }

    public function defineProjectRoot()
    {
        $base = $_SERVER['DOCUMENT_ROOT'];
        $sdir = $_SERVER['PHP_SELF'];
        $projectRoot = $base.mb_substr($sdir,0,-mb_strlen(strrchr($sdir,"/"))) ;
        define("PROJECT_ROOT", $projectRoot);
    }
}