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
            DB::query('INSERT into logs (log_message, request_uri, headers, triggered_module) values(?, ?, ?, ?)')
                ->bind($data['message'], $data['request_uri'], implode('|', $data['headers']), $data['trigger'])->exec();
        }
    }
}