<?php

namespace IPS\core\models;
use IPS\core\classes\DB;

class log extends \IPS\core\classes\BaseModule {
    
    private static $client_profile = array();
    private static $client_fetch;
    
    public static function clientProfile() {
        if (self::$client_fetch == false && empty(self::$client_profile)) {
            self::$client_profile = DB::query('SELECT * from ip_profile WHERE ip_address = ?')
                ->bind(self::server('REMOTE_ADDR'))->fetch();
             
            self::$client_fetch = true;
        }
 
        return self::$client_profile;
    }
    
    public function addLog() {
        
    }
}