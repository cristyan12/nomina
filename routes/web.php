<?php

Route::view('/', 'dashboard')->name('dashboard');

Route::get('/positions', 'PositionController@index')->name('positions.index');
Route::get('/positions/create', 'PositionController@create')->name('positions.create');
Route::post('/positions', 'PositionController@store')->name('positions.store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
