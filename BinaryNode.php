<?php

    /**
	 * Marula Library, use easily treenodes in PHP !
	 * 	 coded with and for PHP 5.6+
     * Treenodes algorithm implementation for PHP 
     *   (first of all, for personnal learning and skill improving purposes)
     * @author Fabien LH (git: fabien33700) <fabien DOT lehouedec AT gmail DOT com>
     */
	namespace Marula;

    /**
     * The BinaryNode subclass represents a binary-tree node object.
     *  A BinaryNode object could have at most 2 children, a left and a right one.
     *      ls() -> get the left sibling (first child)
     *      rs() -> get the right sibling (second child)
     *      Use setLs(...) and setRs(...) method to change left or right sibling.
     *
     * @package Marula
     */
	class BinaryNode extends AbstractNode {

        //The BinaryNode's arity is set to 2.
        protected static $_arity = 2;

        /**
         * The id of the left sibling
         */
        const BIN_LS = 0;

        /**
         * The id of the right sibling
         */       
        const BIN_RS = 1;

        /**
         * Get the current node's left sibling.
         * @return Marula\BinaryNode
         */
        public function ls()
        { 
            return $this->child(self::BIN_LS);
        }

        /**
         * Get the current node's right sibling.
         * @return Marula\BinaryNode
         */
        public function rs() 
        {
            return $this->child(self::BIN_RS);
        }

        /**
         * Set a new left sibling.
         * @param Marula\BinaryNode $newLs
         */
        public function setLs($newLs)
        { 
        $this->setChild(self::BIN_LS, $newLs); 
        }

        /**
         * Set a new right sibling.
         * @param Marula\BinaryNode $newRs
         */
        public function setRs($newRs) 
        { 
        $this->setChild(self::BIN_RS, $newRs);
        }

        /**
         * {@inheritDoc}
         * Initialize left and right sibling to null to prevent
         *   errors on __toString. (children() generator bugs on item #0 if it isn't initialized.
         */
        public function __construct($key, $value = null)
        {
            parent::__construct($key, $value);
            $this->_children[self::BIN_LS] = null;
            $this->_children[self::BIN_RS] = null;
        }
    }