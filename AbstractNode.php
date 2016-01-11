<?php

    /**
	 * Marula Library, use easily treenodes in PHP !
	 * 	 coded with and for PHP 5.6+
     * Treenodes algorithm implementation for PHP 
     *   (first of all, for personnal learning and skill improving purposes)
     * @author Fabien LH (git: fabien33700) <fabien DOT lehouedec AT gmail DOT com>
     */
	namespace Marula;

    use Marula\Utils\Classname,
        Marula\Utils\Numeric,
        Marula\NodeIterator;

    /**
     * The AbstractNode class represents a tree node object.
     *  It must have a key, may have a value, a parent (or not) and may have children.
     *  This is an abstract class, must be inherited to use.
     *
     * @package Marula
     */
    abstract class AbstractNode
    {
        /*
         * Format strings for self dumping (__toString)
         *   1. %s (tabulation according to each node's depth: DUMP_NODE_TAB multiplied by the depth )
         *   2. %s node's key
         *   3. %s node's value
         */
        const DUMP_NODE_STR = "%s[%s]: %s\n";
        const DUMP_NODE_TAB = '    ';

        /*
         * Message for validation criterion
         *   ex. "The value must be a positive integer." or "[...] must be at least a 10-caracters long string."
         */
        const NOT_VALID_VALUE_MSG = "";

        /*
         * The tree's arity (2 for binary tree, n for n-... tree)
         * @static
         * @access protected
         * default value: 0 (none)
         */
        protected static $_arity = 0;

        /**
         * The node's key property.
         * @access protected
         * @var String
         */
        protected $_key;

        /**
         * The node's value property.
         * @access protected
         * @var mixed
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
         * @param string|integer $key Key for the new node
         * @param mixed $value Value for the new node (default. null)
         */
        public function __construct($key, $value = null)
        {
            // $key param must be integer or string
            if (is_string($key) || is_integer($key))
            {
                // cast string to int if its value represents a valid integer
                if (Numeric::strIsInt($key)) $key = (int) $key;

                $this->_key = $key;
            }
            else
            {
                throw new \RuntimeException("A node key must be string or integer, [" . gettype($key) . "] used instead.");
            }

            // Basic initialization
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
        public final function parent()
        {
            return $this->_parent;
        }

        /**
         * Method to check if the param node is a child of the current node.
         * @param AbstractNode $childNode the child to check
         * @access public
         * @return boolean
         */
        public final function hasChild(AbstractNode $childNode)
        {
            return (in_array($childNode, $this->_children, true));
        }

        /**
         * Method to check if the current node has a child node with the corresponding key.
         * @param $key Key to check.
         * @access public
         * @return boolean
         */
        public final function hasKey($key)
        {
            if (is_string($key) || is_integer($key))
            {
                $foundChild = $this->childByKey($key);
                return ($foundChild instanceof AbstractNode);
            }
            else
            {
                throw new \RuntimeException("A node key must be string or integer, [" . gettype($key) . "] used instead.");
            }
        }

        /**
         * Method to know if the current node is a root (no parent)
         * @access public
         * @return boolean
         */
        public final function isRoot()
        {
            return is_null($this->parent());
        }

        /**
         * Method to know if the current node is a branch,
         *   meaning it has at least one child.
         * @access public
         * @return boolean
         */
        public final function isBranch()
        {
            return (count($this->_children) > 0);
        }

        /**
         * Method to know if the current node is a leaf,
         *   meaning it hasn't any children (opposite of isBranch() method).
         * @access public
         * @return boolean
         */
        public final function isLeaf()
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
            // Ensuring that tree's arity will be applied into all its node.
            if ($childNode instanceof $this)
            {
                // Check the node's arity (ignored if arity equals to 0)
                if (($this->arity() == 0) || (count($this->_children) < $this->arity()))
                {
                    // Check if the node to add is not already in the current node.
                    if (!$this->hasChild($childNode))
                    {
                        $childKey = $childNode->key();
                        $childNode->setParent($this);

                        // if the key of node to add matches with an existing child node, overwrite it.
                        if ($this->hasKey($childKey))
                        {
                            $this->_children[$this->keyPos($childKey)] = $childNode;
                        }
                        else
                        {
                            $this->_children[] = $childNode;
                        }
                        
                        return $childNode;
                    }
                    else
                    {
                        throw new \RuntimeException("Unable to add this node : it is already in.");
                        return false;
                    }
                }
                else
                {
                    throw new \RuntimeException("An instance of " . ClassNameUtil::getClassName($this) . " could not have more than " . $this->arity() . " children.");
                    return false;
                }
            }
            else
            {
                throw new \RuntimeException("The node to add must be an instance of " . ClassNameUtil::getClassName($this) . " or of one of its subclasses.");
                return false;
            }
        }

        /**
         * Method to add several children node from a unidimensionnal array.
         *   Raise a notice if a multidimensionnal array is used.
         * @access public
         * @param array $children
         */
        public final function addChildren(array $children)
        {
            foreach ($children as $key => $value)
            {
                if (is_array($value))
                    trigger_error("The addChildren method can only add unidimensionnal array. Less-leveled array will be ignored.", E_USER_NOTICE);

                // Using PHP's late state binding to instanciate the right subclass of AbstractNode class
                $this->addChild(new static((string) $key, $value));

            }
        }

        /**
         * Generator for the current node's children.
         * @access public
         * @return generator
         */
        public final function children()
        {
            for ($i = 0, $c = count($this->_children); $i < $c; $i++)
                yield $this->_children[$i];
        }

        /**
         * Get a child node by its id.
         * @access public
         * @param integer $id The index of the searched node.
         */
        public final function child($id)
        {
            return (isset($this->_children[$id])) ? $this->_children[$id] : null;
        }
        
        /**
         * Set a new child node.
         * @access public
         * @param integer $id Id of child to change
         * @param AbstractNode $newChild The newer child.
         */
        public function setChild($id, $newChild)
        {
            if (!$this->hasChild($newChild))
            {
                $newChild->setParent($this);
                $this->_children[$id] = $newChild;
            }
            else
            {
                throw new \RuntimeException("Unable to add this node : it is already in.");
            }
        }

        /**
         * Get the position of the param key in the internal Node container.
         * @access protected
         * @param string $key The searched node's key.
         */
        protected final function keyPos($key)
        {
            $n = -1;
            foreach ($this->children() as $child)
                if (strcmp($child->key(), $key) === 0)
                    return ++$n;
        }

        /**
         * Get a child node by its key.
         *   Note that the method does not perform recursive searches.
         * @access public
         * @param string $searchKey The key of the searched node.
         */
        public final function childByKey($searchKey)
        {
            foreach($this->children() as $child)
            {
                if (strcmp($child->key(), $searchKey) === 0)
                    return $child;
            }

            return false;
        }

        /**
         * Mutator for the node's parent property.
         * @param Node $parentNode The parent to set to the current node.
         * @access public
         */
        public function setParent(AbstractNode $parentNode)
        {
            if (!is_null($parentNode) && !$this->hasChild($parentNode))
            {
                $this->_parent = $parentNode;
            }
            else
            {
                throw new \RuntimeException("The argument can be neither null, nor both parent and child of the current node.");
            }
        }

        /**
         * Accessor for the key property.
         * @access public
         * @return string|integer The node's key.
         */
        public final function key()
        {
            return $this->_key;
        }

        /**
         * Accessor for the value property.
         * @access public
         * @return mixed The node's value.
         */
        public final function value()
        {
            return $this->_value;
        }

        public final function setValue($value)
        {
            if ($this->checkValue($value))
            {
                $this->_value = $value;
            }
            else
            {
                throw new \RuntimeException("The given value is not correct : \"" . static::NOT_VALID_VALUE_MSG . "\".");
            }

            return $this;
        }

        /**
         * Method to validate the node's value.
         *   It can be override to perform value validation for a subclass.
         *   e.g. return is_numeric($value); ==> only numeric value will be valid, other else makes the method throwing an exception.
         * @param AbstractNode $childNode the child to check
         * @access protected
         * @return boolean
         */
        protected function checkValue($value)
        {
            // no check for basis AbstractNode class
            return true;
        }

        /**
         * Accessor for arity property.
         * @access public
         */
        public final function arity()
        {
            return static::$_arity;
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

            // while the cursor has a parent
            while (!is_null($cursor))
            {
                // add the node's key to the result
                $result[] = $cursor->key();
                
                // position the cursor on the next parent
                $cursor = $cursor->parent();
            }

            return implode($delimiter, array_reverse($result));
        }

        /**
         * Method returning current node's depth in the tree hierarchy
         * @return int
         */
        public function depth()
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
         * Special method for current node's representation.
         * @return String Node's dump
         */
        public function __toString()
        {
            $result = "";
            
            // Invoke a new NodeIterator
            $iterator = new NodeIterator($this);
            
            // Browse the current node
            foreach ($iterator->items() as $item)
                $result .= sprintf(self::DUMP_NODE_STR, str_repeat(self::DUMP_NODE_TAB, $item->depth()-1), $item->key(), $item->value());

            // Return dump 
            return $result;
        }

        /**
         * Browse into a tree node.
         * @param String $path The path to browse
         * @param String $delimiter The delimiter for keys in path string (default. "/")
         * @param boolean $strict If true, stop browsing on first error. (default. true)
         * @return AbstractNode|null
         */
        public final function browse($path, $delimiter = '/', $strict = true)
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
