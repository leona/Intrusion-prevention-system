<?php

namespace IPS\core\classes;

class BaseModule {
    
    public function server($key) {
        if (!empty($_SERVER[$key])) 
            return $_SERVER[$key];
    }
    
    public function throwException($rtn_obj) {
        
    }
    
    public function moduleOption($name) {
        $class = get_called_class();
        $controller_path = str_replace('controller.php', '', (new \ReflectionClass($class))->getFileName());
        
        $options = include($controller_path . 'options.php');
        
        return $options[$name];
    }
    
    public function badRequest() {
        //switch(config::get('bad_request_message')
        die('Failure');
    }
}