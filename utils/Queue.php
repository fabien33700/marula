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
     * The Queue interface defines the standard behaviour of all subclasses of AbstractQueue.
     *
     * @package Marula
     * @package classes
     */
    interface Queue
    {
        /**
         * Get, then delete an item from the queue.
         * @return mixed
         */  
        public function get();  

        /** 
         * Put an item into the queue.
         * @param $obj The object to put.
         */
        public function put($obj);
        
        /**
         * Method to know if the stack is empty.
         * @return boolean
         */
        public function isEmpty();
    }
    
?>