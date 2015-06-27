<?php
namespace IPS\modules\RequestListener;
use IPS\core\classes\BaseModule;

class Controller extends BaseModule {
    
    private $keywords;
    private $features;
    private $pattern;
    private $urls;
    private $core;
    
    public function __construct() {
        parent::__construct();
        
        $this->hot_urls = $this->asset('urls.php');
        $this->keywords = $this->asset('keywords.php');
        $this->patterns = $this->asset('patterns.php');
        $this->features = $this->enabledFeatures();
    }
    
    public function startModule($data, $core) {
        $this->core = $core;
        
        foreach($this->features as $feature) {
            switch($feature) {
                case 'header_implode_scan':
                    $this->massHeaderScan();
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
    
    private function massHeaderScan() {
        $headers = implode('|', getallheaders());
        
        $result = $this->conditionKeyArray(function($key, $value) {
            if (strpos($key, $headers))
                return $value;
        }, $this->hot_urls);
        
        if (!empty($result)) {
            $this->core->runModulesEvent('clientException', $this->buildLog(2));
        }
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