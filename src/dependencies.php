<?php
// DIC configuration

$container = $app->getContainer();

// db connection 1 - connection to SAP_INTEGRATION_DB - reconnector to other DBs
$container['db'] = function ($c) {
    $db_settings = $c->get('settings')['db'];
    $pdo = new PDO( $db_settings['pdo_string']. $db_settings['dbname'],$db_settings['user'], $db_settings['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

/* // view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
}; */
