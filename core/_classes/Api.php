<?php

namespace IPS\core\classes;
use IPS\core\classes\cache;

class api {
    
    public static function pullFeed($url, $ttl = null) {
        //semd to a cron dispatcher to send the request before the cache expires to prevent long load time for a user.
        return cache::segment(function() use($url) {
            return file_get_contents($url);
        }, $url, $ttl);
    }
}