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

// AssetProcessori jaoks
Route::get('/assets/{type}/{name}', \Config::get('assetprocessor::controller.name') . '@' . \Config::get('assetprocessor::controller.method'));

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('eksamist', function()
{
	return View::make('eksamist');
});

Route::get('kysiAbi', array('before' => 'auth', function()
{
	return View::make('kysiAbi');
}));

/*Route::get('secret', array('before' => 'auth', function()
{
	return View::make('salajane');
}));*/

Route::get('avaldised', array('before' => 'guest', 'uses' => 'AuthController@loginPage'));
Route::get('login', array('before' => 'guest', 'uses' => 'AuthController@loginPage'));
Route::post('login', array('before' => 'guest|csrf', 'uses' => 'AuthController@loginSubmit'));
Route::get('logout', array('before' => 'auth|csrf', 'uses' => 'AuthController@logout'));
Route::get('signup', array('before' => 'guest', 'uses' => 'AuthController@signupPage'));
Route::post('signup', array('before' => 'guest|csrf', 'uses' => 'AuthController@signupSubmit'));
Route::get('login/facebook', array('before' => 'guest', 'uses' => 'AuthController@loginFacebook'));
Route::get('login/facebook/callback', array('before' => 'guest', 'uses' => 'AuthController@loginFacebookCallback'));

Route::get('avaldised', array('before' => 'auth','uses' => 'TestController@GetTest'));
Route::post('avaldised', array('before' => 'auth','uses' => 'TestController@CheckTest')); 

Route::get('/protip', function()
{
	$lause = '';
	switch(rand() % 3)
	{
		case 0:
			$lause = 'Alusta õppimist enne eksamieelset ööd!';
			break;
		case 1:
			$lause = 'Ära mängi arvutimänge!';
			break;
		case 2:
			$lause = 'Söö tükike šokolaadi!';
			break;
	}
	$data = array(
		'html' => '<div id="tip"><h1>'.$lause.'</h1></div>'
	);
	return Response::json($data);
});

Route::get('secret', array('before' => 'auth','uses' => 'ProfileController@GetProfileInfo'));




