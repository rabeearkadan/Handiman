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

Route::post('/employee/activate/{id}','HandymanController@activate')->name('employee.activate');
Route::post('/employee/deactivate/{id}','HandymanController@deactivate')->name('employee.deactivate');
Route::get('/rejected-payments','RequestController@rejectedPayments')->name('rejected-payments');
Route::get('google-piechart', array('as' => 'chart.piechart', 'uses' => 'StatisticsController@pieChart'));

Route::get('/employee/{id}/removeService','HandymanController@removeService')->name('employee.removeService');
Route::get('service.test', ['uses' => 'ServiceController@test', 'as' => 'service.test']);
Route::post('add-service', 'ServiceController@store')->name('admin.services');
