<?php 

class UserController extends \BaseController
{
	public function login()
	{
		if(Auth::attempt(array ('username' => Input::get('username'), 'password' => Input::get('password')))){
			return Redirect::intended('/feed');
		}
		
		else {
			Return Redirect::to('/login')->with('login_errors', true);
		}
	}
	
	public function logout()
	{
		Auth::logout();		
		return Redirect::to('/');
	}
}


?>