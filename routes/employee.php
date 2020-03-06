<?php
//for employee routes
use Illuminate\Support\Facades\Route;

Route::get("/home", 'HomeController@index')->name('employee.home');
Route::get("/requests", 'HomeController@index')->name('employee.requests');
Route::get("/jobs", 'HomeController@index')->name('employee.home');
Route::get("/messages", 'HomeController@index')->name('employee.messages');
Route::get("/profile", 'ProfileCotroller@index')->name('employee.profile');
Route::get("/reviews", 'HomeController@index')->name('employee.reviews');



