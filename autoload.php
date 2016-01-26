<?php

    namespace Marula;

    define('DS', DIRECTORY_SEPARATOR);
    define('NS', "\\");

    class Autoload 
    {
        protected static $vendorDir;
        
        static public function register()
        {   
            self::$vendorDir = dirname(dirname(__FILE__));
            
            spl_autoload_register(array(__CLASS__, 'autoload'));
        }
        
        static public function autoload($class)
        {
            if (false === strpos($class, __NAMESPACE__ . NS)) return;
            
            $classParts    = explode(NS, $class);
            $className     = array_pop($classParts);
            $relativeNS    = strtolower(implode(DS, $classParts));
            
            $classPath     = self::$vendorDir . DS . $relativeNS . DS . $className . '.php';
            
            if (file_exists($classPath))
            {
                require($classPath);
                return true;
            }
            else
                return false;
        }
    }

    
?>