<?php
// users


use Illuminate\Support\Facades\Route;
//home (employee Posts)
Route::get('/home','HomeController@index')->name('client.home');

//Services and employee profile
Route::get('/services/{id?}','HomeController@service')->name('client.service');
Route::get('/services/{id}/employee/{employee_id}','ProfileController@employeeProfile')->name('client.user-profile');
Route::get('/services/{id}/employee/{employee_id}/see-all-reviews','ProfileController@allReviews')->name('client.user-profile.all.reviews');


//Requests
Route::get('/requests','RequestController@index')->name('client.request.index');
Route::get('/requests/{id}','RequestControlller@show')->name('client.request.show');
Route::get('/request/create','RequestController@create')->name('client.request.create');//?employee_id=12345678&service_id=1234567
Route::post('/request/create','RequestController@store')->name('client.request.store');
Route::get('/requests/{id}/edit','RequestController@edit')->name('client.request.edit');
Route::put('/requests/{id}/edit','RequestController@update')->name('client.request.update');
Route::delete('/requests/{id}/destroy','RequestController@destroy')->name('client.request.destroy');

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

Route::post('/profile/add/address','ProfileController@addAddress')->name('client.add.address');
Route::put('/profile/edit/address','ProfileController@editAddress')->name('client.edit.address');
