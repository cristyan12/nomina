<?php

Route::view('/', 'dashboard')->name('dashboard');

Route::get('/positions', 'PositionController@index')->name('positions.index');
Route::get('/positions/create', 'PositionController@create')->name('positions.create');
Route::post('/positions', 'PositionController@store')->name('positions.store');
Route::get('/positions/{position}', 'PositionController@show')->name('positions.show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
