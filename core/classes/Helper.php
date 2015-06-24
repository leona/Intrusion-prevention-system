<?php

namespace IPS\core\classes;

class Helper {
    
   public static function post() {
       return $_SERVER['REQUEST_METHOD'] == 'POST';
   }
}