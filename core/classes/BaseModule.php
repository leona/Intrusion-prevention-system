<?php

namespace IPS\core\classes;

class BaseModule {
    
    private $child;
    
    public function __construct() {
        $this->child = get_called_class();
    }
    public function server($key) {
        if (!empty($_SERVER[$key])) 
            return $_SERVER[$key];
    }
    
    public function throwException($rtn_obj) {
        
    }
    
    public function moduleOption($name) {
        $controller_path = str_replace('controller.php', '', (new \ReflectionClass($this->child))->getFileName());
        
        $options = include($controller_path . 'options.php');
        
        return $options[$name];
    }
    
    public function badRequest($severity = 1) {
        if ($severity >= 2 && $severity <= 3)
            $this->logClient(array('msg' => $this->moduleOption('error_msg')[$severity]));
            
        $this->throwError();
    }
    
    public function fetchLog($level) {
        return array(
                'trigger'     => $this->child,
                'level'       => $level,
                'message'     => $this->moduleOption('error_msg')[$level],
                'request_uri' => $this->server('REQUEST_URI'),
                'headers' => getallheaders()
        );
    }
    public function throwError($type = null) {
        $type = $type == null ? config::get('bad_request_message') : $type;
        
        switch($type) {
            case '404':
                echo 404;
                break;
        }

    }
}