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

// Controllers
$container['KPM\Controllers\CategoryPostItController'] = function ($c) {
    $categoryAction = new \KPM\Actions\CategoryPostItAction($c->entityManager);
    return new \KPM\Controllers\CategoryPostItController($categoryAction);
};

$container['KPM\Controllers\CommentController'] = function ($c) {
    $commentAction = new \KPM\Actions\CommentAction($c->entityManager);
    return new \KPM\Controllers\CommentController($commentAction);
};

$container['KPM\Controllers\PermissionController'] = function ($c) {
    $permissionAction = new \KPM\Actions\PermissionAction($c->entityManager);
    return new \KPM\Controllers\PermissionController($permissionAction);
};

$container['KPM\Controllers\PriorityController'] = function ($c) {
    $priorityAction = new \KPM\Actions\PriorityAction($c->entityManager);
    return new \KPM\Controllers\PriorityController($priorityAction);
};

$container['KPM\Controllers\ProjectController'] = function ($c) {
    $projectAction = new \KPM\Actions\ProjectAction($c->entityManager);
    return new \KPM\Controllers\ProjectController($projectAction);
};
