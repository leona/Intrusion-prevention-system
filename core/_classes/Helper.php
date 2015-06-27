<?php

namespace IPS\core\classes;

class Helper {
    
   public static function post() {
       return $_SERVER['REQUEST_METHOD'] == 'POST';
   }
   
   public static function assetPath($name) {
      return dirname('../assets/' . $name);
   }
   
   public static function coreConfig($key) {
      $array = include('../config.php');
      return $array[$key];
   }
}