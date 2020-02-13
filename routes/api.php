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

Route::post('login', 'LoginController@login');
Route::post('register', 'RegisterController@register');
Route::post('test-notification', 'HandymanController@test');

Route::get('getHandymanList', 'API\HandymanController@getHandyman');
Route::get('getHandymenByService', 'API\HandymanController@getHandymenByService');
Route::get('getHandymanSortedByLocation', 'API\HandymanController@getHandymanOrderedByLocation');
Route::get('getHandymanSortedByPrice', 'API\HandymanController@getHandymanOrderedByPrice');
Route::get('getServices','API\ServiceController@getServices');

Route::get('getHandymanList', 'HandymanController@getHandyman');
Route::get('getHandymenByService', 'HandymanController@getHandymenByService');
Route::get('getHandymanSortedByLocation', 'HandymanController@getHandymanOrderedByLocation');
Route::get('getHandymanSortedByPrice', 'HandymanController@getHandymanOrderedByPrice');


Route::middleware(['auth:api','employee'])->group(function () {
    Route::post('device-token', 'UserController@setDeviceToken');
    Route::get('profile-edit', 'UserController@getProfile');
    Route::put('profile-edit', 'UserController@editProfile');

    Route::post('post', 'PostController@addPost');

    Route::delete('post/{id}', 'PostController@deletePost');
    Route::put('post/{id}', 'PostController@editPost');
    Route::get('post', 'PostController@getPosts');


    // Route::put('profile/edit', 'UserController@editProfile');
    //Route::get('profile/edit', 'UserController@getProfile');
    ////Route::get('logout', 'UserController@logout');

});


Route::middleware(['auth:api','client'])->group(function () {
    Route::post('device-token', 'UserController@setDeviceToken');
    Route::get('profile-edit', 'UserController@getProfile');
    Route::put('profile-edit', 'UserController@editProfile');

    Route::post('post', 'PostController@addPost');

    Route::delete('post/{id}', 'PostController@deletePost');
    Route::put('post/{id}', 'PostController@editPost');
    Route::get('post', 'PostController@getPosts');


    // Route::put('profile/edit', 'UserController@editProfile');
    //Route::get('profile/edit', 'UserController@getProfile');
    ////Route::get('logout', 'UserController@logout');

});



