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
     * The BinaryIndexNode is like BinaryNode and IndexedNode  
     *
     * @package Marula
     */
	class BinaryIndexedNode extends BinaryNode {

        // _intKey switch on true, so a BinaryIndexedNode will accept only integer as key.
        protected static $_intKey = true;
    }