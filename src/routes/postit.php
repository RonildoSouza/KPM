<?php

$app->get('/kpm/v1/post-its', 'KPM\Controllers\PostItController:getAll');

$app->get('/kpm/v1/post-its/{id}', 'KPM\Controllers\PostItController:getById');

$app->post('/kpm/v1/post-its', 'KPM\Controllers\PostItController:insertOrUpdate');

$app->put('/kpm/v1/post-its/{id}', 'KPM\Controllers\PostItController:insertOrUpdate');

$app->delete('/kpm/v1/post-its/{id}', 'KPM\Controllers\PostItController:delete');
