<?php

require('definitions.php');
 
foreach($definitions as $key => $value) {
    foreach($value as $class) {
        require($key . '/' . $class . '.php');
    }
}


foreach(glob(dirname(__FILE__) . '/*/*.php') as $value) 
    include_once($value);