<?php

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Rutas con permisos
Route::middleware(['auth'])->group(function () {
    Route::view('/', 'dashboard')->name('dashboard');
    Route::view('/archivos', 'registry')->name('records');
    Route::view('/security', 'security')->name('security');

    // Load Familiar
    Route::get('employees/{employee}/load-familiars', 'LoadFamiliarController@index')->name('familiars.index');
    Route::get('employees/{employee}/load-familiar/create', 'LoadFamiliarController@create')->name('familiars.create');
    Route::post('employees/familiars/store', 'LoadFamiliarController@store')->name('familiars.store');
    Route::get('familiars/{familiar}/edit', 'LoadFamiliarController@edit')->name('familiars.edit');
    Route::put('familiars/{familiar}', 'LoadFamiliarController@update')->name('familiars.update');
    Route::get('employees/{employee}/familiars/{familiar}', 'LoadFamiliarController@show')->name('familiars.show');
    Route::delete('familiars/{familiar}', 'LoadFamiliarController@destroy')->name('familiars.destroy');

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
        Route::get('nominas', 'ListNominaController')->name('nomina.index');
        Route::get('nominas/create', 'CreateNominaController@create')->name('nomina.create');
        Route::post('nominas/store', 'CreateNominaController@store')->name('nomina.store');
        Route::get('nominas/{nomina}/edit', 'CreateNominaController@edit')->name('nomina.edit');
        Route::put('nominas/{nomina}', 'CreateNominaController@update')->name('nomina.update');
        Route::get('nominas/{nomina}', 'ShowNominaController')->name('nomina.show');
    });

    // PreNominas
    Route::get('pre-nominas/{nomina}/{employee}/create', 'PreNominaController@create')
        ->name('pre-nominas.create');

    Route::get('pre-nominas/index', 'PreNominaController@index')
        ->name('pre-nominas.index');

    Route::get('pre-nominas/{nomina}/', 'PreNominaController@show')
        ->name('pre-nominas.show');

    // Users
    Route::get('users', 'UserController@index')->name('users.index');
    Route::get('users/create', 'UserController@crete')->name('users.create');
    Route::post('users/store', 'UserController@store')->name('users.store');
    Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit');
    Route::get('users/{user}', 'UserController@show')->name('users.show');
    Route::put('users/{user}', 'UserController@update')->name('users.update');
    Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy');

    // Roles
    Route::post('roles/store', 'RoleController@store')->name('roles.store');
    Route::get('roles', 'RoleController@index')->name('roles.index');
    Route::get('roles/create', 'RoleController@create')->name('roles.create');
    Route::put('roles/{role}', 'RoleController@update')->name('roles.update');
    Route::get('roles/{role}', 'RoleController@show')->name('roles.show');
    Route::delete('roles/{role}', 'RoleController@destroy')->name('roles.destroy');
    Route::get('roles/{role}/edit', 'RoleController@edit')->name('roles.edit');

    // Permissions
    Route::get('permissions', 'PermissionController@index')->name('permissions.index');
    Route::get('permissions/create', 'PermissionController@create')->name('permissions.create');
    Route::post('permissions/store', 'PermissionController@store')->name('permissions.store');
    Route::get('permissions/{permission}/edit', 'PermissionController@edit')->name('permissions.edit');
    Route::put('permissions/{permission}', 'PermissionController@update')->name('permissions.update');
    Route::get('permissions/{permission}', 'PermissionController@show')->name('permissions.show');

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
    Route::get('/professions/{profession}', 'ProfessionController@show')->name('professions.show');
    Route::get('/professions/{profession}/edit', 'ProfessionController@edit')->name('professions.edit');
    Route::put('/professions/{profession}', 'ProfessionController@update')->name('professions.update');

    // Employees
    Route::get('/employees/create', 'EmployeeController@create')->name('employees.create');
    Route::post('/employees', 'EmployeeController@store')->name('employees.store');
    Route::get('/employees', 'EmployeeController@index')->name('employees.index');
    Route::get('/employees/{employee}', 'EmployeeController@show')->name('employees.show');
    Route::get('/employees/{employee}/edit', 'EmployeeController@edit')->name('employees.edit');
    Route::put('/employees/{employee}', 'EmployeeController@update')->name('employees.update');
    Route::delete('employees/{employee}', 'EmployeeController@destroy')->name('employees.destroy');
});