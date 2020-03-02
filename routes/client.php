<?php
// users


use Illuminate\Support\Facades\Route;

Route::get('/home','HomeController@index')->name('client.home');
Route::get('/services/{id?}','HomeController@service')->name('client.service');
Route::get('/services/{id}/user/{user_id}','ProfileController@userProfile')->name('client.user-profile');
Route::get('/profile','ProfileController@editProfile')->name('client.edit.profile');
Route::get('/profile/password','ProfileController@editPassword')->name('client.edit.password');
Route::get('/profile/payment','ProfileController@editPayment')->name('client.edit.payment');

Route::put('/profile','ProfileController@editProfile')->name('client.edit.profile');
