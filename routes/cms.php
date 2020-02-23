<?php
use Illuminate\Support\Facades\Route;

Route::get("/home", 'HomeController@index')->name('admin.home');

Route::resource('service','ServiceController');

//Route::get('service.show', ['uses'=>'ServiceController@test', 'as'=>'service.test']);
//Route::post('add-service','ServiceController@store')->name('admin.services');
