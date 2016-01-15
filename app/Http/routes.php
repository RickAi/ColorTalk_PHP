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

Route::get('/', function () {
    return view('welcome');
});

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Api\Controllers'], function ($api) {
        // User
        // POST ['name', 'email', 'password', 'is_third', 'gender', 'birthday'];
        $api->post('users', 'UserController@createUser');
        $api->get('users', 'UserController@getUsers');

        // Image
        $api->get('images', 'ImageController@index');
        $api->post('images', 'ImageController@upload');
        $api->delete('images/{images}', 'ImageController@delete');

        // Moment
        $api->get('moments', 'MomentController@index');
        $api->post('moments', 'MomentController@create');
        $api->delete('moments/{moments}', 'MomentController@delete');

    });
});
