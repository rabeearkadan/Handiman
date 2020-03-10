<?php
// users


use Illuminate\Support\Facades\Route;
//home (employee Posts)
Route::get('/home','HomeController@index')->name('client.home');

//Services and employee profile
Route::get('/services/{id?}','HomeController@service')->name('client.service');
Route::get('/services/{id}/user/{user_id}','ProfileController@userProfile')->name('client.user-profile');

//Client Profile
Route::get('/profile','ProfileController@myProfile')->name('client.profile');
Route::get('/profile/password','ProfileController@editPassword')->name('client.password');
Route::get('/profile/payment','ProfileController@editPayment')->name('client.payment');
Route::put('/profile','ProfileController@editProfile')->name('client.edit.profile');

//Invoices
Route::get('/invoice','InvoiceController@index')->name('client.invoice.index');
Route::get('/invoice/{id}','InvoiceController@show')->name('client.invoice.show');

