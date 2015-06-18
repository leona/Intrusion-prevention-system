<?php

require('definitions.php');

foreach($definitions as $key => $value) {
    foreach($value as $class) {
        require($key . '/' . $class . '.php');
    }
}