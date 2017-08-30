<?php

require __DIR__ . '/test.php';

// CategoryPostIt Routes
// $app->get('/kpm/v1/categories', 'KPM\Controllers\CategoryPostItController:test');
$app->get('/kpm/v1/categories', 'KPM\Controllers\CategoryPostItController:getAll');
$app->get('/kpm/v1/categories/{id}', 'KPM\Controllers\CategoryPostItController:getById');