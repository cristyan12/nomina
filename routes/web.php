<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tabulator/create', 'TabulatorController@create')->name('tabulator.create');
