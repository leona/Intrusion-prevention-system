<?php
use IPS\core\classes\initCore;

$core = new initCore;

if (!defined('initiated')) {
    define('initiated', true);
    
    $core->loadModulesBy(array(
        'initiation_type' => 'start'
    ));
} else {
    $core->loadModulesBy(array(
        'initiation_type' => 'end'
    ));
}