<?php

$app->get('/kpm/v1/projects', 'KPM\Controllers\ProjectController:getAll');

$app->get('/kpm/v1/projects/{id}', 'KPM\Controllers\ProjectController:getById');

$app->post('/kpm/v1/projects', 'KPM\Controllers\ProjectController:insertOrUpdate');

$app->put('/kpm/v1/projects/{id}', 'KPM\Controllers\ProjectController:insertOrUpdate');

$app->delete('/kpm/v1/projects/{id}', 'KPM\Controllers\ProjectController:delete');
