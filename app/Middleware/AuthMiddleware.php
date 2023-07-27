<?php

namespace App\Middleware;

class AuthMiddleware extends Middleware
{
	public function __invoke($request, $response, $next)
	{
		// check if the user is not signed in
		if (!$this->c->auth->check()) {
			$this->c->flash->addMessage('error', 'Please sign in before doing that');
			return $response->withRedirect($this->c->router->pathFor('home'));
		}

		$response = $next($request, $response);
		return $response;
	}
}