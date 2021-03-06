<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password'); 
	
	protected $fillable = array ('username', 'password', 'email', 'confirmed');
	
	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}
	
	public static function rules(){
		static $rules =  array (
			'email' => array ('required', 'email', 'unique:users'),
			'username' => array ('required', 'between:4,30', 'alpha_num', 'unique:users'),
			'password' => array ('required', 'min:6'),
			'confirmed' => array ('required', 'in:0,1')
		);
		
		return $rules;
	}

}