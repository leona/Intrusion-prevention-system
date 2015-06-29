<?php
namespace IPS\modules\AccessRestriction;
use IPS\core\classes\BaseModule;
use IPS\core\models\log;

class Controller extends BaseModule {
    
    private $core;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function startModule($data, $core) {
        $this->core           = $core;
        $this->client_profile = log::clientProfile();

        if (is_object($this->client_profile)) 
            $this->validateClient();
    }
    
    public function validateClient() {
        if ($this->client_profile->permanently_banned) {
            $this->core->runModulesEvent('clientException', array('level' => 3));
        } 
    }
    public function endModule() {
        
    }

}