<?php

    /**
	 * Marula Library, use easily treenodes in PHP !
	 * 	 coded with and for PHP 5.6+
     * Treenodes algorithm implementation for PHP 
     *   (first of all, for personnal learning and skill improving purposes)
     * @author Fabien LH (git: fabien33700) <fabien DOT lehouedec AT gmail DOT com>
     */
	namespace Marula;

    use Marula\AbstractNode,
        Marula\NodeIterator;

    /**
     * The IndexedNode class represents a tree node with an integer key.
     *
     * @package Marula
     */
    class IndexedNode extends AbstractNode 
    {
        protected static $_intKey = true;
    }