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


Route::middleware('auth:api')->group(function () {
    Route::post('device-token', 'API\UserController@setDeviceToken');
    Route::put('update-profile', 'API\HandymanController@updateProfile');

});



