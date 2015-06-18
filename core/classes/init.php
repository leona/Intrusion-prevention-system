<?php

namespace IPS\core\classes;

class initCore {
    
    private $module_options = array();
    
    public function __construct() {
        $this->fetchModuleOptions();
    }
    
    public function loadModulesBy($args) {
        
    }
    
    private function fetchModuleOptions() {
        foreach(glob('../../modules/*/options.php') as $value) {
            $this->module_options[] = include $value;
        }
        print_r($this->module_options);
    }
}