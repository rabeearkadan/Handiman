<?php
//for employee routes
use Illuminate\Support\Facades\Route;

Route::get("/home", 'HomeController@index')->name('employee.home');

//Requests
Route::get("/requests", 'RequestController@index')->name('employee.requests');
//Calendar
Route::get("/calendar", 'CalendarController@index')->name('employee.calendar');
//Reviews
Route::get("/reviews", 'HomeController@reviews')->name('employee.reviews');

//Profile
Route::get('/sss','ProfileController@clientProfile')->name('employee.client-profile');
Route::get('/profile','ProfileController@myProfile')->name('employee.profile');
Route::get('/profile/password','ProfileController@editPassword')->name('employee.password');
Route::get('/profile/payment','ProfileController@editPayment')->name('employee.payment');
Route::put('/profile','ProfileController@editProfile')->name('employee.edit.profile');

//chat
Route::get("/chat", 'ChatController@index')->name('employee.chat');
