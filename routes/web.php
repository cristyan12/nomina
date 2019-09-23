<?php

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Rutas con permisos
Route::middleware(['auth'])->group(function() {

    Route::view('/', 'dashboard')->name('dashboard');
    Route::view('/archivos', 'registry')->name('records');
    Route::view('/security', 'security')->name('security');

    // Load Familiar
    Route::get('employees/{employee}/load-familiars', 'LoadFamiliarController@index')->name('familiars.index');
    Route::get('employees/{employee}/load-familiar', 'LoadFamiliarController@create')->name('familiars.create');
    Route::post('familiars/store', 'LoadFamiliarController@store')->name('familiars.store');

    // Concepts
    Route::get('concepts', 'ConceptController@index')->name('concepts.index');
    Route::get('concepts/create', 'ConceptController@create')->name('concepts.create');
    Route::post('concepts/store', 'ConceptController@store')->name('concepts.store');

    // Bank Account
    Route::get('accounts', 'AccountController@index')->name('accounts.index');
    Route::get('accounts/create', 'AccountController@create')->name('accounts.create');
    Route::post('accounts/store', 'AccountController@store')->name('accounts.store');
    Route::get('accounts/{account}/edit', 'AccountController@edit')->name('accounts.edit');
    Route::put('accounts/{account}', 'AccountController@update')->name('accounts.update');
    Route::get('accounts/{account}', 'AccountController@show')->name('accounts.show');


    // Companies
    Route::namespace('Company')->group(function () {
        Route::get('companies', 'CompaniesController@index')->name('companies.index');
        Route::get('companies/create', 'CompaniesController@create')->name('companies.create');
        Route::post('companies/store', 'CompaniesController@store')->name('companies.store');
        Route::get('companies/{company}/edit', 'UpdateCompanyController@edit')->name('companies.edit');
        Route::put('companies/{company}', 'UpdateCompanyController@update')->name('companies.update');
        Route::get('companies/{company}', 'ShowCompanyController@show')->name('companies.show');
    });

    // Nominas
    Route::namespace('Nomina')->group(function () {
        Route::get('nominas', 'ListNominaController')
                ->name('nomina.index');
                // ->middleware('permission:nomina.index');

        Route::get('nominas/create', 'CreateNominaController@create')
            ->name('nomina.create');
            // ->middleware('permission:nomina.create');

        Route::post('nominas/store', 'CreateNominaController@store')
            ->name('nomina.store');
            // ->middleware('permission:nomina.create');

        Route::get('nominas/{nomina}/edit', 'CreateNominaController@edit')
            ->name('nomina.edit');
            // ->middleware('permission:nomina.edit');

        Route::put('nominas/{nomina}', 'CreateNominaController@update')
            ->name('nomina.update');
            // ->middleware('permission:nomina.edit');

        Route::get('nominas/{nomina}', 'ShowNominaController')
            ->name('nomina.show');
            // ->middleware('permission:nomina.show');
    });

    // Users
    Route::get('users', 'UserController@index')
        ->name('users.index');
        // ->middleware('permission:users.index');

    Route::get('users/create', 'UserController@create')->name('users.create');
        // ->middleware('permission:users.create');

    Route::post('users/store', 'UserController@store')->name('users.store');
        // ->middleware('permission:users.create');

    Route::get('users/{user}/edit', 'UserController@edit')
        ->name('users.edit');
        // ->middleware('permission:users.edit');

    Route::get('users/{user}', 'UserController@show')
        ->name('users.show');
        // ->middleware('permission:users.show');

    Route::put('users/{user}', 'UserController@update')
        ->name('users.update');
        // ->middleware('permission:users.edit');

    Route::delete('users/{user}', 'UserController@destroy')
        ->name('users.destroy');
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
        ->name('roles.update');
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

    // Permissions
    Route::get('permissions', 'PermissionController@index')
        ->name('permissions.index');
        // ->middleware('permission:permissions.index');

    Route::get('permissions/create', 'PermissionController@create')
        ->name('permissions.create');
        // ->middleware('permission:permissions.create');

    Route::post('permissions/store', 'PermissionController@store')
        ->name('permissions.store');
        // ->middleware('permission:permissions.create');

    Route::get('permissions/{permission}/edit', 'PermissionController@edit')
        ->name('permissions.edit');
        // ->middleware('permission:permissions.edit');

    Route::put('permissions/{permission}', 'PermissionController@update')
        ->name('permissions.update');
        // ->middleware('permission:permissions.edit');

    Route::get('permissions/{permission}', 'PermissionController@show')
        ->name('permissions.show');
        // ->middleware('permission:permissions.show');

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
    Route::get('/employees/create', 'EmployeeController@create')
        ->name('employees.create');
        // ->middleware('permission:employees.create');

    Route::post('/employees', 'EmployeeController@store')
        ->name('employees.store');
        // ->middleware('permission:employees.create');

    Route::get('/employees', 'EmployeeController@index')
        ->name('employees.index');
        // ->middleware('permission:employees.index');

    Route::get('/employees/{employee}', 'EmployeeController@show')
        ->name('employees.show');
        // ->middleware('permission:employees.show');

    Route::get('/employees/{employee}/edit', 'EmployeeController@edit')
        ->name('employees.edit');
        // ->middleware('permission:employees.edit');

    Route::put('/employees/{employee}', 'EmployeeController@update')
        ->name('employees.update');
        // ->middleware('permission:employees.edit');

    Route::delete('employees/{employee}', 'EmployeeController@destroy')
        ->name('employees.destroy');
        // ->middleware('permission:employees.destroy');
});