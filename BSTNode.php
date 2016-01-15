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
        public function search($key)
        {
            $treeRoot = $this->root();
            $searchIterator = new BinaryNodeIterator($treeRoot, IterationMethod::INFIX);
            
            foreach ($searchIterator->items() as $item)
                if ($item->key() === $key) return $item;
                
            return false;
        }
        
        public function addChild(AbstractNode $childNode)
        {
            trigger_error("Use insert() method instead of addChild() in BSTNode.", E_USER_NOTICE);
            return false;
        }
        
        public function insert($args)
        {
            if (count($args) > 1)
            {
                foreach ($args as $arg)
                {
                    $this->insert($arg);
                }
                    
            }
            else 
            {
                if (is_integer($args)) 
                {
                    $arg = $args;
                    if (false === $this->search($arg))
                    {
                        if ($arg < $this->key())
                        {
                            if (!is_null($this->ls())) $this->ls()->insert($arg);
                            else $this->setLs(new static($arg));
                        }
                        else if($arg > $this->key())
                        {
                            if (!is_null($this->rs())) $this->rs()->insert($arg);
                            else $this->setRs(new static($arg));
                        }
                        else {}
                    }   
                }
            }  
        }
        /*public function addChild
        {
            if ($childNode->key() < $this->key())
            {
                $childNode->setParent($this);
                
                if (is_null($this->ls())) 
                $this->child(self::BIN_LS)->set
            }
            else if ($childNode->key() > $this->key())
            {
                $childNode->setParent($this);
                $this->setRs($childNode);
            }
            else
            {
                throw new \Exception("A binary search tree node and its child cannot have the same key.");
                return false;
            }
        }*/
    }