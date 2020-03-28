<?php

use Illuminate\Http\Request;




Route::post('login', 'LoginController@login');
Route::post('register', 'RegisterController@register');
Route::post('test-notification/{user_id}/{isClient}', 'NotificationController@test');
Route::post('make-message/{user_id}/{isClient}','NotificationController@makeMessage');
Route::get('getHandymanList', 'HandymanController@getHandyman');
Route::get('getHandymenByService', 'HandymanController@getHandymenByService');
Route::get('getHandymanSortedByLocation', 'HandymanController@getHandymanOrderedByLocation');
Route::get('getHandymanSortedByPrice', 'HandymanController@getHandymanOrderedByPrice');

Route::get('getServices', 'ServiceController@getServices');

Route::get('getHandymanList', 'HandymanController@getHandyman');
Route::get('getHandymenByService/{id}', 'HandymanController@getHandymenByService');
Route::get('getHandymanSortedByLocation', 'HandymanController@getHandymanOrderedByLocation');
Route::get('getHandymanSortedByPrice', 'HandymanController@getHandymanOrderedByPrice');


Route::middleware(['auth:api', 'employee'])->prefix('employee')->group(function () {
    Route::post('post', 'PostController@addPost');
    Route::delete('post/{id}', 'PostController@deletePost');
    Route::put('post/{id}', 'PostController@editPost');
    Route::get('post', 'PostController@getPosts');
    Route::get('post-id/{id}', 'PostController@getPostById');
    Route::get('request','RequestController@getHandymanRequests');
    Route::get('request/{id}', 'RequestController@getRequestById');
    Route::get('ongoing-requests', 'RequestController@geHandymanOngoingRequests');
    Route::get('outgoing-requests', 'RequestController@geHandymanOutgoingRequests');






});


Route::middleware(['auth:api', 'client'])->prefix('client')->group(function () {
    Route::post('request/{id}', 'RequestController@requestHandyman');


    Route::post('request-any', 'RequestController@requestAny');
    Route::get('post', 'PostController@getPosts');
    Route::post('make-request','RequestController@makeRequest');



});


Route::middleware(['auth:api'])->group(function () {
    Route::post('device-token', 'UserController@setDeviceToken');
    Route::get('profile-edit', 'UserController@getProfile');
    Route::post('profile-edit', 'UserController@editProfile');
    Route::get('timeline-view/{id}', 'UserController@getTimeline');
    Route::post('request-chat', 'ChatController@requestToChat');

    Route::post('credit-card', 'PaymentController@setCreditCard');
    Route::get('credit-card', 'PaymentController@getCreditCard');


});
