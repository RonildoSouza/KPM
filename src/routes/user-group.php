<?php

$app->get('/kpm/v1/user-groups', 'KPM\Controllers\UserGroupController:getAll');

$app->get('/kpm/v1/user-groups/{id}', 'KPM\Controllers\UserGroupController:getById');

$app->post('/kpm/v1/user-groups', 'KPM\Controllers\UserGroupController:insertOrUpdate');

$app->put('/kpm/v1/user-groups/{id}', 'KPM\Controllers\UserGroupController:insertOrUpdate');

$app->delete('/kpm/v1/user-groups/{id}', 'KPM\Controllers\UserGroupController:delete');
