<?php

Route::get("/", 'HomeController@index')->name('admin.home');

Route::resource('service','ServiceController');
