<?php

Route::view('/', 'dashboard')->name('dashboard');

Route::get('/tabulator', 'TabulatorController@index')->name('tabulator.index');
Route::get('/tabulator/create', 'TabulatorController@create')->name('tabulator.create');
Route::post('/tabulator', 'TabulatorController@store')->name('tabulator.store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
