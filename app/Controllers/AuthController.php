<?php

namespace App\Controllers;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use App\Models\User;

class AuthController extends Controller {

    public function getSignup(Request $request, Response $response, array $args){
        return $this->c->view->render($response, 'signup.twig');
    }

    public function postSignup(Request $request, Response $response, array $args){
        // var_dump($request->getParams());
        // exit;
        $user = User::create([
			'email' => $request->getParam('email'),
			'name' => $request->getParam('name'),
			'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
		]);
        return $response->withRedirect($this->c->router->pathFor('home'));
    }
}

