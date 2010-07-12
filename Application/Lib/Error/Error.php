<?php
class Lib_Error_Error
{
    public static function errorHandler($errno, $errstr, $errfile, $errline)
    {
        if(Lib_Registry::get('displayErrors'))
        {
            echo "<p>";
            switch ($errno)
            {
                case E_USER_ERROR:
                    echo "<b>Error</b> [$errno] $errstr<br />\n";
                    echo " Fatal error on line $errline in file $errfile";
                    break;

                case E_USER_WARNING:
                    echo "<b>Warning</b> [$errno] $errstr<br />\n";
                    echo " Warning on line $errline in file $errfile";
                    break;

                case E_USER_NOTICE:
                    echo "<b>Notice</b> [$errno] $errstr<br />\n";
                    echo " On line $errline in file $errfile";
                    break;

                default:
                    echo "Error [$errno] $errstr<br />\n";
                    echo "On line $errline in file $errfile";
                    break;
            }
            echo "</p>";
            return true;
        }
        else
        {
            return true;
        }
    }
}