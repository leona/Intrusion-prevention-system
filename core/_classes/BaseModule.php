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
        return $this->conditionKeyArray(function($key, $value) {
            if ($value == true) return $key;
        }, $this->moduleOption('enabled_features'));
    }
    
    protected function conditionKeyArray($callback, $array) {
        return array_filter(array_walk(function($key, $value) {
            return $callback($key, $value);
        }, $array));
    }
    
    protected function conditionArray($callback, $array) {
        return array_filter(array_map(function($value) {
            return $callback($value);
        }, $array));
    }
   
    protected function asset($name) {
        return $this->fetchChildDir() . 'assets/' . $name;
    }
    
    protected function renderView($name) {
        include($this->fetchChildDir() . 'views/' . $name . '.php');
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
}t