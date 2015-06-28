<?php
namespace IPS\modules\RequestListener;
use IPS\core\classes\BaseModule;

class Controller extends BaseModule {
    
    private $keywords;
    private $features;
    private $pattern;
    private $urls;
    private $core;
    private $results = array();
    
    public function __construct() {
        parent::__construct();
        
        $this->hot_urls = include $this->asset('urls.php');
        $this->keywords = include $this->asset('keywords.php');
        $this->patterns = include $this->asset('patterns.php');
        
        $this->features = $this->enabledFeatures();
    }
    
    public function startModule($data, $core) {
        $this->core = $core;
        
        foreach($this->features as $feature) {
            switch($feature) {
                case 'header_implode_scan':
                    $this->scanRequest($this->server('REQUEST_URI'), );
                    break;
                case 'individual_post_scan':
                    $this->scanKeywords($_POST);
                break;
                case 'individual_get_scan':
                    //same as above
                break;
                case 'regex_scanning':
                    $this->runRegex($_POST);
                break;
            }
        }
    }
    
    private function scanRequest($request, $search, $result_key) { 
        $this->conditionArray(function($value) use($request) {
            echo $request;
            if (strpos($value, $request))
                return $value;
        }, $this->hot_urls, $this->results['header_implode_scan']);
    }
    private function requestChecker($request) {
        
    }
    
    private function uriChecker($request_uri) {
        $urls = $this->asset('urls.php');
        
        if (strpos($request_uri, implode('|', $urls))) {
            return true;
        }
    }
}