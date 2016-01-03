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
<<<<<<< HEAD
        
        protected static $_arity = 2;
   
=======
        protected static $_arity = 2;
        
        public function addChild(AbstractNode $childNode)
        {
            if ($childNode instanceof self)
            {
                return parent::addChild($childNode);
            }
            else
            {
                throw new \RuntimeException("A binary node can only have BinaryNode as children.");
                return false;
            }
        }
>>>>>>> master
        
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