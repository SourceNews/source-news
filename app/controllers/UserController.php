<?php 

class UserController extends \BaseController
{
	public function login()
	{
		if(Auth::attempt(array ('username' => Input::get('username'), 'password' => Input::get('password')))){
			return Redirect::intended('/');
		}
		
		else {
			Return Redirect::to('/login')->with('login_errors', true);
		}
	}
}


?>