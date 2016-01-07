<?php

    namespace Marula\Utils;
    
    interface Queue
    {
        public function get();
        public function put($obj);
        public function isEmpty();
    }
    
?>