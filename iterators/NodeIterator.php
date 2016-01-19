<?php

    /**
	 * Marula Library, use easily treenodes in PHP !
	 * 	 coded with and for PHP 5.6+
     * Treenodes algorithm implementation for PHP 
     *   (first of all, for personnal learning and skill improving purposes)
     * @author Fabien LH (git: fabien33700) <fabien DOT lehouedec AT gmail DOT com>
     */
	namespace Marula\Iterators;
    
    use Marula\Queue\Fifo,
        Marula\Core\AbstractNode;

    /**
     * The NodeIterator class provides an iterator for all AbstractNode subclasses' instance. 
     *
     * @package Marula
     */
    class NodeIterator 
    {

        /**
         * The queue that stacks the results as and when the iterator traverses the treenode.
         * @var Fifo
         * @access protected
         */
        protected  $_queue;

        /**
         * The node to browse.
         * @var AbstractNode
         * @access protected
         */
        protected  $_subject;
        
        /**
         * The iterator's class constructor.
         * @access public
         * @param AbstractNode $subjectNode The node to browse.
         */
        public function __construct(AbstractNode $subjectNode)
        {
            $this->_subject = $subjectNode;
            $this->_queue = new Fifo();
            $this->execute();
        }


        /**
         * The recursive method to browse the subject node, automatically called by the constructor.
         * @access protected
         * @param AbstractNode $currentNode The current node (null on the first iteration).
         */
        protected function execute(AbstractNode $currentNode = null)
        {
            // when the method has been just called by __construct()
            if (is_null($currentNode))
            {
                $this->_queue->clear();
                
                // add the root to the queue
                $this->_queue->put($this->_subject);
                
                // first recursion
                $this->execute($this->_subject);
            }
            // when the method has just called itself
            else
            {
                // for each child of the current node
                foreach ($currentNode->siblings() as $sibling)
                {
                    // if not already in the queue, add to it
                    if (!$this->_queue->isInto($sibling))
                        $this->_queue->put($sibling);

                    // if current child has children itself, the method recursively called itself
                    if ($sibling->isBranch())
                        $this->execute($sibling);
                }
            }
        }


        /**
         * Return all the found items as a generator.
         * @access public
         */
        public final function items()
        {
            // return a queue's generator
            return $this->_queue->generator();
        }


    }