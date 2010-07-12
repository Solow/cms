<?php
class Lib_Error_Exception
{
    public static function exceptionHandler($exception)
    {
        if(Lib_Registry::get('displayExceptions'))
        {
            $trace = $exception->getTrace();
            $exceptionString = 'Fatal error. Uncaught Exception with message: \'
                '.$exception->getMessage().'\'.<br /><br />';
            $exceptionString .= '<strong>File:</strong> '.$exception->getFile()."<br />";
            $exceptionString .= '<strong>Line:</strong> '.$exception->getLine()."<br />";
            $exceptionString .= '<br /><strong>Trace:</strong><br />';
            $exceptionString .= self::formatTrace($trace);
            die($exceptionString);
        }
    }

    protected static function formatTrace($traceArray)
    {
        $trace = '';
        foreach($traceArray as $key=>$trail)
        {
            $trace .= "#".$key.": ".$trail['file'];
            $trace .= "(".$trail['line']."): <br />";
            if($trail['class'] != '')
            {
              $trace .= $trail['class'];
              $trace .= $trail['type'];
            }
            $trace .= $trail['function'];
            $trace .= '(';
            foreach($trail['args'] as $key=>$arg)
            {
                $trace .= $arg;
                $lkey = array_keys($trail['args']);
                if(end($lkey)!=$key)
                {
                    $trace .= ", ";
                }
            }
            $trace .= ")<br /><br />";
        }
        return $trace;
    }
}