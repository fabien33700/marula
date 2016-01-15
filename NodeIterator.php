<?php 

    /**
	 * Marula Library, use easily treenodes in PHP !
	 * 	 coded with and for PHP 5.6+
     * Treenodes algorithm implementation for PHP 
     *   (first of all, for personnal learning and skill improving purposes)
     * @author Fabien LH (git: fabien33700) <fabien DOT lehouedec AT gmail DOT com>
     */
	namespace Marula;

    use Marula\Utils\Queue\Fifo;

    /**
     * The NodeIterator class provides an iterator for all AbstractNode subclasses' instance. 
     *   e.g. Usage :
     *   $iterator = new NodeIterator($node);
     *   
     *   foreach ($iterator->$items() as $item)
     *   {
     *      // $item is the current item (AbstractNode inherited) pointed by the iterator.
     *      echo $item->key();
     *   }
     *
     * @package Marula
     */
    class NodeIterator
    {
        /**
         * The queue used to stack items while browsing
         * @access protected
         * @var Marula\Utils\Fifo
         */
        protected $_queue;

        /**
         * The subject node
         * @access protected
         * @var Marula\AbstractNode
         */
        protected $_subject;

        /**
         * The class' constructor.
         * @access public
         * @param Marula\AbstractNode The node to browse
         */
        public function __construct(AbstractNode &$subjectNode)
        {
            $this->_subject = $subjectNode;
            $this->_queue = new Fifo();
            $this->execute();
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
                
                // add the root to the queue
                $this->_queue->put($this->_subject);
                
                // first recursion
                $this->execute($this->_subject);
            }
            // when the method has just called itself
            else
            {
                // for each child of the current node
                foreach ($currentNode->children() as $child)
                {
                    // if not already in the queue, add to it
                    if (!$this->_queue->isInto($child))
                        $this->_queue->put($child);

                    // if current child has children itself, the method recursively called itself
                    if ($child->isBranch())
                        $this->execute($child);
                }
            }
        }

        /**
         * Return a generator of the result queue.
         * @access public
         * @return generator
         */ 
        public final function items()
        {
            // return a queue's generator
            return $this->_queue->generator();
        }
    }