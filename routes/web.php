<?php

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::view('/', 'dashboard')->name('dashboard');

// Nominas
Route::get('nominas/create', 'CreateNominaController@create')->name('nomina.create');
Route::post('nominas/store', 'CreateNominaController@store')->name('nomina.store');

Route::get('nominas', 'ListNominaController')->name('nomina.index');



Route::middleware(['auth'])->group(function() {
    Route::get('users', 'UserController@index')
        ->name('users.index')
        ->middleware('permission:users.index');

    Route::get('users/create', 'UserController@create')->name('users.create')
        ->middleware('permission:users.create');

    Route::post('users/store', 'UserController@store')->name('users.store')
        ->middleware('permission:users.create');

    Route::get('users/{user}/edit', 'UserController@edit')
        ->name('users.edit')
        ->middleware('permission:users.edit');

    Route::get('users/{user}', 'UserController@show')
        ->name('users.show')
        ->middleware('permission:users.show');

    Route::put('users/{user}', 'UserController@update')
        ->name('users.update')
        ->middleware('permission:users.edit');

    Route::delete('users/{user}', 'UserController@destroy')
        ->name('users.destroy')
        ->middleware('permission:users.destroy');

    // Roles
    Route::post('roles/store', 'RoleController@store')
        ->name('roles.store')
        ->middleware('permission:roles.create');

    Route::get('roles', 'RoleController@index')
        ->name('roles.index')
        ->middleware('permission:roles.index');
    
    Route::get('roles/create', 'RoleController@create')
        ->name('roles.create')
        ->middleware('permission:roles.create');
    
    Route::put('roles/{role}', 'RoleController@update')
        ->name('roles.update')
        ->middleware('permission:roles.edit');
    
    Route::get('roles/{role}', 'RoleController@show')
        ->name('roles.show')
        ->middleware('permission:roles.show');
    
    Route::delete('roles/{role}', 'RoleController@destroy')
        ->name('roles.destroy')
        ->middleware('permission:roles.destroy');
    
    Route::get('roles/{role}/edit', 'RoleController@edit')
        ->name('roles.edit')
        ->middleware('permission:roles.edit');

    // Positions (Cargos)
    Route::get('/positions', 'PositionController@index')
        ->name('positions.index')
        ->middleware('permission:positions.index');
    
    Route::get('/positions/create', 'PositionController@create')
        ->name('positions.create')
        ->middleware('permission:positions.create');
    
    Route::post('/positions', 'PositionController@store')
        ->name('positions.store')
        ->middleware('permission:positions.create');
    
    Route::get('/positions/{position}', 'PositionController@show')
        ->name('positions.show')
        ->middleware('permission:positions.show');
    
    Route::get('positions/{position}/edit', 'PositionController@edit')
        ->name('positions.edit')
        ->middleware('permission:positions.edit');
    
    Route::put('/positions/{position}', 'PositionController@update')
        ->name('positions.update')
        ->middleware('permission:positions.edit');

    // Branchs (Sucursales)
    Route::get('/branches', 'BranchController@index')
        ->name('branches.index')
        ->middleware('permission:branches.index');

    Route::get('/branches/create', 'BranchController@create')
        ->name('branches.create')
        ->middleware('permission:branches.create');

    Route::post('/branches', 'BranchController@store')
        ->name('branches.store')
        ->middleware('permission:branches.create');

    Route::get('branches/{branch}/edit', 'BranchController@edit')
        ->name('branches.edit')
        ->middleware('permission:branches.edit');

    Route::put('/branches/{branch}', 'BranchController@update')
        ->name('branches.update')
        ->middleware('permission:branches.edit');

    Route::get('/branches/{branch}', 'BranchController@show')
        ->name('branches.show')
        ->middleware('permission:branches.show');

    // Departments (Departamentos)
    Route::get('/departments', 'DepartmentController@index')
        ->name('departments.index')
        ->middleware('permission:departments.index');

    Route::get('/departments/create', 'DepartmentController@create')
        ->name('departments.create')
        ->middleware('permission:departments.create');

    Route::post('/departments', 'DepartmentController@store')
        ->name('departments.store')
        ->middleware('permission:departments.create');

    Route::get('departments/{department}/edit', 'DepartmentController@edit')
        ->name('departments.edit')
        ->middleware('permission:departments.edit');

    Route::put('/departments/{department}', 'DepartmentController@update')
        ->name('departments.update')
        ->middleware('permission:departments.edit');

    Route::get('/departments/{department}', 'DepartmentController@show')
        ->name('departments.show')
        ->middleware('permission:departments.show');

    // Units (Unidades de producción)
    Route::get('/units', 'UnitController@index')
        ->name('units.index')
        ->middleware('permission:units.index');

    Route::get('units/create', 'UnitController@create')
        ->name('units.create')
        ->middleware('permission:units.create');

    Route::post('/units', 'UnitController@store')
        ->name('units.store')
        ->middleware('permission:units.create');

    Route::get('units/{unit}/edit', 'UnitController@edit')
        ->name('units.edit')
        ->middleware('permission:units.edit');

    Route::put('/units/{unit}', 'UnitController@update')
        ->name('units.update')
        ->middleware('permission:units.edit');

    Route::get('/units/{unit}', 'UnitController@show')
        ->name('units.show')
        ->middleware('permission:units.show');

    // Professions
    Route::get('/professions/create', 'ProfessionController@create')
        ->name('professions.create')
        ->middleware('permission:professions.create');

    Route::post('/professions', 'ProfessionController@store')
        ->name('professions.store')
        ->middleware('permission:professions.create');

    Route::get('/professions', 'ProfessionController@index')
        ->name('professions.index')
        ->middleware('permission:professions.index');

    Route::get('/professions/{profession}', 'ProfessionController@show')
        ->name('professions.show')
        ->middleware('permission:professions.show');

    Route::get('/professions/{profession}/edit', 'ProfessionController@edit')
        ->name('professions.edit')
        ->middleware('permission:professions.edit');

    Route::put('/professions/{profession}', 'ProfessionController@update')
        ->name('professions.update')
        ->middleware('permission:professions.edit');

    // Employees
    Route::get('/empleados/crear', 'EmployeeController@create')
        ->name('employees.create')
        ->middleware('permission:employees.create');

    Route::post('/empleados', 'EmployeeController@store')
        ->name('employees.store')
        ->middleware('permission:employees.create');

    Route::get('/empleados', 'EmployeeController@index')
        ->name('employees.index')
        ->middleware('permission:employees.index');

    Route::get('/empleados/{employee}', 'EmployeeController@show')
        ->name('employees.show')
        ->middleware('permission:employees.show');

    Route::get('/empleados/{employee}/edit', 'EmployeeController@edit')
        ->name('employees.edit')
        ->middleware('permission:employees.edit');

    Route::put('/empleados/{employee}', 'EmployeeController@update')
        ->name('employees.update')
        ->middleware('permission:employees.edit');

    Route::delete('empleados/{employee}', 'EmployeeController@destroy')
        ->name('employees.destroy')
        ->middleware('permission:employees.destroy');
});

/** RUTAS SIN PERMISOS Y ROLES, SOLO AUTH 

Route::middleware(['auth'])->group(function () {
    // Users
    Route::get('users', 'UserController@index')->name('users.index');
     // ->middleware('permission:users.index');

    Route::get('users/create', 'UserController@create')->name('users.create');
        // ->middleware('permission:users.create');

    Route::post('users/store', 'UserController@store')->name('users.store');
        // ->middleware('permission:users.create');

    Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit');
     // ->middleware('permission:users.edit');

    Route::get('users/{user}', 'UserController@show')->name('users.show');
     // ->middleware('permission:users.show');

    Route::put('users/{user}', 'UserController@update')->name('users.update');
     // ->middleware('permission:users.edit');

    Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy');
     // ->middleware('permission:users.destroy');

    // Roles
    Route::post('roles/store', 'RoleController@store')
     ->name('roles.store');
     // ->middleware('permission:roles.create');

    Route::get('roles', 'RoleController@index')
     ->name('roles.index');
     // ->middleware('permission:roles.index');
    
    Route::get('roles/create', 'RoleController@create')
     ->name('roles.create');
     // ->middleware('permission:roles.create');
    
    Route::put('roles/{role}', 'RoleController@update')
     ->name('roles.edit');
     // ->middleware('permission:roles.edit');
    
    Route::get('roles/{role}', 'RoleController@show')
     ->name('roles.show');
     // ->middleware('permission:roles.show');
    
    Route::delete('roles/{role}', 'RoleController@destroy')
     ->name('roles.destroy');
     // ->middleware('permission:roles.destroy');
    
    Route::get('roles/{role}/edit', 'RoleController@edit')
     ->name('roles.edit');
     // ->middleware('permission:roles.edit');

    // Positions (Cargos)
    Route::get('/positions', 'PositionController@index')
     ->name('positions.index');
     // ->middleware('permission:positions.index');
    
    Route::get('/positions/create', 'PositionController@create')
     ->name('positions.create');
     // ->middleware('permission:positions.create');
    
    Route::post('/positions', 'PositionController@store')
     ->name('positions.store');
     // ->middleware('permission:positions.create');
    
    Route::get('/positions/{position}', 'PositionController@show')
     ->name('positions.show');
     // ->middleware('permission:positions.show');
    
    Route::get('positions/{position}/edit', 'PositionController@edit')
     ->name('positions.edit');
     // ->middleware('permission:positions.edit');
    
    Route::put('/positions/{position}', 'PositionController@update')
     ->name('positions.update');
     // ->middleware('permission:positions.edit');

    // Branchs (Sucursales)
    Route::get('/branches', 'BranchController@index')
     ->name('branches.index');
     // ->middleware('permission:branches.index');

    Route::get('/branches/create', 'BranchController@create')
     ->name('branches.create');
     // ->middleware('permission:branches.create');

    Route::post('/branches', 'BranchController@store')
     ->name('branches.store');
     // ->middleware('permission:branches.create');

    Route::get('branches/{branch}/edit', 'BranchController@edit')
     ->name('branches.edit');
     // ->middleware('permission:branches.edit');

    Route::put('/branches/{branch}', 'BranchController@update')
     ->name('branches.update');
     // ->middleware('permission:branches.edit');

    Route::get('/branches/{branch}', 'BranchController@show')
     ->name('branches.show');
     // ->middleware('permission:branches.show');

    // Departments (Departamentos)
    Route::get('/departments', 'DepartmentController@index')
     ->name('departments.index');
     // ->middleware('permission:departments.index');

    Route::get('/departments/create', 'DepartmentController@create')
     ->name('departments.create');
     // ->middleware('permission:departments.create');

    Route::post('/departments', 'DepartmentController@store')
     ->name('departments.store');
     // ->middleware('permission:departments.create');

    Route::get('departments/{department}/edit', 'DepartmentController@edit')
     ->name('departments.edit');
     // ->middleware('permission:departments.edit');

    Route::put('/departments/{department}', 'DepartmentController@update')
     ->name('departments.update');
     // ->middleware('permission:departments.edit');

    Route::get('/departments/{department}', 'DepartmentController@show')
     ->name('departments.show');
     // ->middleware('permission:departments.show');

    // Units (Unidades de producción)
    Route::get('/units', 'UnitController@index')
     ->name('units.index');
     // ->middleware('permission:units.index');

    Route::get('units/create', 'UnitController@create')
     ->name('units.create');
     // ->middleware('permission:units.create');

    Route::post('/units', 'UnitController@store')
     ->name('units.store');
     // ->middleware('permission:units.create');

    Route::get('units/{unit}/edit', 'UnitController@edit')
     ->name('units.edit');
     // ->middleware('permission:units.edit');

    Route::put('/units/{unit}', 'UnitController@update')
     ->name('units.update');
     // ->middleware('permission:units.edit');

    Route::get('/units/{unit}', 'UnitController@show')
     ->name('units.show');
     // ->middleware('permission:units.show');

    // Professions
    Route::get('/professions/create', 'ProfessionController@create')
     ->name('professions.create');
     // ->middleware('permission:professions.create');

    Route::post('/professions', 'ProfessionController@store')
     ->name('professions.store');
     // ->middleware('permission:professions.create');

    Route::get('/professions', 'ProfessionController@index')
     ->name('professions.index');
     // ->middleware('permission:professions.index');

    Route::get('/professions/{profession}', 'ProfessionController@show')
     ->name('professions.show');
     // ->middleware('permission:professions.show');

    Route::get('/professions/{profession}/edit', 'ProfessionController@edit')
     ->name('professions.edit');
     // ->middleware('permission:professions.edit');

    Route::put('/professions/{profession}', 'ProfessionController@update')
     ->name('professions.update');
     // ->middleware('permission:professions.edit');

    // Employees
    Route::get('/empleados/crear', 'EmployeeController@create')
     ->name('employees.create');
     // ->middleware('permission:employees.create');

    Route::post('/empleados', 'EmployeeController@store')
     ->name('employees.store');
     // ->middleware('permission:employees.create');

    Route::get('/empleados', 'EmployeeController@index')
     ->name('employees.index');
     // ->middleware('permission:employees.index');

    Route::get('/empleados/{employee}', 'EmployeeController@show')
     ->name('employees.show');
     // ->middleware('permission:employees.show');

    Route::get('/empleados/{employee}/edit', 'EmployeeController@edit')
     ->name('employees.edit');
     // ->middleware('permission:employees.edit');

    Route::put('/empleados/{employee}', 'EmployeeController@update')
     ->name('employees.update');
     // ->middleware('permission:employees.edit');

    Route::delete('empleados/{employee}', 'EmployeeController@destroy')
     ->name('employees.destroy');
     // ->middleware('permission:employees.destroy');
}); */