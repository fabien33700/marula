<?php

    /**
     * Marula Library, use easily treenodes in PHP !
     *   coded with and for PHP 5.6+
     * Treenodes algorithm implementation for PHP 
     *   (first of all, for personnal learning and skill improving purposes)
     * @author Fabien Le Houëdec (git: fabien33700) <fabien.lehouedec@gmail.com>
     */

    /**
     * Global constants
     */
    define('BASEDIR', dirname(__DIR__));
    define('DS', DIRECTORY_SEPARATOR);
    define('NS', "\\");
    
    /**
     * The PSR-4 compliant loader for Marula Library.
     */
    abstract class Marula
    {
        /**
         * The library namespace prefix.
         */
        const LIB_PREFIX = "Marula";
        
        /**
         * The autoload method.
         */
        private static function autoload($class)
        {
            /* 
              Decompose the namespaces as an array, get and remove the class name from it,
              and recompose the namespace.
            */
            $classArray  = explode(NS, $class);
            $className   = array_pop($classArray);
            $classPrefix = implode(NS, $classArray);

            // If the invoked class' namespace does not contain the library prefix, we return
            if (substr($classPrefix, 0, strlen(self::LIB_PREFIX)) !== self::LIB_PREFIX) return;

            // Compute the complete class file path
            $classFilename = BASEDIR . DS . $classPrefix . DS . $className . '.php';

            // If exist, require it.
            if (file_exists($classFilename))
                require $classFilename;
        }


        /**
         * Register the autoloader.
         */
        public static function register()
        {
            spl_autoload_register(array('self', 'autoload'));
        }


        /**
         * Unregister the autoloader from the __autoload stack.
         */
        public static function unregister()
        {
            spl_autoload_unregister(array('self', 'autoload'));
        }


    }
    
    /**
     * Factory static class
     */
    abstract class NodeFactory
    {
        
        public static function Node($key, $value = null)
        {
            return new Marula\Core\Node($key, $value);
        }
        
        public static function BinaryNode($key, $value = null)
        {
            return new Marula\Core\BinaryNode($key, $value);
        }
        
        public static function BSTNode($key, $value = null)
        {
            return new Marula\Core\BSTNode($key, $value);
        }
        
    }

    
