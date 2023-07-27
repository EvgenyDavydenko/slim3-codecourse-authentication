<?php

namespace App\Auth;

use App\Models\User;

class Auth
{

	public function attempt($email, $password)
	{
		// get the data of the attempted user
		$user = User::where('email' , $email)->first();
		
		// check if the user exists 
		if (!$user) {
			return false;
		}

		// check if password is valid
		if (password_verify($password, $user->password)) {
			$_SESSION['user'] = $user->id;
			return true;
		}
		
		return false;
	}

}