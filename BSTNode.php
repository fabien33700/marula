<?php

    /**
	 * Marula Library, use easily treenodes in PHP !
	 * 	 coded with and for PHP 5.6+
     * Treenodes algorithm implementation for PHP 
     *   (first of all, for personnal learning and skill improving purposes)
     * @author Fabien LH (git: fabien33700) <fabien DOT lehouedec AT gmail DOT com>
     */
	namespace Marula;

    use Marula\BinaryIndexedNode,
        Marula\BinaryNodeIterator,
        Marula\IterationMethod;

    /**
     * The BSTNode class represents a BST node.
     *  A binary search tree (BST) is a binary tree in which each node has an integer as key (IndexedNode),
     *  such that each node of the left subtree is less than or equal key than the node considered,
     *  and that each node in the right subtree has a greater than or equal key thereto.
     *
     * @package Marula
     */
    class BSTNode extends BinaryIndexedNode
    {
        /**
         * Search recursively a node by its key into the BST.
         * @param integer The key to search
         */
        public function search($key)
        {
            // Getting the top root of the entire tree
            $treeRoot = $this->root();
            
            // Initializing a binary node iterator in in-fix search mode
            $searchIterator = new BinaryNodeIterator($treeRoot, BinaryNodeIterator::M_INFIX);
            
            // Scanning all the results, returning the first node matching
            foreach ($searchIterator->items() as $item)
                if ($item->key() === $key) return $item;
                
            // If nothing found, return false
            return false;
        }

        /**
         * {@inheritDoc}
         * !! Overloaded method 
         *   Indicate to not use addChild method in BSTNode.
         */
        public function addChild(AbstractNode $childNode)
        {
            trigger_error("Use insert() method instead of addChild() in BSTNode.", E_USER_NOTICE);
            return false;
        }
        
        /**
         * Insert a new node with the key given as argument.
         * @param integer|array<integer>
         */
        public function insert($args)
        {
            // If several integers are given as an array, each of it will be proceeded one by one
            if (count($args) > 1)
            {
                foreach ($args as $arg)
                {
                    $this->insert($arg);
                }
                    
            }
            else 
            {
                // The key as argument must be an integer
                if (is_integer($args)) 
                {
                    $arg = $args;

                    // If the key do not already exists in the BST
                    if (false === $this->search($arg))
                    {
                        // Left side
                        if ($arg < $this->key())
                        {
                            if (!is_null($this->ls())) $this->ls()->insert($arg);
                            else $this->setLs(new static($arg));
                        }
                        // Right side
                        else if($arg > $this->key())
                        {
                            if (!is_null($this->rs())) $this->rs()->insert($arg);
                            else $this->setRs(new static($arg));
                        }
                        // Do nothing if equals keys
                        else {}
                    }   
                }
            }  
        }
    }