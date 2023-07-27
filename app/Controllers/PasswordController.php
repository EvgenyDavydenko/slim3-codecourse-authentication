<?php

namespace App\Controllers;
use Respect\Validation\Validator as v;

class PasswordController extends Controller
{
	public function getChangePassword($request, $response)
	{
		return $this->c->view->render($response, 'password/change.twig');
	}

	public function postChangePassword($request, $response)
	{
        $validation = $this->c->validator->validate($request, [
			'password_old' => v::noWhitespace()->notEmpty()->matchesPassword($this->c->auth->user()->password),
			'password' => v::noWhitespace()->notEmpty()
		]);

		if ($validation->failed()) {
            $this->c->flash->addMessage('error', 'Пароли не прошли валидацию');
			return $response->withRedirect($this->c->router->pathFor('changepass'));
		}

		// change the password
		$this->c->auth->user()->setPassword($request->getParam('password'));

		$this->c->flash->addMessage('success', 'Your password has been updated');
		return $response->withRedirect($this->c->router->pathFor('home'));
	}
}