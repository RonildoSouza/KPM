<?php

define("DEV_MODE", true);

/**
 * Slim Configuration
 */
$config['displayErrorDetails'] = DEV_MODE;
$config['addContentLengthHeader'] = false;


/**
 * Database Connection Configuration
 */
$config['dbParams'] = array(
    'driver'   => 'pdo_sqlite',
    'path'     => __DIR__ . '/kpm_db.sqlite',
    // 'driver'   => 'pdo_mysql',
    // 'host'     => 'localhost',
    // 'user'     => 'root',
    // 'password' => 'passwd',
    // 'dbname'   => 'kpm_db',
    // 'port'     => 3306,
);


/**
 * Monolog settings
 */
$config['logParams'] = array(
    'name'  => 'KPM',
    'path'  => __DIR__ . '/logs/kpm.log',
    'level' => \Monolog\Logger::DEBUG,
);
