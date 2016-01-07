<?php

    namespace Marula;
    
    use Marula\Utils\Fifo;
    
    class NodeIterator
    {
        protected $_queue;
        protected $_subject;
        
        public function __construct(AbstractNode &$subjectNode)
        {
            $this->_subject = $subjectNode;
            $this->_queue = new Fifo();
        }
        
        public function execute(AbstractNode $currentNode = null)
        {
            if (is_null($currentNode))
            {
                $this->_queue->clear();
                $this->execute($this->_subject);
            }
            else
            { 
                foreach ($currentNode->children() as $child)
                {
                    if (!$this->queue()->isInto($child))
                        $this->_queue->put($child);
                    
                    if ($child->isBranch())
                        $this->execute($child);
                }
            }
        }
        
        public function queue()
        {
            return $this->_queue;
        }
    }