<?php
namespace IPS\modules\LogManager;
use IPS\core\classes\BaseModule;
use IPS\core\classes\DB;

class Controller extends BaseModule {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function clientException($data) {
        if ($data['level'] > 1) {
            DB::query('INSERT into logs (log_message, request_uri, headers, triggered_module, time) values(?, ?, ?, ?, ?)')
                ->bind($data['message'], $data['request_uri'], $data['headers'], $data['trigger'], time())
                ->exec();
        }
    }
}