<?php

$app->get('/kpm/v1/status', 'KPM\Controllers\StatusController:getAll');

$app->get('/kpm/v1/status/{id}', 'KPM\Controllers\StatusController:getById');

$app->post('/kpm/v1/status', 'KPM\Controllers\StatusController:insertOrUpdate');

$app->put('/kpm/v1/status/{id}', 'KPM\Controllers\StatusController:insertOrUpdate');

$app->delete('/kpm/v1/status/{id}', 'KPM\Controllers\StatusController:delete');
