<?php

use Illuminate\Http\Request;

// api route without authantication

Route::post('rate', 'UserController@addRating');
Route::post('pdf/{file_name}', 'RequestController@stringToPDF');
Route::post('login', 'LoginController@login');
Route::post('register', 'RegisterController@register');
Route::post('test-notification/{user_id}/{isClient}', 'NotificationController@test');
Route::post('make-message/{user_id}/{isClient}', 'NotificationController@makeMessage');
Route::get('getHandymanList', 'HandymanController@getHandyman');
Route::get('getHandymanSortedByLocation', 'HandymanController@getHandymanOrderedByLocation');
Route::get('getHandymanSortedByPrice', 'HandymanController@getHandymanOrderedByPrice');

Route::get('getServices', 'ServiceController@getServices');
Route::post('visit/{id}', 'UserController@visited');
Route::get('getHandymanList', 'HandymanController@getHandyman');
Route::get('getHandymenByService/{id}', 'HandymanController@getHandymenByService');
Route::post('getHandymanSortedByLocation', 'HandymanController@getHandymanByLocation');
Route::get('getHandymanSortedByPrice', 'HandymanController@getHandymanOrderedByPrice');


Route::middleware(['auth:api', 'employee'])->prefix('employee')->group(function () {

// api route with auth and employee middleware the route is starts with api/empolyee
    Route::get('feedback', 'UserController@getHandymanFeedback');
    Route::delete('post/{id}', 'PostController@deletePost');
    Route::get('post', 'PostController@getPosts');
    Route::get('pending-requests', 'RequestController@getHandymanRequests');
    Route::get('post-id/{id}', 'PostController@getPostById');
    Route::get('request/{id}', 'RequestController@getRequestById');
    Route::get('schedule', 'RequestController@getHandymanTasks');
    Route::post('reply-request/{id}', 'RequestController@replyToRequest');
    Route::post('add-service/{id}', 'ServiceController@addService');
    Route::get('delete-service/{id}', 'ServiceController@deleteService');
    Route::post('post', 'PostController@addPost');
    Route::get('chat-requests', 'ChatController@employeeRequests');
    Route::post('receipt/{id}', 'RequestController@addReceipt');
    Route::post('receipt-images/{id}', 'RequestController@addReceiptImages');
    Route::post('reschedule/{id}', 'RequestController@reschedule');
    Route::get('tags', 'UserController@employeeTags');
    Route::get('employee-posts', 'UserController@employeePosts');
});

Route::middleware(['auth:api', 'client'])->prefix('client')->group(function () {
// api route with auth and client middleware the route is starts with api/client
    Route::post('request/{id}', 'RequestController@requestHandyman');
    Route::get('post', 'PostController@getPosts');
    Route::post('make-request', 'RequestController@makeRequest');
    Route::get('ongoing-requests', 'RequestController@getClientOngoingRequests');
    Route::get('outgoing-requests', 'RequestController@getClientOutgoingRequests');
    Route::post('request-done/{id}', 'RequestController@onRequestDone');
    Route::post('request-cancel/{id}', 'RequestController@cancelRequest');
    Route::post('payment/{id}', 'RequestController@setPayment');
    Route::post('remove-address/{id}', 'UserController@deleteAddress');
    Route::get('chat-requests', 'ChatController@clientRequests');
    Route::get('employee-profile/{id}', 'HandymanController@getHandymanById');
    Route::post('reject-payment/{id}', 'RequestController@rejectPayment');

});

Route::middleware(['auth:api'])->group(function () {

// api route with auth  the route is starts with api/
    //all routes related to user and handyman
    Route::post('device-token', 'UserController@setDeviceToken');
    Route::get('profile-edit', 'UserController@getProfile');
    Route::post('profile-edit', 'UserController@editProfile');
    Route::get('timeline-view/{id}', 'UserController@getTimeline');
    Route::post('message/{id}', 'ChatController@sendMessage');
    Route::get('message/{id}', 'ChatController@loadMessages');
    Route::post('credit-card', 'PaymentController@setCreditCard');
    Route::get('credit-card', 'PaymentController@getCreditCard');
    Route::post('offline', 'UserController@setOffline');
    Route::get('jobs/{id}', 'RequestController@getHandymanJobs');
    Route::post('password', 'UserController@changePassword');


    // Route::put('profile/edit', 'UserController@editProfile');
    //Route::get('profile/edit', 'UserController@getProfile');
    ////Route::get('logout', 'UserController@logout');
});

