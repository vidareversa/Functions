<?php

class ErrorHandler
{
    public function __construct()
    {
        set_error_handler(array($this, "errorHandler"));
    }

    public function errorHandler($errno, $errstr, $errfile, $errline)
    {
        /*
        if(!(error_reporting() & $errno)) {
            return;
        }
        */
        switch ($errno)
        {
            case E_USER_ERROR:
                echo "<b>ERROR</b> [$errno] $errstr<br />\n";
                echo "  Fatal error on line $errline in file $errfile";
                echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
                echo "Aborting...<br />\n";
                exit(1);
                break;

            case E_USER_WARNING:
                echo "<b>WARNING</b> [$errno] $errstr<br />\n";
                break;

            case E_USER_NOTICE:
                echo "<b>NOTICE</b> [$errno] $errstr<br />\n";
                break;

            default:
                echo "<b>UNKNOWN ERROR</b> [$errno] $errstr<br />\n";
                break;
        }
        
        return true;
    }
}
