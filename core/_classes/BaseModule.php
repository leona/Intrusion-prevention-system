<?php

namespace IPS\core\classes;

class BaseModule {
    
    private $child;
    private $child_dir;
    private $options;
    
    public function __construct() {
        $this->child = get_called_class();
    }
    
    protected function server($key) {
        if (!empty($_SERVER[$key]))
            return $_SERVER[$key];
    }

    protected function post($key) {
        if (!empty($_POST[$key]))
            return $_POST[$key];
    }
    
    protected function moduleOption($name) {
        if (empty($this->options))
            $this->options = include($this->fetchChildDir() . 'options.php');
        
        return $this->options[$name];
    }
    
    protected function enabledFeatures() {
        $this->enabled_features = $this->filterArray($this->moduleOption('enabled_features'));
        
        return $this->enabled_features;
    }
    
    protected function conditionKeyArray($callback, $array, &$result) {
        array_walk($array, function(&$key, $value) use($callback) {
            return $callback($key, $value);
        });

        $this->filterArray($array);
        $result = $array;
        return $array;
    }
    
    protected function conditionArray($callback, $array, &$result) {
        $rtn = array_map(function($value) use($callback) {
            return $callback($value);
        }, $array);
        
        $this->filterArray($rtn);
        $result = $rtn;
        return $rtn;
    }
    
    private function filterArray(&$arr) {
        if (is_array($arr)) 
            $arr = array_filter($arr);
            
        return $arr;
    }
    
    protected function asset($name) {
        return $this->fetchChildDir() . 'assets/' . $name;
    }
    
    protected function renderView($name, $core = null) {
        include($this->fetchChildDir() . 'views/' . $name . '.php');
           
        if (!empty($core))
            $core->runModulesEvent('endModules');
            
        die();
    }
    
    protected function buildLog($level) {
        return array(
                'trigger'     => $this->child,
                'level'       => $level,
                'message'     => $this->moduleOption('error_msg')[$level],
                'request_uri' => $this->server('REQUEST_URI'),
                'headers'     => implode('|', getallheaders())
        );
    }
    
    protected function fetchChildDir() {
        if (!empty($this->child_dir)) return $this->child_dir;
        
        $this->child_dir = str_replace('controller.php', '', (new \ReflectionClass($this->child))->getFileName());
        
        return $this->child_dir;
    }
    
    protected function dd($array) {
        print_r($array);
        die();
    }
}