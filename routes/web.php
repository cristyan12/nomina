<?php

Route::view('/', 'dashboard')->name('dashboard');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Positions (Cargos)
Route::get('/positions', 'PositionController@index')->name('positions.index');
Route::get('/positions/create', 'PositionController@create')->name('positions.create');
Route::post('/positions', 'PositionController@store')->name('positions.store');
Route::get('/positions/{position}', 'PositionController@show')->name('positions.show');
Route::get('positions/{position}/edit', 'PositionController@edit')->name('positions.edit');
Route::put('/positions/{position}', 'PositionController@update')->name('positions.update');

// Branchs (Sucursales)
Route::get('/branches', 'BranchController@index')->name('branches.index');
Route::get('/branches/create', 'BranchController@create')->name('branches.create');
Route::post('/branches', 'BranchController@store')->name('branches.store');
Route::get('branches/{branch}/edit', 'BranchController@edit')->name('branches.edit');
Route::put('/branches/{branch}', 'BranchController@update')->name('branches.update');
Route::get('/branches/{branch}', 'BranchController@show')->name('branches.show');

// Departments (Departamentos)
Route::get('/departments', 'DepartmentController@index')->name('departments.index');
Route::get('/departments/create', 'DepartmentController@create')->name('departments.create');
Route::post('/departments', 'DepartmentController@store')->name('departments.store');
Route::get('departments/{department}/edit', 'DepartmentController@edit')->name('departments.edit');
Route::put('/departments/{department}', 'DepartmentController@update')->name('departments.update');
Route::get('/departments/{department}', 'DepartmentController@show')->name('departments.show');

// Units (Unidades de producción)
Route::get('/units', 'UnitController@index')->name('units.index');
Route::get('units/create', 'UnitController@create')->name('units.create');
Route::post('/units', 'UnitController@store')->name('units.store');
Route::get('units/{unit}/edit', 'UnitController@edit')->name('units.edit');
Route::put('/units/{unit}', 'UnitController@update')->name('units.update');
Route::get('/units/{unit}', 'UnitController@show')->name('units.show');

// Professions
Route::get('/professions/create', 'ProfessionController@create')->name('professions.create');
Route::post('/professions', 'ProfessionController@store')->name('professions.store');
Route::get('/professions', 'ProfessionController@index')->name('professions.index');