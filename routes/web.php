<?php

Route::view('/', 'dashboard')->name('dashboard');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/positions', 'PositionController@index')->name('positions.index');
Route::get('/positions/create', 'PositionController@create')->name('positions.create');
Route::post('/positions', 'PositionController@store')->name('positions.store');
Route::get('/positions/{position}', 'PositionController@show')->name('positions.show');
Route::get('positions/{position}/edit', 'PositionController@edit')->name('positions.edit');
Route::put('/positions/{position}', 'PositionController@update')->name('positions.update');

Route::get('/branches', 'BranchController@index')->name('branches.index');
Route::get('/branches/create', 'BranchController@create')->name('branches.create');
Route::post('/branches', 'BranchController@store')->name('branches.store');
Route::get('branches/{branch}/edit', 'BranchController@edit')->name('branches.edit');
Route::put('/branches/{branch}', 'BranchController@update')->name('branches.update');
Route::get('/branches/{branch}', 'BranchController@show')->name('branches.show');

Route::get('/departments', 'DepartmentController@index')->name('departments.index');
Route::get('/departments/create', 'DepartmentController@create')->name('departments.create');
Route::post('/departments', 'DepartmentController@store')->name('departments.store');
Route::get('departments/{department}/edit', 'DepartmentController@edit')->name('departments.edit');
Route::put('/departments/{department}', 'DepartmentController@update')->name('departments.update');
Route::get('/departments/{department}', 'DepartmentController@show')->name('departments.show');
