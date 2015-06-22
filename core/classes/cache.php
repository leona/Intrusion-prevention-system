<?php

namespace IPS\core\classes;

class cache {
    
    private static $cache_store = array();
    
    public static function store($key, $value, $time = 0) {
        if (is_array($value) || is_object($value)) 
            $value = serialize($value);

        apc_store($key, $value, $time);
    }
    
    public static function fetch($key, $condition = true) {
        if ($condition == false)
            return false;
        
        if (!empty(self::$cache_store[$key]))
            return self::$cache_store[$key];
         
        self::$cache_store[$key] = apc_fetch($key);
        
        return self::$cache_store[$key];
    }
    
    public static function remove($key) {
        apc_delete($key);
    }
    
    public static function fileCache($location, $cache_name = null) {
        switch($location) {
            case 'start': 
                ob_start();
            break;
            case 'end':
                if (!empty($cache_name)) {
                    file_put_contents(ips_path . '/cache/' . $cache_name);
                } 
                return ob_get_clean();
            break;
        }
    }
    
    public static function fetchCacheFile($location) {
        
    }
}