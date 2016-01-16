<?php

    /**
	 * Marula Library, use easily treenodes in PHP !
	 * 	 coded with and for PHP 5.6+
     * Treenodes algorithm implementation for PHP 
     *   (first of all, for personnal learning and skill improving purposes)
     * @author Fabien LH (git: fabien33700) <fabien DOT lehouedec AT gmail DOT com>
     */
    namespace Marula\Utils\Queue;

    /**
     * The Fifo class provides an implementation of a First-in First-out queue.
     *
     * @package Marula
    */
    class Fifo extends AbstractQueue
    {        
        /**
         * {@inheritDoc}
         */
        public function get()
        {
            return array_pop($this->_stack);
        }

        /**
         * {@inheritDoc}
         * @param mixed $obj Object to put into the queue.
         */
        public function put($obj)
        {
            array_unshift($this->_stack, $obj);
        }
    }