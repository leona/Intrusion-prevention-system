<?php

return array(
    'namespace' => '\uploadChecker',
    'enabled'   => true,
    'blacklisted_filetypes' => array('text/php', 'text/x-php', 'application/php', 'application/x-php', 'application/x-httpd-php', 'application/x-httpd-php-source'),
    'blacklisted_filenames' => array('html', 'php', 'js', 'phtml')
    
);