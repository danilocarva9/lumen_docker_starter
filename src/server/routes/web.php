<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// $router->get('/key', function() {
//     return \Illuminate\Support\Str::random(32);
// });

//Public
$router->group(['prefix' => ''], function () use ($router) {
    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');
    $router->post('forgot-password', 'AuthController@forgotPassword');
    $router->post('recovery-password', 'AuthController@recoveryPassword');
});

//Users
$router->group(['middleware' => 'auth', 'prefix' => 'users'], function () use ($router) {
    $router->get('{id}/profile', 'UserController@findById');
    $router->post('profile', 'UserController@updateUserProfile');
});
