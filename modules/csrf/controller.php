<?php
namespace IPS\modules\CSRF;
use IPS\core\classes\BaseModule;
use IPS\core\classes\Helper;
use IPS\core\models\log;
class Controller extends BaseModule {
    
    public function __construct() {
        parent::__construct();
        
    }
    
    public function startModule($data, $core) {
        if (Helper::post()) {
            if ($this->server('HTTP_ORIGIN') && !strpos($this->server('HTTP_ORIGIN'), $this->server('SERVER_NAME'))) {
                $core->runModulesEvent('clientException', $this->buildLog(1));
                
            } else if ($this->server('HTTP_REFERER') && parse_url($this->server('HTTP_REFERER'))['host'] !== $this->server('SERVER_NAME')) {
                $core->runModulesEvent('clientException', $this->buildLog(1));
            }
        }
    }
}