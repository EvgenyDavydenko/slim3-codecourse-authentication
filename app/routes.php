<?php

$app->get('/', 'HomeController:index');

$app->get('/{name}', 'HomeController:profile')->setName('profile');