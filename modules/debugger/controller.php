<?php
namespace IPS\modules\debugger;
use IPS\core\classes\BaseModule;

class Controller extends BaseModule {

    public function startModule() {
    }
    
    public function endModule() {
        echo 'end';
    }
    
    public function execRoute($uri, $request_method = 'GET') {
        
    }
}