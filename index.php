<?php

require __DIR__ . '/vendor/autoload.php';

//app configuration
$settings = require __DIR__ . '/src/settings.php';

//app initiation
$app = new \Slim\App($settings);
$container = $app->getContainer();

// Set up dependenciess
require __DIR__ . '/src/dependencies.php';

// Register middleware
require __DIR__ . '/src/middleware.php';

//model
require __DIR__ . '/models/users.php';

//router
require __DIR__ . '/routes/users.php';

// Run app
$app->run();