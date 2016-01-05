<?php

    namespace Marula\Utils;

    abstract class NumericState
    {
        const PCRE_CHECK_INT   = "/^([+-]?)([0-9]+)$/mi";
        
        public static function strIsInt($numStr)
        {
            return preg_match(self::PCRE_CHECK_INT, $numStr);
        }
    
    }
    
?>