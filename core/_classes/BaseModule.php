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
            
        if (!empty($this->options[$name])) {
            return $this->options[$name];
        } else {
            $this->serverException('Module option "' . $name . '" not found');
        }
    }
    
    protected function enabledFeatures() {
        $this->enabled_features = $this->filterArray($this->moduleOption('enabled_features'));
        
        return $this->enabled_features;
    }
    
    protected function conditionKeyArray($callback, $array, &$result) {
        array_walk($array, function(&$key, $value) use($callback) {
            return $callback($key, $value);
        });

        $array = $this->filterArray($array);
        $result = $array;
        return $array;
    }
    
    protected function conditionArray($callback, $array, &$result) {
        $rtn = array_map(function($value) use($callback) {
            return $callback($value);
        }, $array);
        
        $rtn = $this->filterArray($rtn);
        
        $result = $rtn;
        return $rtn;
    }
    
    protected function filterArray($arr) {
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
                'headers'     => implode('|', getallheaders()),
                'post'        => print_r($_POST, true),
                'get'         => print_r($_GET, true)
        );
    }
    
    protected function fetchChildDir() {
        if (!empty($this->child_dir)) return $this->child_dir;
        
        $this->child_dir = str_replace('controller.php', '', (new \ReflectionClass($this->child))->getFileName());
        
        return $this->child_dir;
    }
    
    protected function serverException($msg) {
        echo '<br><pre>Exception thrown: ';
        print_r($msg);
        echo '<br></pre>';
        die();
    }
    protected function dd($array) {
        print_r($array);
        die();
    }
}