<?php
// Dependency Container - Slim
$container = $app->getContainer();

// EntityManager - Doctrine
$container['entityManager'] = $entityManager;

// Logger - Monolog
$container['logger'] = function ($c) {
    $logParams = $c['settings']['logParams'];

    $logger = new Monolog\Logger($logParams['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($logParams['path'], $logParams['level']));
    return $logger;
};
