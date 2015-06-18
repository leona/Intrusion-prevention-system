<?php
use IPS\core\classes\initCore;

if (!defined('initiated')) {
    define('initiated', true);
    
    $core = new initCore;
    
    $core->runModulesEvent('start');
} else {
    
    $core->runModulesEvent('end');
}