<?php

require __DIR__ . '/../vendor/autoload.php';

$config = [
    'settings' => [
        'displayErrorDetails' => true
    ]
];

// instantiate the App object
$app = new \Slim\App($config);

require __DIR__ . '/../app/routes.php';

$app->run();

