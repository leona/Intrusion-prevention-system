<?php
namespace IPS\modules\CSRF;
use IPS\core\classes\http;
use IPS\core\classes\BaseModule;
use IPS\core\classes\Helper;

class Controller extends BaseModule {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function startModule() {
        if (Helper::post()) {
            if ($this->server('HTTP_ORIGIN') && !strpos($this->server('HTTP_ORIGIN'), $this->server('SERVER_NAME'))) 
                $this->badRequest(2);

            if ($this->server('HTTP_REFERER') && parse_url($this->server('HTTP_REFERER'))['host'] !== $this->server('SERVER_NAME'))
                $this->badRequest(2);
        }
    }
}