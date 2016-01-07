<?php

    namespace Marula\Utils;
    
    abstract class AbstractQueue implements Queue
    {
        protected $_stack;
    
        public function __construct()
        {
            $this->clear();
        }
        
        public function isEmpty()
        {
            return (count($this->_stack) === 0);
        }
        
        public function isInto($obj)
        {
            return in_array($obj, $this->_stack);
        }
        
        public function clear()
        {
            $this->_stack = [];
        }
        
        public function generator()
        {
            while (!$this->isEmpty()) 
                yield $this->get();
        }
        
        
    }
    
?>