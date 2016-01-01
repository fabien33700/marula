<?php

    define('LIB_PREFIX', "Marula");
    
    define('BASEDIR', dirname(__DIR__));
    define('DS', DIRECTORY_SEPARATOR);
    define('NS', "\\");
    
    spl_autoload_register(function ($class)
    {
        $classArray  = explode(NS, $class);
        $className   = array_pop($classArray);
        $classPrefix = implode(NS, $classArray);
        
        if ($classPrefix !== LIB_PREFIX) return;
        
        $classFilename = BASEDIR . DS . LIB_PREFIX . DS . $className . '.php';
        
        if (file_exists($classFilename))
            require $classFilename;
    });    
      
?>