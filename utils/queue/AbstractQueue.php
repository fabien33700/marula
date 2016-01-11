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
     * The AbstractQueue class provides an implementation of queue concept for PHP
     *
     * @package Marula
     */
    abstract class AbstractQueue implements Queue
    {
        /*
         * The stack container for the queue
         * @var array
         */
        protected $_stack;
    
        /**
         * The class' constructor.
         * @access public
         */
        public function __construct()
        {
            // stands for reset and initialization
            $this->clear();
        }
        
        /**
         * {@inheritDoc}
         */
        public function isEmpty()
        {
            return (count($this->_stack) === 0);
        }
        
        /**
         * Method to know if the param object ($obj) is into the queue or not.
         * @access public
         * @param $obj The object to check
         * @return boolean
         */
        public function isInto($obj)
        {
            return in_array($obj, $this->_stack);
        }
        
        /**
         * Reset the stack by assigning an empty array
         * @access public
         */
        public function clear()
        {
            $this->_stack = [];
        }
        
        /**
         * Return a generator for the stack items.
         * @return generator
         */
        public function generator()
        {
            while (!$this->isEmpty()) 
                yield $this->get();
        } 
    }