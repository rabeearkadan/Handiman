<?php
// users


use Illuminate\Support\Facades\Route;
//home (employee Posts)
Route::get('/home','HomeController@index')->name('client.home');

//Services and employee profile
//Services
Route::get('/services/{id?}','HomeController@service')->name('client.service');
Route::post('/services/{id?}','HomeController@filterUsers')->name('client.service.filter');
//Services: employee profile
Route::get('/employee/{employee_id}/services/{service_id?}','ProfileController@employeeProfile')->name('client.user-profile');
Route::get('/employee/{employee_id}/see-all-reviews/services/{service_id?}','ProfileController@allReviews')->name('client.user-profile.all.reviews');



//Requests
Route::get('/requests','RequestController@index')->name('client.request.index');
Route::get('/requests/{id}','RequestController@show')->name('client.request.show');
Route::get('/request/create','RequestController@create')->name('client.request.create');
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
Route::get('/edit-profile','ProfileController@myProfile')->name('client.profile');
Route::get('/profile/password','ProfileController@editPassword')->name('client.password');
Route::get('/profile/payment','ProfileController@editPayment')->name('client.payment');
//Client Contact Information
Route::put('/edit-profile/contact','ProfileController@updateContact')->name('client.contact.update');
//Client Image
Route::put('/edit-profile/image/update','ProfileController@updateImage')->name('client.image.update');
Route::delete('/edit-profile/image/destroy','ProfileController@destroyImage')->name('client.image.destroy');
//Client Addresses
Route::get('/profile/address/create','ProfileController@createAddress')->name('client.address.create');
Route::post('/profile/address/create','ProfileController@storeAddress')->name('client.address.store');
Route::get('/profile/addresses/{id}/edit','ProfileController@editAddress')->name('client.address.edit');
Route::put('/profile/addresses/{id}/edit','ProfileController@updateAddress')->name('client.address.update');
Route::delete('/profile/addresses/{id}/destroy','ProfileController@destroyAddress')->name('client.address.destroy');
