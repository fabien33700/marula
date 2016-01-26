<?php

    /**
     * Marula Library, use easily treenodes in PHP !
     *   coded with and for PHP 5.6+
     * Treenodes algorithm implementation for PHP 
     *   (first of all, for personnal learning and skill improving purposes)
     * @author Fabien Le Houëdec (git: fabien33700) <fabien.lehouedec@gmail.com>
     */

    namespace Marula;
    
    /**
     * Factory static class
     */
    abstract class NodeFactory
    {
        
        public static function Node($key, $value = null)
        {
            return new Core\Node($key, $value);
        }
        
        public static function BinaryNode($key, $value = null)
        {
            return new Core\BinaryNode($key, $value);
        }
        
        public static function BSTNode($key, $value = null)
        {
            return new Core\BSTNode($key, $value);
        }
        
    }