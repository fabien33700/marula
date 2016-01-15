<?php

    /**
	 * Marula Library, use easily treenodes in PHP !
	 * 	 coded with and for PHP 5.6+
     * Treenodes algorithm implementation for PHP 
     *   (first of all, for personnal learning and skill improving purposes)
     * @author Fabien Le Houëdec (git: fabien33700) <fabien.lehouedec@gmail.com>
     */
    namespace Marula\Utils;

    abstract class Classname
    {
        /**
         * Get class name of the argument object.
         * @param $obj 
         * @return string
         */   
        public static function getClassName(&$obj)
        {
            $classFqn = self::getClassFqn($obj);
            
            if (!$classFqn) return false;
            
            if (strpos($classFqn, NS) !== false)
            {
                return substr($classFqn, strrpos($classFqn, NS) + 1);
            }
            else
            {
                return $classFqn;
            }  
        }

        /**
         * Get FQN (full qualified name) of the class of the argument object.
         * @param $obj 
         * @return string
         */   
        public static function getClassFqn(&$obj)
        {
            return (is_object($obj)) ? get_class($obj) : false;
        }        
    }