<?php

namespace IPS\core\classes;
use IPS\core\classes\cache;

class api {
    
    public static function pullFeed($url, $ttl = null) {
        return cache::segment(function() {
            return file_get_contents($url);
        }, $url, $ttl);
        /*
        $feed = cache::fetch($url);
        
        if (empty($feed)) {
            $feed = file_get_contents($url);
            cache::store($url, $feed, $ttl);
        }
        return $feed;*/
    }
}