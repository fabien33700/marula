<?php

    /**
	 * Marula Library, use easily treenodes in PHP !
	 * 	 coded with and for PHP 5.6+
     * Treenodes algorithm implementation for PHP 
     *   (first of all, for personnal learning and skill improving purposes)
     * @author Fabien Le Houëdec (git: fabien33700) <fabien.lehouedec@gmail.com>
     */
    namespace Marula\Utils;

    /**
     * The Lifo class provides an implementation of a Last-in First-out queue.
     *
     * @package Marula
     * @package classes
    */
    class Lifo extends AbstractQueue
    {
        /**
         * {@inheritDoc}
         */
        public function get()
        {
            return array_shift($this->_stack);
        }
        
        /**
         * {@inheritDoc}
         */
        public function put($obj)
        {
            array_unshift($this->_stack, $obj);
        }
    }
    
?>