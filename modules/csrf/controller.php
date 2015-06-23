<?php
namespace IPS\modules\CSRF;
use IPS\core\classes\http;
use IPS\core\classes\BaseModule;

class Controller extends BaseModule {

    public $bad_request;
    
    public function __construct() {
        $this->analyze_request = $_SERVER['REQUEST_METHOD'] == 'POST';
    }
    
    public function startModule() {
        if ($this->analyze_request) {
            if ($this->server('HTTP_ORIGIN') && !strpos($this->server('HTTP_ORIGIN'), $this->server('SERVER_NAME'))) 
                $this->badRequest();

            if ($this->server('HTTP_REFERER') && parse_url($this->server('HTTP_REFERER'))['host'] !== $this->server('SERVER_NAME'))
                $this->badRequest();
        }
    }
}