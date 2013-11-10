<?php

class RegistrationController extends \BaseController {


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$attributes = Input::except(array('_token', '_method'));
		$attributes['confirmed'] = 1;
		
		$validator = Validator::make($attributes, User::rules());
		
		if($validator->passes()){
			
			$attributes['password'] = Hash::make($attributes['password']);

			if(is_object(User::create($attributes))){
				if(Auth::attempt(array ('username' => Input::get('username'), 'password' => Input::get('password')))){
					return Redirect::intended('feed');
				}
			}
		}
		
		return Redirect::to('/')
				->withErrors($validator)
				->withInput(Input::except(array('password')));
	}

}