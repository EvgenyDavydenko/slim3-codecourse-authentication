<?php
session_start();
require __DIR__ . '/../vendor/autoload.php';

$config = require __DIR__ . '/../app/config.php';

// instantiate the App object
$app = new \Slim\App($config);

require __DIR__ . '/../app/container.php';
require __DIR__ . '/../app/middleware.php';
require __DIR__ . '/../app/routes.php';

$app->run();

