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
        /*
         * User
         */
        // POST ['email', 'password'];
        // 普通的注册才使用这个接口,第三方直接登录即可
        $api->post('register', 'UserController@createUser');
        // POST ['email', 'password', 'is_third']
        // POST ['uid', 'is_third']
        $api->post('login', 'UserController@login');
        $api->get('users', 'UserController@getUsers');

        /*
         * Image
         */
        $api->get('images', 'ImageController@index');
        $api->post('images', 'ImageController@upload');
        $api->delete('images/{images}', 'ImageController@delete');

        /*
         * Moment
         */
        $api->get('moments', 'MomentController@index');
        // POST ['user_id', 'image_name', 'text']
        $api->post('moments', 'MomentController@create');
        $api->delete('moments/{moments}', 'MomentController@delete');

        /*
         * Token
         *
         */
        // POST ['image_name']
        $api->post('token/qiniu', 'TokenController@qiniuToken');
        // POST ['user_id', 'name', 'uri']
        $api->post('token/rong', 'TokenController@rongToken');


    });
});
