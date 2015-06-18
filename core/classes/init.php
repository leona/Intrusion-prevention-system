<?php

namespace IPS\core\classes;


class initCore {
    
    private $module_options = array();
    private $module_objects = array();
    
    public function __construct() {
        $this->fetchModuleOptions();
    
    }
    
    public function runModulesEvent($event, $event_data = null) {
        foreach($this->module_options as $path => $options) {
            if (in_array($event, $options['events'])) {
                include_once($path . 'controller.php');
                
                if (empty($this->module_objects[$path])) {
                    $module_class = '\IPS\modules'. $options['namespace'] . '\Controller';
                    
                    $this->module_objects[$path] = new $module_class;
                }
                
                $this->module_objects[$path]->eventListener($event, $event_data);
            }
        }
    }
    
    private function fetchModuleOptions() {
        foreach(glob(dirname(__FILE__) . '/../../modules/*/options.php') as $value) {
            $module_options = include $value;
            
            if ($module_options['enabled'] == true) 
                $this->module_options[str_replace('options.php', '', $value)] = $module_options;
        }
    }
}