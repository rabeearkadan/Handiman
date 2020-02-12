<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get("contact-us", 'FRONT\HomeController@contact');

Route::get("login", 'Auth\LoginController@showLoginForm')->name('login');
Route::put("login", 'Auth\LoginController@doLogin')->name('login');

Route::get("register", 'Auth\RegisterController@showRegistrationForm')->name('register');



// admin page route

