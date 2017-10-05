<?php

// Enable lazy CORS
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});
////

require_once(__DIR__ . '/test.php');

require_once(__DIR__ . '/category-post-it.php');

require_once(__DIR__ . '/comment.php');

require_once(__DIR__ . '/permission.php');

require_once(__DIR__ . '/postit.php');

require_once(__DIR__ . '/priority.php');

require_once(__DIR__ . '/project.php');

require_once(__DIR__ . '/status.php');

require_once(__DIR__ . '/user.php');

require_once(__DIR__ . '/user-group.php');
