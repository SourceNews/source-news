<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(array ('before' => 'auth'), function (){
	Route::get('/feed', function () {
		return View::make('feed');
	});
	
	Route::get('article', function(){
		return View::make('article');
	});
	
	Route::get('test', function(){
		return View::make('test');
	});
	
	Route::get('js-test', function(){
		return View::make('js-test');
	});
	
	Route::get('/logout', 'UserController@logout');
		
});


Route::get('/', function(){
	return View::make('index');
});
	
Route::group(array('before' => 'guest'),function(){
	Route::post('login', array('before' => 'csrf', 'uses' => 'UserController@login'));
	Route::post('register', array('before' => 'csrf', 'uses' => 'RegistrationController@store'));
});
	

Route::get('test', function(){

	return View::make('test');

});

Route::post('register', array('before' => 'csrf', 'uses' => 'RegistrationController@store'));

Route::get('loadrss', 'RssFeedController@loadRss');
