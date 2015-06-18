<?php
namespace IPS\modules\CSRF;
use IPS\core\classes\http;

class Controller {

    public function eventListener($event, $event_data) {
        switch($event) {
            case 'start':
                $this->moduleStart();
            break;
            case 'end':
                $this->moduleEnd();
            break;
            case 'client_warning':
                $this->sendText();
            break;
        }
    }
    
    private function moduleStart() {
        
    }
    
    private function moduleEnd() {
        
    }
}