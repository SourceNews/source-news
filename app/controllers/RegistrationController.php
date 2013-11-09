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
		
		$validator = Validator::make($attributes, User::rules());
		
		if($validator->passes()){
			if(is_object(User::create($attributes)))
				return Redirect::to('article');
		}
		
		return Redirect::to('/')
				->withErrors($validator)
				->withInput();
	}

}