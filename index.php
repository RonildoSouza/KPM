<?php

// Initialization
require __DIR__ . '/bootstrap.php';

session_start();

// Register Dependency Container
require __DIR__ . '/src/dic/dependencies.php';

// Register Routes
require __DIR__ . '/src/routes/routes.php';

// Run Slim
$app->run();
