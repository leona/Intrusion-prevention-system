<?php
namespace IPS\modules\LogManager;
use IPS\core\classes\BaseModule;
use IPS\core\classes\DB;
use IPS\core\models\log;

class Controller extends BaseModule {
    
    private $client_profile;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function clientException($data) {
        if ($data['level'] > 1) {
            $this->client_profile = log::clientProfile();
            
            if (!empty($this->client_profile->permanently_banned) && $this->client_profile->permanently_banned)
                return false;
            
            if (empty($this->client_profile)) 
                echo DB::query('INSERT into ip_profile (ip_address, permanently_banned, profile_created) values(?, ?, ?)')
                    ->bind($this->server('REMOTE_ADDR'), $data['level'] > 2 ? 1 : 0, time())
                    ->exec();
               /*     
            DB::query('INSERT into logs (log_message, request_uri, headers, triggered_module, time) values(?, ?, ?, ?, ?)')
                ->bind($data['message'], $data['request_uri'], $data['headers'], $data['trigger'], time())
                ->exec();
                
            */
        }
    }
}