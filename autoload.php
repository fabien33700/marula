<?php

    /**
	 * Marula Library, use easily treenodes in PHP !
	 * 	 coded with and for PHP 5.6+
     * Treenodes algorithm implementation for PHP 
     *   (first of all, for personnal learning and skill improving purposes)
     * @author Fabien Le Houëdec (git: fabien33700) <fabien.lehouedec@gmail.com>
     */
     
    /**
     * The PSR-4 compliant loaded for Marula Library.
     */

    define('LIB_PREFIX', "Marula");

    define('BASEDIR', dirname(__DIR__));
    define('DS', DIRECTORY_SEPARATOR);
    define('NS', "\\");

    spl_autoload_register(function ($class)
    {
        $classArray  = explode(NS, $class);
        $className   = array_pop($classArray);
        $classPrefix = implode(NS, $classArray);

        if (substr($classPrefix, 0, strlen(LIB_PREFIX)) !== LIB_PREFIX) return;

        $classFilename = BASEDIR . DS . $classPrefix . DS . $className . '.php';

        if (file_exists($classFilename))
            require $classFilename;
    });

?>
