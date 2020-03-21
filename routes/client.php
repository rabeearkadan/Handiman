<?php
// users


use Illuminate\Support\Facades\Route;
//home (employee Posts)
Route::get('/home','HomeController@index')->name('client.home');

//Services and employee profile
Route::get('/services/{id?}','HomeController@service')->name('client.service');
Route::get('/services/{id}/user/{user_id}','ProfileController@userProfile')->name('client.user-profile');

//Chat

//Requests
Route::get('/requests','RequestController@index')->name('client.request.index');
Route::get('/requests/{id}','RequestControlller@show')->name('client.request.show');
Route::get('/requests/create/{service_id}/{user_id?}','RequestController@create')->name('client.request.create');
Route::post('/requests/create/{user_id}','RequestController@store')->name('client.request.store');
Route::get('/requests/edit/{id}','RequestController@edit')->name('client.request.edit');
Route::put('/requests/edit/{id}','RequestController@update')->name('client.request.update');
Route::delete('/requests/destroy/{id}','RequestController@destroy')->name('client.request.destroy');

//Invoices
Route::get('/invoice','InvoiceController@index')->name('client.invoice.index');
Route::get('/invoice/{id}','InvoiceController@show')->name('client.invoice.show');

//Reviews (can be created and edited)
Route::get('/reviews','ReviewsController@index')->name('client.reviews.index');
Route::post('/reviews/create/{invoice_id}','ReviewsController@store')->name('client.reviews.store');
Route::put('/reviews/edit/{invoice_id}','ReviewsController@update')->name('client.reviews.update');

//Client Profile
Route::get('/profile','ProfileController@myProfile')->name('client.profile');
Route::get('/profile/password','ProfileController@editPassword')->name('client.password');
Route::get('/profile/payment','ProfileController@editPayment')->name('client.payment');
Route::put('/profile','ProfileController@editProfile')->name('client.edit.profile');
