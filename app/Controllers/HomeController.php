<?php

namespace App\Controllers;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class HomeController {

    protected $view;

    public function __construct(\Slim\Views\Twig $view)
    {
        $this->view = $view;
    }

    public function index(Request $request, Response $response, array $args){
        return $this->view->render($response, 'list.html');
    }

    public function profile(Request $request, Response $response, array $args){
        return $this->view->render($response, 'profile.html', [
            'name' => $args['name']
        ]);
    }
}

