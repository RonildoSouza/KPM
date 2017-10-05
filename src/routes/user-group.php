<?php

$app->get('/kpm/v1/users-group', 'KPM\Controllers\UserGroupController:getAll');

$app->get('/kpm/v1/users-group/{id}', 'KPM\Controllers\UserGroupController:getById');

$app->post('/kpm/v1/users-group', 'KPM\Controllers\UserGroupController:insertOrUpdate');

$app->put('/kpm/v1/users-group/{id}', 'KPM\Controllers\UserGroupController:insertOrUpdate');

$app->delete('/kpm/v1/users-group/{id}', 'KPM\Controllers\UserGroupController:delete');
