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
        protected static $_arity = 2;
        
        const BIN_LS = 0;
        const BIN_RS = 1;
        
        public function ls() { return $this->child(self::BIN_LS); }
        public function rs() { return $this->child(self::BIN_RS); }
        
        public function setLs($newLs) { $this->setChild(self::BIN_LS, $newLs); }
        public function setRs($newRs) { $this->setChild(self::BIN_RS, $newRs); }
    }