<?php
require_once('core/autoload.php');

use IPS\core\classes\initCore;

if (!defined('initiated')) {
    $start = microtime(true);
    define('initiated', true);
    
    $core = new initCore;
    
    $core->runModulesEvent('startModule');
} else {
    
    $core->runModulesEvent('endModule');

    $end =  microtime(true) - $start;
    echo '<br>Overhead: ' . $end;
}