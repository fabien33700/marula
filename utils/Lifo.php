<?php

    namespace Marula\Utils;
    
    class Fifo extends AbstractQueue
    {
        protected $_stack;
        
        public function get()
        {
            return array_shift($this->_stack);
        }
        
        public function put($obj)
        {
            array_unshift($this->_stack, $obj);
        }
    }
    
?>