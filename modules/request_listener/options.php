<?php

return array(
    'namespace' => '\RequestListener',
    'enabled'   => true,
    'enabled_features' => array(
        'header_implode_scan'   => true,
        'individual_post_scan'  => false,
        'individual_get_scan'   => false,
        'regex_scanning'        => false,
        'smart_scanning'        => false, //Scan certain things only if client is engaging in familiar malicious activity
    )
);