<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Render Twig template in route

$app->get('/', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, 'list.html');
});

$app->get('/{name}', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, 'profile.html', [
        'name' => $args['name']
    ]);
})->setName('profile');