<?php

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

$container['auth'] = function ($container) {
	return new \App\Auth\Auth;
};

// add Slim Flash messages
$container['flash'] = function () {
    return new \Slim\Flash\Messages();
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

	// let the view have access to auth component
	$view->getEnvironment()->addGlobal('auth', [
		'check' => $container->auth->check(),
		'user' => $container->auth->user()
	]);

    // let the view have access to flash messages
	$view->getEnvironment()->addGlobal('flash', $container->flash);

    return $view;
};

$container['validator'] = function ($container) {
	return new \App\Validation\Validator;
};

// add Slim CSRF
$container['csrf'] = function ($container) {
	return new \Slim\Csrf\Guard;
};

$container['HomeController'] = function ($container) {
    return new \App\Controllers\HomeController($container);
};

$container['AuthController'] = function ($container) {
    return new \App\Controllers\AuthController($container);
};

$container['PasswordController'] = function ($container) {
    return new \App\Controllers\PasswordController($container);
};