<?php
namespace IPS\modules\RequestListener;
use IPS\core\classes\BaseModule;

class Controller extends BaseModule {
    
    public function __construct() {
        $keywords = include('keywords.php');
    }
    
    public function startModule() {
        $test = array_filter(array_map(function($value) {
            if ($value == 'test2') 
                return $value;
                
        }, array('test1', 'test3', 'test2')));
    }
    
    private function requestChecker($request) {
        
    }
    
    private function uriChecker($request_uri) {
        
    }
}