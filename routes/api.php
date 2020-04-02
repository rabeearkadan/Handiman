<?php

use Illuminate\Http\Request;

// api route without authantication
Route::post('login', 'LoginController@login');
Route::post('register', 'RegisterController@register');
Route::post('test-notification/{user_id}/{isClient}', 'NotificationController@test');
Route::post('make-message/{user_id}/{isClient}', 'NotificationController@makeMessage');
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

// api route with auth and employee middleware the route is starts with api/empolyee
    Route::post('post', 'PostController@addPost');
    Route::delete('post/{id}', 'PostController@deletePost');
    Route::put('post/{id}', 'PostController@editPost');
    Route::get('post', 'PostController@getPosts');
    Route::get('post-id/{id}', 'PostController@getPostById');
    Route::get('request/{id}', 'RequestController@getRequestById');
    Route::get('pending-requests', 'RequestController@getHandymanRequests');
    Route::get('jobs', 'RequestController@getHandymanJobs');
    Route::post('reply-request/{id}', 'RequestController@replyToRequest');
    Route::post('add-service/{id}', 'ServiceController@addService');
    Route::get('delete-service/{id}', 'ServiceController@deleteService');

//    Route::post('accept-request/{id}', 'RequestController@acceptRequest');
//    Route::post('reject-request/{id}', 'RequestController@rejectRequest');


});

Route::middleware(['auth:api', 'client'])->prefix('client')->group(function () {
// api route with auth and client middleware the route is starts with api/client
    Route::post('request/{id}', 'RequestController@requestHandyman');


    Route::post('request-any', 'RequestController@requestAny');
    Route::get('post', 'PostController@getPosts');
    Route::post('make-request', 'RequestController@makeRequest');
    //Route::post('send-message/{id}','RequestController@sendRequestMessage');
    //  Route::get('load-message','RequestController@getMessages');


    Route::get('ongoing-requests', 'RequestController@getOngoingRequests');
    // Route::get('outgoing-requests','RequestController@getOutgoingRequests');
    // Route::put('accept-request',Request)

});

Route::middleware(['auth:api'])->group(function () {

// api route with auth  the route is starts with api/
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

