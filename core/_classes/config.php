<?php
namespace IPS\core\classes;

class config /*extends baseModel */{
    
    public function onstruct() {
        $this->cache = new \IPS\core\classes\cache;
    }
    
    public static function core($key) {
        $array = include(dirname(__FILE__) . '/../config.php');
        return $array[$key];
    }
}