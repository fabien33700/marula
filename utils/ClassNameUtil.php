<?php

    namespace Marula\Utils;
    
    static class ClassNameUtil
    {
        public static function getClassName(Object &$obj)
        {
            $classFqn = self::getClassFqn($obj);
            return substr($classFqn, strrpos($classFqn, NS) + 1);
        }
        
        public static function getClassFqn(Object &$obj)
        {
            return get_class($obj);
        }        
    }