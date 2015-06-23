<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$app->get('/', function() use ($app) {
	return view('index');
});

$app->post('/create-user',      'UserController@store');
$app->get('/read-users',        'UserController@index');
$app->get('/read-user/{id}',    'UserController@show');
$app->post('/edit-user/{id}',   'UserController@update');
$app->post('/delete-user/{id}', 'UserController@destroy');