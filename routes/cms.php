<?php

use Illuminate\Support\Facades\Route;

Route::get("/home", 'HomeController@index')->name('admin.home');

Route::resource('service', 'ServiceController');
Route::resource('client', 'ClientController');
Route::resource('employee', 'HandymanController');

Route::resource('report', 'ReportsController');

Route::resource('request', 'RequestController');

Route::resource('contact', 'ContactedUsController');
Route::resource('statistics', 'StatisticsController');

Route::post('activate/{id}','HandymanController@activate')->name('employee.activate');
Route::post('deactivate/{id}','HandymanController@deactivate')->name('employee.deactivate');
Route::get('google-piechart', array('as' => 'chart.piechart', 'uses' => 'StatisticsController@pieChart'));

Route::get('service.test', ['uses' => 'ServiceController@test', 'as' => 'service.test']);
Route::post('add-service', 'ServiceController@store')->name('admin.services');
