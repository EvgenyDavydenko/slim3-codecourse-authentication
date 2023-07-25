<?php

namespace App\Controllers;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class HomeController extends Controller {

    public function index(Request $request, Response $response, array $args){
        // $user = $this->c->db->table('users')->find(1);
        // var_dump($user->email);
        // exit;
        return $this->c->view->render($response, 'list.twig');
    }

    public function profile(Request $request, Response $response, array $args){
        return $this->c->view->render($response, 'profile.twig', [
            'name' => $args['name']
        ]);
    }
}

