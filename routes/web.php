<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

//Route::get("login", 'Auth\LoginController@showLoginForm')->name('login');
//Route::post("login", 'Auth\LoginController@doLogin')->name('login');

Route::get("register", 'Auth\RegisterController@showRegistrationForm')->name('register');
// ac
//Route::get("home","FRONT\HomeController@getHomePage");


// admin page route

