<?php

$app->get('/kpm/v1/users', 'KPM\Controllers\UserController:getAll');

$app->get('/kpm/v1/users/{id}', 'KPM\Controllers\UserController:getById');

$app->post('/kpm/v1/users', 'KPM\Controllers\UserController:insertOrUpdate');

$app->put('/kpm/v1/users/{id}', 'KPM\Controllers\UserController:insertOrUpdate');

$app->delete('/kpm/v1/users/{id}', 'KPM\Controllers\UserController:delete');
