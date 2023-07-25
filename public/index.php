<?php

require __DIR__ . '/../vendor/autoload.php';

$config = require __DIR__ . '/../app/config.php';

// instantiate the App object
$app = new \Slim\App($config);

// Get container
$container = $app->getContainer();

// create instance of Capsule Manager as $capsule obj
$capsule = new \Illuminate\Database\Capsule\Manager;

// add connection using db config in settings
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

// create 'db' property
$container['db'] = function ($container) use ($capsule) {
	return $capsule;
};

// Register component on container
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(__DIR__ . '/../views', [
        'cache' => false
    ]);

    // Instantiate and add Slim specific extension
    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new \Slim\Views\TwigExtension($router, $uri));

    return $view;
};

$container['validator'] = function ($container) {
	return new App\Validation\Validator;
};

$container['HomeController'] = function ($container) {
    return new \App\Controllers\HomeController($container);
};

$container['AuthController'] = function ($container) {
    return new \App\Controllers\AuthController($container);
};

require __DIR__ . '/../app/routes.php';

$app->run();

