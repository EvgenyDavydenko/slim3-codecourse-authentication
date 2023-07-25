<?php

// give back errors
$app->add(new \App\Middleware\ValidationErrorsMiddleware($container));