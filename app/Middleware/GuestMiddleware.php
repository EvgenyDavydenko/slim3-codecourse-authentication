<?php

namespace App\Middleware;

class GuestMiddleware extends Middleware
{
	public function __invoke($request, $response, $next)
	{
		// check if the user is signed in
		if ($this->c->auth->check()) {
			return $response->withRedirect($this->c->router->pathFor('home'));
		}

		// standard middelware
		$response = $next($request, $response);
		return $response;
	}
}