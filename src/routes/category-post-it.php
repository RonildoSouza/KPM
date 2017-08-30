<?php

/**
 * 
 */
$app->get('/kpm/v1/categories', 'KPM\Controllers\CategoryPostItController:getAll');
$app->get('/kpm/v1/categories/{id}', 'KPM\Controllers\CategoryPostItController:getById');

/**
 * 
 * {"acronym":"ABCD","name":"New Category"}
 */
$app->post('/kpm/v1/categories', 'KPM\Controllers\CategoryPostItController:insertOrUpdate');

/**
 * 
 * {"id":1,"acronym":"EFGH","name":"Modify Category"}
 */
$app->put('/kpm/v1/categories', 'KPM\Controllers\CategoryPostItController:insertOrUpdate');
$app->delete('/kpm/v1/categories/{id}', 'KPM\Controllers\CategoryPostItController:delete');
