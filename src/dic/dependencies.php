<?php
// require('/../actions/CategoryPostItAction.php');
// require('/../controllers/CategoryPostItController.php');

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

// Actions
$container['KPM\Controllers\CategoryPostItController'] = function ($c) {
    $categoryAction = new \KPM\Actions\CategoryPostItAction($c->entityManager);
    return new \KPM\Controllers\CategoryPostItController($categoryAction);
};
