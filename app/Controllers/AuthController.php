<?php

namespace App\Controllers;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Respect\Validation\Validator as v;
use App\Models\User;

class AuthController extends Controller {

    public function getSignOut($request, $response)
	{
		$this->c->auth->logout();
        $this->c->flash->addMessage('info', 'Вы вышли из аккаунта');
		return $response->withRedirect($this->c->router->pathFor('home'));
	}

    public function getSignIn(Request $request, Response $response, array $args){
        return $this->c->view->render($response, 'auth/signin.twig');
    }

    public function postSignIn(Request $request, Response $response, array $args){
        // use the attempt class
		$auth = $this->c->auth->attempt(
			$request->getParam('email'),
			$request->getParam('password')
		);

        if (!$auth) {
            $this->c->flash->addMessage('error', 'Нет такого пользователя');
			return $response->withRedirect($this->c->router->pathFor('signin'));
		}
        $this->c->flash->addMessage('success', 'Вы вошли в аккаунт');
        return $response->withRedirect($this->c->router->pathFor('home'));
    }

    public function getSignUp(Request $request, Response $response, array $args){
        return $this->c->view->render($response, 'auth/signup.twig');
    }

    public function postSignUp(Request $request, Response $response, array $args){
        $validation = $this->c->validator->validate($request, [
			'email' => v::noWhitespace()->notEmpty()->emailAvailable(),
			'name' => v::notEmpty()->alpha(),
			'password' => v::noWhitespace()->notEmpty(),
		]);

		if ($validation->failed()) {
            $this->c->flash->addMessage('error', 'Не верно ввели данные формы');
			return $response->withRedirect($this->c->router->pathFor('signup'));
		}
        
        // var_dump($request->getParams());
        // exit;
        $user = User::create([
			'email' => $request->getParam('email'),
			'name' => $request->getParam('name'),
			'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
		]);

        $this->c->flash->addMessage('info', 'Вы зарегистрированы');

        // log the user directly in
		$this->c->auth->attempt($user->email, $request->getParam('password'));

        return $response->withRedirect($this->c->router->pathFor('home'));
    }
}

