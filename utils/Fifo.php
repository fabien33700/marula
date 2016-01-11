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
     * The Fifo class provides an implementation of a First-in First-out queue.
     *
     * @package Marula
     * @package classes
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
         */
        public function put($obj)
        {
            array_unshift($this->_stack, $obj);
        }
    }
    
?>