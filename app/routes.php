<?php

$app->get('/', 'HomeController:index')->setName('home');

$app->get('/{name}', 'HomeController:profile')->setName('profile');

$app->get('/auth/signup', 'AuthController:getSignUp');
$app->post('/auth/signup', 'AuthController:postSignUp')->setName('signup');

$app->get('/auth/signin', 'AuthController:getSignIn');
$app->post('/auth/signin', 'AuthController:postSignIn')->setName('signin');

$app->get('/auth/signout', 'AuthController:getSignOut')->setName('signout');