<?php

namespace leonhardly;

class debugger {
    
    private $end;
    private $start;
    
    public function __construct() {
        $this->start = microtime(true);
    }
    
    public function end($return) {
        $this->end = microtime(true) - $this->start;
        
        if ($return == true) return $this->end;
        
        echo $return;
    }
    
    public function loop($amount, $callback) {
        for($i = 0; $i < $amount;$i++) {
            $callback();
        }
    }
}