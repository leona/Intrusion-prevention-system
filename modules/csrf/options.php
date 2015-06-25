<?php

return array(
    'namespace' => '\CSRF',
    'enabled' => true,//config::moduleStatus('csrf');
    'error_msg' => array(
        1 => 'CSRF token/origin mismatch.',
    ),
);