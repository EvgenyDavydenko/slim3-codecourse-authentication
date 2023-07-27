<?php

namespace App\Controllers;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use App\Models\User;

class AuthController extends Controller {

    public function getSignIn(Request $request, Response $response, array $args){
        return $this->c->view->render($response, 'signin.twig');
    }

    public function postSignIn(Request $request, Response $response, array $args){
        return $response->withRedirect($this->c->router->pathFor('home'));
    }

    public function getSignUp(Request $request, Response $response, array $args){
        return $this->c->view->render($response, 'signup.twig');
    }

    public function postSignUp(Request $request, Response $response, array $args){
        $validation = $this->c->validator->validate($request);

		if ($validation->failed()) {
			return $response->withRedirect($this->c->router->pathFor('signup'));
		}
        
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

