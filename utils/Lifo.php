<?php

    /**
	 * Marula Library, use easily treenodes in PHP !
	 * 	 coded with and for PHP 5.6+
     * Treenodes algorithm implementation for PHP 
     *   (first of all, for personnal learning and skill improving purposes)
     * @author Fabien LH (git: fabien33700) <fabien DOT lehouedec AT gmail DOT com>
     */
    namespace Marula\Utils;

    /**
     * The Lifo class provides an implementation of a Last-in First-out queue.
     *
     * @package Marula
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