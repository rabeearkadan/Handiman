<?php
// users


use Illuminate\Support\Facades\Route;

Route::get('/home','HomeController@index')->name('client.home');
Route::get('/services','HomeController@service')->name('client.service');
