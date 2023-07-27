<?php

use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;

$app->get('/', 'HomeController:index')->setName('home');

$app->get('/{name}', 'HomeController:profile')->setName('profile');

// when a user is signed in
$app->group('', function() use ($app){
    $app->get('/auth/signup', 'AuthController:getSignUp');
    $app->post('/auth/signup', 'AuthController:postSignUp')->setName('signup');

    $app->get('/auth/signin', 'AuthController:getSignIn');
    $app->post('/auth/signin', 'AuthController:postSignIn')->setName('signin');
})->add(new GuestMiddleware($container));

// when the user isn't signed in
$app->group('', function() use ($app){
    $app->get('/auth/signout', 'AuthController:getSignOut')->setName('signout');

    $app->get('/password/change', 'PasswordController:getChangePassword');
    $app->post('/password/change', 'PasswordController:postChangePassword')->setName('changepass');
})->add(new AuthMiddleware($container));