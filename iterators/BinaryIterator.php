<?php

    /**
     * Marula Library, use easily treenodes in PHP !
     *   coded with and for PHP 5.6+
     * Treenodes algorithm implementation for PHP 
     *   (first of all, for personnal learning and skill improving purposes)
     * @author Fabien LH (git: fabien33700) <fabien DOT lehouedec AT gmail DOT com>
     */
    namespace Marula\Iterators;

    use Marula\Core\AbstractNode,
        Marula\Core\BinaryNode;

    /**
     * The BinaryNodeIterator class provides an iterator for all BinaryNode subclasses' instance. 
     *   In addition of NodeIterator, it provides an overload execute() method, with prefix, infix and postfix order,
     *   specifically for Binary Treenode.
     *
     * @package Marula
     */
    class BinaryIterator extends NodeIterator
    {
        
        /**
         * Browsing method enum constants
         */
        const PRE_ORDER  = 0;
        const IN_ORDER   = 1;
        const POST_ORDER = 2;

        /**
         * The browsing method (0 = pre-order, 1 = in-order, 2 = post-order).
         * @var int
         * @access protected
         */
        protected $_method = 0;


        /**
         * The iterator's class constructor.
         * @access public
         * @param BinaryNode $subjectNode The node to browse.
         * @param int $method The browsing method.
         */
        public function __construct(AbstractNode $subjectNode, $method = self::PRE_ORDER)
        {
            if ($subjectNode instanceof BinaryNode)
            {
                $this->_method = $method;
                parent::__construct($subjectNode);
            }
            else
                throw new \RuntimeException("BinaryIterator needs an instance of BinaryNode or of its subclasses as subject.");
        }
        
        /**
         * Accessor for the browsing method.
         * @access public
         */
        public final function method()
        {
            return $this->_method;
        }


        /**
         * {@inheritDoc}
         * @param AbstractNode The current node (null on the first iteration)
         */ 
        protected function execute(AbstractNode $currentNode = null)
        {
            // when the method has been just called by __construct()
            if (is_null($currentNode))
            {
                $this->_queue->clear();

                // first recursion
                $this->execute($this->_subject);
            }
            // when the method has just called itself
            else
            {
                if ($this->method() === self::PRE_ORDER) 
                    $this->_queue->put($currentNode);
                
                if (!is_null($currentNode->ls())) $this->execute($currentNode->ls());
                
                if ($this->method() === self::IN_ORDER) 
                    $this->_queue->put($currentNode);
                
                if (!is_null($currentNode->rs())) $this->execute($currentNode->rs());
                
                if ($this->method() === self::POST_ORDER)
                    $this->_queue->put($currentNode);
            }
        }


    }