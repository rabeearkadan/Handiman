<?php
use Illuminate\Support\Facades\Route;

Route::get("/home", 'HomeController@index')->name('admin.home');

Route::resource('service','ServiceController');
