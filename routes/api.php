<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'API\LoginController@login');
Route::post('register', 'API\RegisterController@register');
Route::post('test-notification', 'API\HandymanController@test');

Route::get('getHandymanList', 'API\HandymanController@getHandyman');

Route::middleware('auth:api')->group(function () {
    Route::post('device-token', 'API\UserController@setDeviceToken');
    Route::get('profile-edit', 'API\UserController@getProfile');
    Route::put('profile-edit', 'API\UserController@editProfile');

    Route::post('post', 'API\PostController@addPost');

    Route::delete('post/{id}', 'API\PostController@deletePost');
    Route::put('post/{id}', 'API\PostController@editPost');
    Route::get('post', 'API\PostController@getPosts');


    // Route::put('profile/edit', 'API\UserController@editProfile');
    //Route::get('profile/edit', 'API\UserController@getProfile');
    ////Route::get('logout', 'API\UserController@logout');

});



