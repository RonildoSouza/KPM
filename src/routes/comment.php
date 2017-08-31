<?php

// $app->get('/kpm/v1/comments', 'KPM\Controllers\CommentController:getAll');

$app->get('/kpm/v1/comments/{id}', 'KPM\Controllers\CommentController:getById');

$app->post('/kpm/v1/comments', 'KPM\Controllers\CommentController:insertOrUpdate');

$app->put('/kpm/v1/comments/{id}', 'KPM\Controllers\CommentController:insertOrUpdate');

$app->delete('/kpm/v1/comments/{id}', 'KPM\Controllers\CommentController:delete');
