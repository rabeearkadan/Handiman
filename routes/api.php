<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




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
    // all routes related to handy man
    Route::post('post', 'PostController@addPost');
    Route::delete('post/{id}', 'PostController@deletePost');
    Route::put('post/{id}', 'PostController@editPost');
    Route::get('post', 'PostController@getPosts');
    Route::get('post-id/{id}', 'PostController@getPostById');
    Route::get('request','RequestController@getHandymanRequests');
    Route::get('request/{id}', 'RequestController@getRequestById');
    Route::get('ongoing-requests', 'RequestController@geHandymanOngoingRequests');
    Route::get('outgoing-requests', 'RequestController@geHandymanOutgoingRequests');
//    Route::post('accept-request/{id}', 'RequestController@acceptRequest');
//    Route::post('reject-request/{id}', 'RequestController@rejectRequest');





});


Route::middleware(['auth:api', 'client'])->prefix('client')->group(function () {
    //all route related to  user
    Route::post('request/{id}', 'RequestController@requestHandyman');


    Route::post('request-any', 'RequestController@requestAny');
    Route::get('post', 'PostController@getPosts');
    Route::post('make-request','RequestController@makeRequest');
    //Route::post('send-message/{id}','RequestController@sendRequestMessage');
  //  Route::get('load-message','RequestController@getMessages');



    // Route::get('ongoing-requests','RequestController@getOngoingRequests');
    // Route::get('outgoing-requests','RequestController@getOutgoingRequests');
    // Route::put('accept-request',Request)


});


Route::middleware(['auth:api'])->group(function () {
    //all routes related to user and handyman
    Route::post('device-token', 'UserController@setDeviceToken');
    Route::get('profile-edit', 'UserController@getProfile');
    Route::post('profile-edit', 'UserController@editProfile');
    Route::get('timeline-view/{id}', 'UserController@getTimeline');
    Route::post('request-chat', 'ChatController@requestToChat');

    Route::post('credit-card', 'PaymentController@setCreditCard');
    Route::get('credit-card', 'PaymentController@getCreditCard');

    // Route::put('profile/edit', 'UserController@editProfile');
    //Route::get('profile/edit', 'UserController@getProfile');
    ////Route::get('logout', 'UserController@logout');
});
