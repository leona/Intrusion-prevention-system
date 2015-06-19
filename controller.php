<?php
use IPS\core\classes\initCore;

if (!defined('initiated')) {
    $start = microtime(true);
    define('initiated', true);
    
    $core = new initCore;
    
    $core->runModulesEvent('start');
} else {
    
    $core->runModulesEvent('end');

    $end =  microtime(true) - $start;
    echo '<br>Overhead: ' . $end;
}