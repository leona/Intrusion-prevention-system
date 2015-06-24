<?php
require(dirname(__FILE__) . '/classes/cache.php');
require(dirname(__FILE__) . '/classes/config.php');

use IPS\core\classes\cache;
use IPS\core\classes\config;

if (cache::fetch('core_structure', config::core('caching')['directory_scans'])) {
    $dir_structure = unserialize(cache::fetch('core_structure'));
} else {
    $dir_structure = glob(dirname(__FILE__) . '/*/*.php');
    cache::store('core_structure', $dir_structure);
}
foreach($dir_structure as $value)
    include_once($value);