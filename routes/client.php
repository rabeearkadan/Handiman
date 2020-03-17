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

//Requests
Route::get('/requests','RequestController@index')->name('client.request.index');
Route::get('/requests/{id}','RequestControlller@show')->name('client.request.show');
Route::get('/requests/create/{user_id}','RequestController@create')->name('client.request.create');
Route::post('/requests/create/{user_id}','RequestController@store')->name('client.request.store');
Route::get('/requests/edit/{id}','RequestController@edit')->name('client.request.edit');
Route::put('/requests/edit/{id}','RequestController@update')->name('client.request.update');
Route::delete('/requests/destroy/{id}','RequestController@destroy')->name('client.request.destroy');

//Reviews (can be created and edited)
//Route::get('/reviews','');
//Route::post('','');
//Route::put('','');
