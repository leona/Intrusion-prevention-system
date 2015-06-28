<?php

namespace IPS\core\classes;
use IPS\core\classes\config;
use IPS\core\classes\Helper;

class cache {
    
    private static $cache_store = array();
    private $cache_file;
    
    public static function segment($callback, $key, $ttl = 0) {
        $fetch = self::fetch($key);
        
        if (!empty($fetch)) {
            return $fetch;
        }
        
        $store = $callback();
     
        if (is_array($store))
            $store = serialize($store);
            
        return cache::store($key, $store, $ttl);;
    }
    
    public static function store($key, $value, $time = 0) {
        if (!function_exists('apc_fetch')) {
            return false;
        }
        if (is_array($value) || is_object($value)) 
            $value = serialize($value);

        apc_store($key, $value, $time);
        
        return $value;
    }
    
    public static function fetch($key, $condition = true) {
        if (!function_exists('apc_fetch'))
            return false;
            
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
    
    public function file($point, $cache_name = null, $ttl = null) {
        if (config::core('caching')['disable_on_post'] == true && Helper::post())
            return;
            
        $this->cache_file = $this->fetchCacheFile($cache_name, $ttl);
        
        if ($this->cache_file) {
            echo $this->cache_file;
            die();
        }
        
        if ($point == 'start') {
            ob_start();
            return false;
        } 
        
        $cache_contents = $this->minifyFile(ob_get_clean());
        
        if (!empty($cache_name)) {
            file_put_contents(ips_path . '/cache/' . md5($cache_name), $cache_contents);
        } 
        
        echo $cache_contents;
    }
    
    public function fetchCacheFile($cache_name, $ttl = null) {
        $filename = ips_path . '/cache/' . md5($cache_name);
        
        if (file_exists($filename)) {
            
            if ($ttl !== null && filemtime($filename) < time() - $ttl)
                return;
                
            return file_get_contents($filename);
        }
    }
    
    private function minifyFile($buffer) {
        
        if (config::core('minify_cache') == false) 
            return $buffer;
            
        // Source http://stackoverflow.com/questions/6225351/how-to-minify-php-page-html-output
        $search = array(
            '/\>[^\S ]+/s',  // strip whitespaces after tags, except space
            '/[^\S ]+\</s',  // strip whitespaces before tags, except space
            '/(\s)+/s'       // shorten multiple whitespace sequences
        );
    
        $replace = array('>', '<', '\\1');
    
        $buffer = preg_replace($search, $replace, $buffer);
        
        if (config::core('heavy_minification') == true)  
            $buffer = preg_replace(
                array(
                    '/ {2,}/', '/<!--.*?-->|\t|(?:\r?\n[ \t]*)+/s'
                ), 
                array(' ', ''), 
                $buffer
            );
        
        return $buffer;

    }
}