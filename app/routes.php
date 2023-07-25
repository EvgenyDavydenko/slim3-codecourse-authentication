<?php

$app->get('/', 'HomeController:index')->setName('home');

$app->get('/{name}', 'HomeController:profile')->setName('profile');

$app->get('/auth/signup', 'AuthController:getSignup');
$app->post('/auth/signup', 'AuthController:postSignup')->setName('signup');