<?php

    /**
	 * Marula Library, use easily treenodes in PHP !
	 * 	 coded with and for PHP 5.6+
     * Treenodes algorithm implementation for PHP 
     *   (first of all, for personnal learning and skill improving purposes)
     * @author Fabien LH (git: fabien33700) <fabien DOT lehouedec AT gmail DOT com>
     */
	namespace Marula;

    use Marula\AbstractNode,
        Marula\NodeIterator;

    /**
     * The IndexedNode class represents a tree node with an integer key.
     *
     * @package Marula
     */
    class IndexedNode extends AbstractNode
    {
        /**
         * The class' constructor.
         * @access public
         * @param integer $key Key for the new node
         * @param mixed $value Value for the new node (default. null)
         */
        public function __construct($key, $value = null)
        {
            // The key must be an integer
            if (is_integer($key)) 
            { 
                parent::__construct($key, $value);
            }
            else
            {
                throw new \Exception("An indexed node's key must be an integer.");
                return false;
            }
        }
        
        /**
         * Method to check if the current node has a child node with the corresponding key.
         * @param integer $key Key to check.
         * @access public
         * @return boolean
         */
        public function hasKey($key)
        {
            if (is_integer($key))
            {
                $foundChild = $this->childByKey($key);
                return ($foundChild instanceof AbstractNode);
            }
            else
            {
                throw new \RuntimeException("An indexed node's key must be an integer.");
            }
        }
        
        /**
         * Get a child node by its key.
         *   Note that the method does not perform recursive searches.
         * @access public
         * @param integer $searchKey The key of the searched node.
         */
        public function childByKey($searchKey)
        {
            foreach($this->children() as $child)
            {
                if ($child->key() === $searchKey)
                    return $child;
            }

            return false;
        }
        
        /**
         * Get the position of the param key in the internal Node container.
         * @access protected
         * @param integer $key The searched node's key.
         */
        protected function keyPos($key)
        {
            $n = -1;
            foreach ($this->children() as $child)
                if ($child->key() === $key)
                    return ++$n;
        }
        
        // à définir
        public function search($key)
        {    
            if (is_integer($key)) 
            {
                $iterator = new NodeIterator($this);
                
                $result = false;
                foreach ($iterator->items as $item)
                    if ($item->key() === $key) $result = $key;
                
                return $result;
            }
            else
            {
                throw new \Exception("The key must be an integer.");
                return false;
            }
        }
    }