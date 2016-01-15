<?php 

    /**
	 * Marula Library, use easily treenodes in PHP !
	 * 	 coded with and for PHP 5.6+
     * Treenodes algorithm implementation for PHP 
     *   (first of all, for personnal learning and skill improving purposes)
     * @author Fabien LH (git: fabien33700) <fabien DOT lehouedec AT gmail DOT com>
     */
	namespace Marula;

    use Marula\NodeIterator,
        Marula\BinaryNode,
        Marula\Utils\Queue\Fifo;

    /**
     * The BinaryNodeIterator class provides an iterator for all BinaryNode subclasses' instance. 
     *   In addition of NodeIterator, it provides an overload execute() method, with prefix, infix and postfix order,
     *   specifically for Binary Treenode.
     *
     * @package Marula
     */
    class BinaryNodeIterator extends NodeIterator
    {
        const M_PREFIX = 0;
        const M_INFIX  = 1;
        const M_SUFFIX = 2;
        /**
         * The queue used to stack items while browsing
         * @access protected
         * @var Marula\Utils\Fifo
         */
        protected $_queue;

        /**
         * The subject node
         * @access protected
         * @var Marula\BinaryNode
         */
        protected $_subject;

        /**
         * The search method (prefix, infix, suffix)
         * @access protected
         * @var integer
         */
        protected $_method;

        public function __construct(AbstractNode &$subjectNode, $method = self::M_PREFIX)
        {
            if ($subjectNode instanceof BinaryNode)
            {
                $this->_method = $method;
                parent::__construct($subjectNode);
            }
            else
                throw new \RuntimeException("BinaryNodeIterator needs an instance of BinaryNode or of its subclasses as subject.");
        }
        
        public function method()
        {
            return $this->_method;
        }
        
        public function setMethod($method)
        {
            $this->_method = $method;
        }

        /**
         * The recursive method execute(), automatically called by __construct
         * @access protected
         * @param Marula\AbstractNode The current node (null on the first iteration)
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
                if ($this->method() === self::M_PREFIX) $this->_queue->put($currentNode);
                
                if (!is_null($currentNode->ls())) $this->execute($currentNode->ls());
                
                if ($this->method() === self::M_INFIX) $this->_queue->put($currentNode);
                
                if (!is_null($currentNode->rs())) $this->execute($currentNode->rs());
                
                if ($this->method() === self::M_SUFFIX) $this->_queue->put($currentNode);
            }
        }
    }