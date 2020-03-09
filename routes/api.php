<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'LoginController@login');
Route::post('register', 'RegisterController@register');
Route::post('test-notification/{user_id}', 'NotificationController@test');
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

    Route::get('request/{id}', 'RequestController@getRequestById');
    Route::get('Ongoing-requests', 'RequestController@geHandymanOngoingRequests');
    Route::get('Outgoing-requests', 'RequestController@geHandymanOutgoingRequests');
    Route::post('accept-request/{id}', 'RequestController@acceptRequest');
    Route::post('reject-request/{id}', 'RequestController@rejecttRequest');


});


Route::middleware(['auth:api', 'client'])->prefix('user')->group(function () {
    //all route related to  user
    Route::post('request', 'RequestController@requestHandyman');
    Route::get('post', 'PostController@getPosts');

    //TODO
    // Route::get('ongoing-requests','RequestController@getOngoingRequests');
    //Route::get('outgoing-requests','RequestController@getOutgoingRequests');
    // Route::put('accept-request',Request)


});


Route::middleware(['auth:api'])->group(function () {
    //all routes related to user and handyman
    Route::post('device-token', 'UserController@setDeviceToken');
    Route::get('profile-edit', 'UserController@getProfile');
    Route::post('profile-edit', 'UserController@editProfile');
    Route::get('timeline-view/{id}', 'UserController@getTimeline');
    Route::post('request-chat', 'ChatController@requestToChat');

    // Route::put('profile/edit', 'UserController@editProfile');
    //Route::get('profile/edit', 'UserController@getProfile');
    ////Route::get('logout', 'UserController@logout');
});
