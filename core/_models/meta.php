<?php 
namespace IPS\core\models;
use IPS\core\classes\DB;
use IPS\core\classes\cache;


class meta {
    
    private static $meta_store = array();
    
    public static function fetch($key) {
        if (!empty($meta_store[$key]))
            return $meta_store[$key];
            
        $query = 'SELECT meta_value FROM meta WHERE key = ?';
        
        if (core::config('caching')['meta_queries'])
            return cache::segment(function($key) use($query) {
                DB::query($query)->bind($key);
            }, $key, 600);
            
        return DB::query($query)->bind($key);
    }
}