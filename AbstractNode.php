<?php
    /**
     * Node class file, Marula Node Objet
     * 
     * This file stands for the Node class definition.
     * The purpose of Marula is to provide an implementation of
     *   treenode paradigm.
     * @author Fabien Le Houëdec (git: fabien33700) <fabien.lehouedec@gmail.com>
     * @version 0.1
     * @package classes
     */
	namespace Marula;
	
    /**
     * Node object. Has a key/value tuple, may have children (branch) or not (leaf), may have parent (except if it's root)
     *   Abstract class for Node.
     * @package Marula
     * @subpackage classes
     * @abstract
     */
	abstract class AbstractNode
    {   
        /*
         * Format strings for dump() method
         */        
        const DUMP_TAB  = "\t";
        const DUMP_ROOT = "----- %s -----\n";
        const DUMP_NODE = "%s[%s] => %s\n";
    
    
        /**
         * The node's key property.
         * @access protected
         */
        protected $_key;
        
        /**
         * The node's value property.
         * @access protected
         */
        protected $_value;
        
        /**
         * The node's parent property.
         * @access protected
         * @var Node|null
         */
        protected $_parent;
        
        /**
         * Array of the node's children.
         * @access protected
         * @var array
         */
        protected $_children;
        
        
        /**
         * The class' constructor.
         * @access public
         * @param string|integer $key key for the new node
         * @param mixed $value value for the new node
         */
        public function __construct($key, $value = null)
        {
            if (is_string($key) || is_numeric($key))
            {
                $this->_key = $key;
            }

            if (!is_null($value))
            {
                $this->_value = $value;
            }
            
            $this->_children = [];
            $this->_parent = null;
        }
        
        /**
         * The node's parent accessor.
         * @access public
         * @return AbstractNode|null
         */
        public function parent()
        {
            return $this->_parent;
        }
        
        /**
         * Method to check if the param node is a child of the current node.
         * @param AbstractNode $childNode the child to check
         * @access public
         * @return boolean
         */       
        public function hasChild(AbstractNode $childNode)
        {
            return (in_array($childNode, $this->_children, true));
        } 
        
        /**
         * Method to know if the current node is a root (no parent)
         * @access public
         * @return boolean
         */ 
        public function isRoot()
        {
            return is_null($this->parent());
        }

        /**
         * Method to know if the current node is a branch,
         *   meaning it has at least one child.
         * @access public
         * @return boolean
         */             
        public function isBranch()
        {
            return (count($this->_children) > 0);
        }
        
        /**
         * Method to know if the current node is a leaf,
         *   meaning it hasn't any children (opposite of isBranch() method).
         * @access public
         * @return boolean
         */ 
        public function isLeaf()
        {
            return (count($this->_children) == 0);
        }
        
        /**
         * Method to add a child node to the current node.
         *   It returns the child node after proceeding.
         * @access public
         * @return Node 
         */ 
        public function addChild(AbstractNode $childNode)
        {      
            if (!$this->hasChild($childNode))
            {				
                $childNode->setParent($this);
                $this->_children[] = $childNode;
           
                return $childNode;       
            } 
            else
            {
                return false;
            }
        }
        
        /**
         * Method to add several children node from a unidimensionnal array.
         *   Raise a notice if a multidimensionnal array is used.
         * @access public
         * @param array $children 
         */         
        public function addChildren(array $children)
        {    
            foreach ($children as $key => $value)
            {
                if (is_array($value)) 
                    trigger_error("The addChildren method can only add unidimensionnal array. Less-leveled array will be ignored.", E_USER_NOTICE);
                
                // Using PHP's late state binding to instanciate the right subclass of AbstractNode class
                $this->addChild(new static($key, $value)); 
                
            }
        }

        /**
         * Generator for the current node's array of children.
         * @access public
         * @return generator
         */ 
        public function children()
        {   
            for ($i = 0; $i < count($this->_children); $i++)
                yield $this->_children[$i];
        }
        
        /**
         * Get a child node by its id.
         * @access public
         * @param integer $id The index of the searched node. 
         */         
        public function child($id)
        {
            return (isset($this->_children[$id])) ? $this->_children[$id] : null;
        }
        
        /**
         * Get a child node by its key.
         *   Note that the method does not perform recursive searches.
         * @access public
         * @param string $searchKey The key of the searched node. 
         */      
        public function childByKey($searchKey)
        {
            $result = false;
            
            foreach($this->children() as $child)
            {  
                $currKey = (is_numeric($child->key())) ? (string) $child->key() : $child->key();

                if ($currKey === $searchKey) 
                {
                    $result = &$child;
                    break;
                }
            }
            
            return $result;
        }
        
        /**
         * Mutator for the node's parent property.
         * @param Node $parentNode The parent to set to the node.
         * @access public
         */ 
        public function setParent(AbstractNode $parentNode)
        {
            if (!is_null($parentNode) && !$this->hasChild($parentNode))
            {
                $this->_parent = $parentNode;
            }
        }
        
        /**
         * Accessor for the key property.
         * @access public
         * @return string|integer The node's key.
         */ 
        public function key()
        {
            return $this->_key;
        }
        
        /**
         * Accessor for the value property.
         * @access public
         * @return mixed The node's value.
         */ 
        public function value()
        {
            return $this->_value;
        }
        
        public function setValue($value)
        {
            $this->_value = $value;
        }
        
        /**
         * Method returning the path of the currentNode
         * @param String $delimiter The delimiter of the path (/ by default).
         * @return String 
         */ 
        public function path($delimiter = '/')
        {
            $result = [];
            $cursor = $this;
            while (!is_null($cursor->parent()))
            {
                $result[] = $cursor->key();
                $cursor = $cursor->parent();
            }
            $result[] = $cursor->key();
            return implode($delimiter, $result);
        }
        
        /**
         * Special method for current node's representation.
         * @return String Node's dump 
         */ 
        public function __toString()
        {
            return self::dump($this);
        }
        
        /**
         * Static recursive method for dumping a tree node.
         * @return String Node's dump 
         */         
        public static function dump(AbstractNode $node, $depth = 0)
        {            
            $tab = str_repeat(self::DUMP_TAB, $depth);
            
            if ($depth == 0) 
            {
                if (is_null($node->value()) || empty($node->value()))
                {
                    $caption = $node->key();
                }    
                else
                {
                    $caption = $node->value();
                }                    
                    
                $result = sprintf(self::DUMP_ROOT, $caption);
            }      
            else if ($node->isLeaf())
            {
                $result = sprintf(self::DUMP_NODE, $tab, $node->key(), $node->value());
            }  
            else
                $result = '';
            
            foreach ($node->children() as $child)
            {
                $dumpValue = $child->value() . (($child->isBranch()) ? "\n" . self::dump($child, $depth + 1) : "");
                $result.= sprintf(self::DUMP_NODE, $tab, $child->key(), $dumpValue);
            }                   
            
            return $result;
        }
        
        /**
         * Browse into a tree node. 
         * @param String $path The path to browse
         * @param String $delimiter The delimiter for keys in path string (default. "/")
         * @param boolean $strict If true, stop browsing on first error. (default. true)
         * @return AbstractNode|null
         */ 
        public function browse($path, $delimiter = '/', $strict = true)
        {
            $currentNode = $this;
            
            foreach (explode($delimiter, $path) as $key)
            {   
                if (!empty($key))
                {
                    if ($currentNode->childByKey($key) === false)
                    {
                        if ($strict)
                        {
                            trigger_error("Error encountered while parsing path : $path at $key. Aborting.", E_USER_WARNING);
                            return false;
                        }
                        else
                            break;
                    }
                    else
                        $currentNode = $currentNode->childByKey($key);    
                }
            }
            
            return $currentNode;
        }
    }

?>