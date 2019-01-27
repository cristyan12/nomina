<?php

namespace App\Http\Controllers;

use App\{
    Employee, EmployeeProfile, Profession,
};
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function create()
    {
        $professions = Profession::orderBy('id')->pluck('title', 'id');

        return view('employees.create', compact('professions'));
    }

    public function store()
    {
        $employee = Employee::create(request()->only(
            'code', 'document', 'last_name', 'first_name',
            'rif', 'born_at', 'marital_status', 'sex',
            'nationality', 'city_of_born', 'hired_at'
        ));

        $employee->profile()->create(request()->only(
            'profession_id', 'contract_id', 'status', 'bank_pay_id',
            'account_number', 'branch_id', 'department_id', 'unit_id',
            'position_id'
        ));
        
        return redirect()->route('employees.index')
            ->with('success', 'Empleado fue creado exitosamente');
    }
}
