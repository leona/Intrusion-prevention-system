<?php
namespace IPS\modules\CSRF;
use IPS\core\classes\BaseModule;
use IPS\core\classes\Helper;

class Controller extends BaseModule {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function startModule($data, $core) {
        //if (Helper::post()) {
            $log_data = $this->fetchLog(2);
            
            ///if ($this->server('HTTP_ORIGIN') && !strpos($this->server('HTTP_ORIGIN'), $this->server('SERVER_NAME'))) 
                $core->runModulesEvent('clientException', $log_data);

            if ($this->server('HTTP_REFERER') && parse_url($this->server('HTTP_REFERER'))['host'] !== $this->server('SERVER_NAME'))
                $core->runModulesEvent('clientException', $log_data);
        //}
    }
}