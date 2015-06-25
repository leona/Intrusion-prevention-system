<?php
namespace IPS\modules\ErrorPage;
use IPS\core\classes\BaseModule;
use IPS\core\classes\DB;
use IPS\core\classes\View;

class Controller extends BaseModule {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function clientException($data) {
        $error_page = $this->moduleOption('error_page');
        $error_page = !empty($error_page[$data['level']]) ? $error_page[$data['level']] : $error_page[0];
        
        switch($error_page) {
            case 404:
                http_response_code(404);
                $this->renderView('404');
            break; 
            case 500:
                http_response_code(500);
                $this->renderView('404');
            break;
            default:
                $this->renderView($error_page);
        }
    }
}