<?php
//for employee routes
use Illuminate\Support\Facades\Route;

Route::get("/home", 'HomeController@index')->name('employee.home');
