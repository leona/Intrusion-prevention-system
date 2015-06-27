<?php

namespace IPS\core\classes;

class cache {
    
    private static $cache_store = array();
    private $cache_file;
    
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
    
    public function file($point, $cache_name = null, $fetch_only = false) {
        $this->cache_file = $this->fetchCacheFile($cache_name);
        
        if ($fetch_only == true) return 'skip';
        
        if ($this->cache_file) {
            echo $this->cache_file;
            die();
            
        }
        
        if ($point == 'start') {
            ob_start();
            return false;
        } 
        
        $cache_contents = ob_get_clean();
        
        if (!empty($cache_name)) {
            file_put_contents(ips_path . '/cache/' . md5($cache_name), $cache_contents);
        } 
        
        return $cache_contents;
 
        
    }
    
    public function fetchCacheFile($cache_name) {
        $filename = ips_path . '/cache/' . md5($cache_name);
        
        if (file_exists($filename))
            return file_get_contents($filename);
    }
}