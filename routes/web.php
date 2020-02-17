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



Route::get("register", 'Auth\RegisterController@showRegistrationForm')->name('register');

//Route::get("home","FRONT\HomeController@getHomePage");


// admin page route

