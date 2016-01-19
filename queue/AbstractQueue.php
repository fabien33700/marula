<?php

    /**
	 * Marula Library, use easily treenodes in PHP !
	 * 	 coded with and for PHP 5.6+
     * Treenodes algorithm implementation for PHP 
     *   (first of all, for personnal learning and skill improving purposes)
     * @author Fabien LH (git: fabien33700) <fabien DOT lehouedec AT gmail DOT com>
     */
    namespace Marula\Queue;
    
    /**
     * The AbstractQueue class provides an implementation of queue concept for PHP
     *
     * @package Marula
     */
    abstract class AbstractQueue implements Queue
    {

        /**
         * The queue that stacks the results as and when the iterator traverses the treenode.
         * @var Marula\Queue\Fifo
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
         * Indicate whether the var as argument is in the stack.
         * @access public
         * @param $obj
         * @return boolean
         */
        public function isInto($obj)
        {
            return in_array($obj, $this->_stack);
        }


        /**
         * Clear the queue.
         * @access public
         */
        public function clear()
        {
            $this->_stack = [];
        }


        /**
         * Return all the queue items as a generator.
         */
        public function generator()
        {
            while (!$this->isEmpty()) 
                yield $this->get();
        } 


    }