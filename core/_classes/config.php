<?php
namespace IPS\core\classes;

class config /*extends baseModel */{
    
    public static function core($key) {
        $array = include(dirname(__FILE__) . '/../config.php');
        
        if (!empty($array[$key]))
            return $array[$key];
    }
}