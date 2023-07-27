<?php

namespace App\Controllers;

class PasswordController extends Controller
{
	public function getChangePassword($request, $response)
	{
		return $this->c->view->render($response, 'password/change.twig');
	}

	public function postChangePassword($request, $response)
	{

	}
}