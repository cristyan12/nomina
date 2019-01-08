<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function create()
    {
        return view('employees.create');
    }

    public function store()
    {
        $employee = Employee::create(request()->all());

        return redirect()->route('employees.index')
            ->with('success', "Empleado $employee->last_name, $employee->first_name, fue creado exitosamente");
    }
}
