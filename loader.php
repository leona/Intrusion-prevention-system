<?php
require_once('core/autoload.php');

use IPS\core\classes\initCore;


if (!defined('ips_initiated')) {
    define('ips_path', dirname(__FILE__));
    
    $start = microtime(true);
    define('ips_initiated', true);
    
    $core = new initCore;
    
    $core->runModulesEvent('startModule');
} else {
    
    $core->runModulesEvent('endModule');
    
    $end =  microtime(true) - $start;
    echo '<br>Overhead: ' . $end;
}