<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        'token' => 'stn465#0!7',

        //database settings
        //site management database and user
        'db' => [
            'pdo_string' => 'mysql:host=localhost;dbname=',
            'user' => 'root',
            'pass' => '',
            'dbname' => 'slimtest3'
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slimtest3',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app_' .date('m_Y') . '.log',
            'level' => \Monolog\Logger::DEBUG,
        ] 

        /* // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ], */

        
    ]
];
