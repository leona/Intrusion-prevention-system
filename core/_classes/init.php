<?php

namespace IPS\core\classes;
use IPS\core\classes\cache;

class initCore {
    
    private $module_options = array();
    private $module_objects = array();
    private $module_class;
    
    public function __construct() {
        $this->fetchModuleOptions();

    }
    
    public function runModulesEvent($event, $event_data = null) {
        foreach($this->module_options as $path => $options) {
                if (!@include_once($path . 'controller.php')) {
                    exit("Module at {$path} is enabled but no controller.php found.");
                }
                
                $this->module_class = '\IPS\modules'. $options['namespace'] . '\Controller';
                
                if (empty($this->module_objects[$path])) 
                    $this->module_objects[$path] = new $this->module_class;
         
                if (is_callable(array($this->module_class, $event)))
                   $this->module_objects[$path]->$event($event_data, $this);
        }
    }
    
    private function fetchModuleOptions() {
        if (cache::fetch('module_options', config::core('caching')['directory_scans'])) {
            $this->module_options = unserialize(cache::fetch('module_options'));
            return;
        }
        
        foreach(glob(dirname(__FILE__) . '/../../modules/*/options.php') as $value) {
            $module_options = include $value;
            
            if ($module_options['enabled'] == true) 
                $this->module_options[str_replace('options.php', '', $value)] = $module_options;
        }
        cache::store('module_options', $this->module_options);
    }
}