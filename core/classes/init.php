<?php

namespace IPS\core\classes;
use IPS\core\classes\cache;

class initCore {
    
    private $module_options = array();
    private $module_objects = array();
    
    public function __construct() {
        $this->fetchModuleOptions();

    }
    
    public function runModulesEvent($event, $event_data = null) {
        foreach($this->module_options as $path => $options) {
                include_once($path . 'controller.php');
                
                if (empty($this->module_objects[$path])) {
                    $module_class = '\IPS\modules'. $options['namespace'] . '\Controller';
                    
                    $this->module_objects[$path] = new $module_class;
                }
                if (method_exists($this->module_objects[$path], $event));
                    $this->module_objects[$path]->$event($event_data);
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