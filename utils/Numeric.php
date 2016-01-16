<?php

    /**
	 * Marula Library, use easily treenodes in PHP !
	 * 	 coded with and for PHP 5.6+
     * Treenodes algorithm implementation for PHP 
     *   (first of all, for personnal learning and skill improving purposes)
     * @author Fabien Le Houëdec (git: fabien33700) <fabien.lehouedec@gmail.com>
     */
    namespace Marula\Utils;

    /**
     * The Numeric class is an utility class to provides methods for numeric operation.
     * 
     * @package Marula\Utils
     */
    abstract class Numeric
    {
        /**
         * Check if a string represents a valid integer number.
         * @param $numStr the string to check
         * @return boolean
         */         
        public static function strIsInt($numStr)
        {
            return (is_integer($numStr) || (is_string($numStr) && ctype_digit($numStr)));
        }
    }