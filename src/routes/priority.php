<?php

$app->get('/kpm/v1/priorities', 'KPM\Controllers\PriorityController:getAll');

$app->get('/kpm/v1/priorities/{id}', 'KPM\Controllers\PriorityController:getById');

$app->post('/kpm/v1/priorities', 'KPM\Controllers\PriorityController:insertOrUpdate');

$app->put('/kpm/v1/priorities/{id}', 'KPM\Controllers\PriorityController:insertOrUpdate');

$app->delete('/kpm/v1/priorities/{id}', 'KPM\Controllers\PriorityController:delete');
