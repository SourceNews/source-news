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
	Route::get('feed/{id?}',  'FeedController@showFeed');
	
	Route::get('article/{id}', 'ArticleController@showArticle');
	
	Route::get('loadrss', 'RssFeedController@loadRss');
		
	Route::get('logout', 'UserController@logout');
		
 });

Route::get('/', function(){
	return View::make('index');
});
	
Route::group(array('before' => 'guest'),function(){
	Route::get('login', function(){ return View::make('index'); });
	Route::post('login', array('before' => 'csrf', 'uses' => 'UserController@login'));
	Route::post('register', array('before' => 'csrf', 'uses' => 'RegistrationController@store'));
});
	

Route::post('register', array('before' => 'csrf', 'uses' => 'RegistrationController@store'));

