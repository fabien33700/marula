<?php

    /**
     * Marula Library, use easily treenodes in PHP !
     *   coded with and for PHP 5.6+
     * Treenodes algorithm implementation for PHP 
     *   (first of all, for personnal learning and skill improving purposes)
     * @author Fabien LH (git: fabien33700) <fabien DOT lehouedec AT gmail DOT com>
     */
    namespace Marula\Core;
    
    use Marula\Iterators\BinaryIterator,
        Marula\Core\BinaryNode,
        Marula\Core\AbstractNode;

    /**
     * The BinaryNode subclass represents a binary-tree node object.
     *  A BinaryNode object could have at most 2 children, a left and a right one.
     *      ls() -> get the left sibling (first child)
     *      rs() -> get the right sibling (second child)
     *      Use changeLs(...) and changeRs(...) method to change left or right sibling.
     *
     * @package Marula
     */
    class BinaryNode extends AbstractNode
    {
        
        /**
         * Format strings constants for dumping 
         */
        const DUMP_NODE_STR = "%s%s[%s]: %s\n";
        
        /**
         * Binary node constants
         */
        const LEFT  = 1;
        const RIGHT = 2;
        
        
        /**
         * Get the left sibling.
         * @access public
         * @return BinaryNode
         */
        public final function ls()
        {
            return (isset($this->_siblings[self::LEFT])) ? $this->_siblings[self::LEFT] : null;
        }


        /**
         * Get the right sibling.
         * @access public
         * @return BinaryNode
         */
        public final function rs() 
        {
            return (isset($this->_siblings[self::RIGHT])) ? $this->_siblings[self::RIGHT] : null;
        }
        
        
        /**
         * Indicate whether the current node is the left or the right sibling of its parent.
         *   Return -1 in other cases
         * @return int
         */
        public final function side()
        {
            if (!$this->isRoot()) 
            {
                
                if ($this->parent()->ls() === $this) return self::LEFT;
                if ($this->parent()->rs() === $this) return self::RIGHT; 
            }

            return 0;
        }


        /**
         * Change the left sibling of the node.
         * @access public
         * @param BinaryNode $newSibling The new sibling to set.
         */
        public final function changeLs(BinaryNode $newSibling)
        {
            $newSibling->setParent($this);
            $this->_siblings[self::LEFT] = $newSibling;
        }


        /**
         * Change the right sibling of the node.
         * @access public
         * @param BinaryNode $newSibling The new sibling to set.
         */
        public final function changeRs(BinaryNode $newSibling)
        {
            $newSibling->setParent($this);
            $this->_siblings[self::RIGHT] = $newSibling;
        }


        /**
         * Magic method for node representation
         */
        public function __toString()
        {
            $result = "";
            $sides = ['--', '<-', '->'];
            
            // Invoke a new NodeIterator
            $iterator = new BinaryIterator($this);  
   
            // Browse the current node
            foreach ($iterator->items() as $item)
                $result .= sprintf(self::DUMP_NODE_STR, str_repeat(self::DUMP_NODE_TAB, $item->depth()-1), $sides[$item->side()], $item->key(), $item->value());

            // Return dump 
            return htmlspecialchars($result);
        }


    }