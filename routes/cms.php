<?php

Route::get("/", 'HomeController@index')->name('dashboard');

Route::resource('service','ServiceController');
