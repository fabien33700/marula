<?php

    define('ROOTLIB', __DIR__);
    define('DS', DIRECTORY_SEPARATOR);
    define('NS', "\\");
    
    spl_autoload_register(function ($class)
    {
        require_once($class . '.php');
    });    
    
    require_once(ROOTLIB . "/vendor/spyc/Spyc.php");
    
?>