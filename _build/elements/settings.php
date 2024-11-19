<?php

return [
    'frontend_css' => [
        'xtype' => 'textfield',
        'value' => '[[+cssUrl]]web/default.css',
        'area' => 'cookieaccept_main',
    ],
    'frontend_js' => [
        'xtype' => 'textfield',
        'value' => '[[+jsUrl]]web/default.js',
        'area' => 'cookieaccept_main',
    ],
    'cookie_lifetime' => [
        'xtype' => 'textfield',
        'value' => '1209600',
        'area' => 'cookieaccept_main',
    ],
    'active' => [
        'xtype' => 'combo-boolean',
        'value' => 1,
        'area' => 'cookieaccept_main',
    ],
    'page_policy' => [
        'xtype' => 'textfield',
        'value' => 1,
        'area' => 'cookieaccept_main',
    ],
];