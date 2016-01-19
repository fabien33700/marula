<?php

    /**
     * Marula Library, use easily treenodes in PHP !
     *   coded with and for PHP 5.6+
     * Treenodes algorithm implementation for PHP 
     *   (first of all, for personnal learning and skill improving purposes)
     * @author Fabien LH (git: fabien33700) <fabien DOT lehouedec AT gmail DOT com>
     */
    namespace Marula\Core;

    /**
     * The AbstractNode class represents a tree node object.
     *  It must have a key, may have a value, a parent (or not) and may have children.
     *  This is an abstract class, must be inherited to use.
     *
     * @package Marula
     */
    abstract class AbstractNode 
    {

        /**
         * Format strings constants for dumping 
         */
        const DUMP_NODE_STR = "%s[%s]: %s\n";
        const DUMP_NODE_TAB = '    ';
        
        /**
         * The parent of the node
         * @var AbstractNode|null
         * @access protected
         */
        protected  $_parent;

        /**
         * The key of the node
         * @var int
         * @access protected
         */
        protected  $_key;

        /**
         * The value of the node
         * @var mixed
         * @access protected
         */
        protected  $_value;

        /**
         * The siblings of the node
         * @var array
         * @access protected
         */
        protected  $_siblings;


        /**
         * The constructor of the class.
         * @access public
         * @param int $key The key of the node.
         * @param mixed $value The value of the node.
         */
        public function __construct($key, $value = null) 
        {
            if (is_integer($key))
            {
                $this->_key = $key;
                $this->_value = $value;
                $this->_parent = null;
                $this->_siblings = [];
            }
            else
            {
                throw new \Exception("The key of the node must be an integer.");
            }
            
        }


        /**
         * Accessor for the key of the node.
         * @access public
         * @return int
         */
        public function key() 
        {
            return $this->_key;
        }


        /**
         * Accessor for the value of the node.
         * @access public
         * @return mixed
         */
        public final function value() 
        {
            return (isset($this->_value)) ? $this->_value : null;
        }


        /**
         * Accessor for the node's parent.
         * @access public
         * @return AbstractNode
         */
        public final function parent()
        {
            return (isset($this->_parent)) ? $this->_parent : null;
        }


        /**
         * Get a sibling by its key.
         * @access public
         * @param int $key The key of the node to get.
         * @return AbstractNode
         */
        public final function sibling($key) 
        {
            return ($this->containsKey($key)) ? $this->_siblings[$key] : null;
        }


        /**
         * Get a generator for the siblings of the node.
         * @access public
         */
        public final function siblings()
        {
            foreach ($this->_siblings as $sibling)
                yield $sibling;
        }


        /**
         * Mutator for the value of the key.
         * @access public
         * @param mixed $newVal The new value of the node
         */
        public final function setValue($newVal) 
        {
            if ($this->checkValue($newVal))
            {
                $this->_value = $newVal;
            }
            else
            {
                throw new \Exception("The given value is incorrect.");
            }
        }


        /**
         * Mutator for the parent of the key.
         * @access public
         * @param AbstractNode $newParent The new parent of the node
         */
        public final function setParent(AbstractNode $newParent) 
        {
            $this->_parent = $newParent;
        }


        /**
         * Indicate whether the node is a leaf (meaning it has no sibling).
         * @access public
         * @return boolean
         */
        public final function isLeaf()
        {
            return (count($this->_siblings) == 0);
        }


        /**
         * Indicate whether the node is a branch (meaning it has at least one sibling).
         * @access public
         * @return boolean
         */
        public final function isBranch() 
        {
            return (count($this->_siblings) > 0);
        }


        /**
         * Indicate whether the node is a tree root (meaning it has no parent).
         * @access public
         * @return boolean
         */
        public final function isRoot()
        {
            return is_null($this->parent());
        }


        /**
         * Get the toppest root of the treenode.
         * @access public
         * @return AbstractNode
         */
        public final function root()
        {
            $cursor = $this;
            
            while(!is_null($cursor->parent()))
            {
                $cursor = $cursor->parent(); 
            }
                
            return $cursor;  
        }


        /**
         * Get the depth of the node in its treenode.
         * @access public
         * @return int
         */
        public final function depth() 
        {
            $result = 1;
            $cursor = $this;

            while (!is_null($cursor->parent()))
            {
                $result++;
                $cursor = $cursor->parent();
            }

            return $result;
        }


        /**
         * Indicate whether the node passed as argument is part of the current node's sibling.
         * @access public
         * @param AbstractNode $node The node to search.
         * @return boolean
         */
        public final function contains(AbstractNode $node)
        {
            return in_array($node, $this->_siblings, true);
        }


        /**
         * Indicate whether the key of the node passed as argument is part of the current node's sibling.
         * @access public
         * @param int $key The key to search
         * @return boolean
         */
        public final function containsKey($key) 
        {
            return array_key_exists($key, $this->_siblings);
        }


        /**
         * Check if value is valid for the current node.  
         * @access public
         * @param mixed $val The value to check
         * @return boolean
         */
        public function checkValue($val) 
        {
            // standard value check
            return true;
        }


    }