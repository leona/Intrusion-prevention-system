<?php
namespace IPS\modules\CacheManager;
use IPS\core\classes\BaseModule;
use IPS\core\classes\cache;

class Controller extends BaseModule {
    
    private $cache;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function startModule($data, $core) {
        $this->cache = new cache;
        $this->cache->file('start', 'home', 20);
        
    }
    
    public function endModule() {
        $this->cache->file('end', 'home', 20);

    }
    

    
}