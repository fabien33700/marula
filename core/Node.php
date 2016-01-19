<?php 

    /**
     * Marula Library, use easily treenodes in PHP !
     *   coded with and for PHP 5.6+
     * Treenodes algorithm implementation for PHP 
     *   (first of all, for personnal learning and skill improving purposes)
     * @author Fabien LH (git: fabien33700) <fabien DOT lehouedec AT gmail DOT com>
     */
    namespace Marula\Core;
    
    use Marula\Iterators\NodeIterator;

    /**
     * The Node class represents a tree node object.
     *   This is the most standard node class of Marula, directly inherited from AbstractNode.
     *
     * @package Marula
     */
    class Node extends AbstractNode {

        /**
         * Add a sibling node to the current node.
         *   Overloaded method : 
         *     add(Node $node)
         *     add($key, val)
         *
         * @param AbstractNode|int $keyOrNode The node or the key of the new node to add.
         * @param mixed $newVal The value for the new node to add.
         * @access public
         * @return The node just added
         */
        public function add($keyOrNode, $newVal = null)
        {
            if (($keyOrNode instanceof AbstractNode) && is_null($newVal))
                return $this->addNode($keyOrNode);
            
            elseif (is_integer($keyOrNode))
                return $this->addNode(new static($keyOrNode, $newVal));
            
            else
            {
                throw new \BadMethodCallException("The method add() must be called with an instance of AbstractNode, or with a tuple of key/value.");
                return false;
            }
        }
        
        
        /**
         * Add a sibling node to the current node.
         * @access protected
         * @param AbstractNode $childNode The child node to add
         * @return The node just added
         */
        protected final function addNode(AbstractNode $childNode)
        {
            // Ensuring that tree's arity will be applied into all its node.
            if ($childNode instanceof $this)
            {
                // Check if the node to add is not already in the current node.
                if (!$this->containsKey($childNode->key()))
                {
                    $childNode->setParent($this);
                    $this->_siblings[$childNode->key()] = $childNode;
                    
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
                throw new \RuntimeException("The node to add msut be an instance of the same class that the current node.");
                return false;
            }
        }

        /**
         * Magic method for node representation
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
    }