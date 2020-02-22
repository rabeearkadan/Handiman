<?php
// users


use Illuminate\Support\Facades\Route;

Route::get('/home','HomeController@index')->name('client.home');
Route::get('/services/{id?}','HomeController@service')->name('client.service');
Route::get('/{user_id?}','ProfileController@userProfile')->name('client.user-profile');
