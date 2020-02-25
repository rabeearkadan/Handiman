<?php

use Illuminate\Support\Facades\Route;

Route::get("/home", 'HomeController@index')->name('admin.home');

Route::resource('service', 'ServiceController');
Route::resource('client', 'ClientController');
Route::resource('employee', 'HandymanController');
//
//Route::get('service.test', ['uses' => 'ServiceController@test', 'as' => 'service.test']);


Route::post('service/update', 'ServiceController@update')->name('service.update');

Route::get('service/destroy/{id}', 'SeviceController@destroy');
//Route::post('add-service','ServiceController@store')->name('admin.services');
