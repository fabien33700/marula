<?php

    namespace Marula\Utils;
    
    abstract class ClassNameUtil
    {
        public static function getClassName(&$obj)
        {
            $classFqn = self::getClassFqn($obj);
            return ($classFqn !== false) ? substr($classFqn, strrpos($classFqn, NS) + 1) : false;
        }
        
        public static function getClassFqn(&$obj)
        {
            return (is_object($obj)) ? get_class($obj) : false;
        }        
    }