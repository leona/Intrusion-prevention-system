<?php
namespace IPS\modules\CSRF;
use IPS\core\classes\http;
use IPS\core\classes\BaseModule;

class Controller extends BaseModule {

    public function eventListener($event, $event_data) {
        //remove this func and make it just call these functions if they exist.cache the function exist check
        switch($event) {
            case 'start':
                $this->moduleStart();
            break;
            case 'end':
                $this->moduleEnd();
            break;
            case 'client_warning':
                $this->sendText($event_data);
            break;
            case 'route_event':
                $this->execRoute($event_data);
                break;
        }
    }
    
    private function execRoute($route_data) {
        
    }
    public function startModule() {
        echo 1;
    }
    
    public function endModule() {
        echo 2;
    }
}