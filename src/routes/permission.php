<?php

$app->get('/kpm/v1/permissions', 'KPM\Controllers\PermissionController:getAll');

$app->get('/kpm/v1/permissions/{id}', 'KPM\Controllers\PermissionController:getById');
