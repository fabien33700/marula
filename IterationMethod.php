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
     * The IterationMethod enum class provides consts for the different iteration methods 
     *
     * @package Marula
     */
    abstract class IterationMethod
    {
        const PREFIX = 0;
        const INFIX  = 1;
        const SUFFIX = 2;
        
        const __default = self::PREFIX;
    }