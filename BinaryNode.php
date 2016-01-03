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
	
	class BinaryNode extends AbstractNode {
        
        protected static $_arity = 2;
        
        public function leftSibling()
        {
            return $this->child(0);
        }
        
        public function rightSibling()
        {
            return $this->child(1);
        }
    }
    
?>