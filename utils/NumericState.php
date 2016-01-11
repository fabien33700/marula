<?php

    /**
	 * Marula Library, use easily treenodes in PHP !
	 * 	 coded with and for PHP 5.6+
     * Treenodes algorithm implementation for PHP 
     *   (first of all, for personnal learning and skill improving purposes)
     * @author Fabien Le Houëdec (git: fabien33700) <fabien.lehouedec@gmail.com>
     */
    namespace Marula\Utils;

    abstract class NumericState
    {
        const PCRE_CHECK_INT   = "/^([+-]?)([0-9]+)$/mi";

        /**
         * Check if a string represents a valid integer number.
         * @param $numStr the string to check
         * @return boolean
         */         
        public static function strIsInt($numStr)
        {
            return preg_match(self::PCRE_CHECK_INT, $numStr);
        }
    }