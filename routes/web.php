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
Auth::routes(['verify' => true]);
Route::get("register", 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/contact','MailController@contact')->name('mail.contact');
Route::get("/home", 'HomeController@index')->middleware('auth')->middleware('verified');




