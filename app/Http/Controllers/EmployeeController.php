<?php

namespace App\Http\Controllers;

use App\{
    BankOfPay,
    Branch,
    Department,
    Employee,
    EmployeeProfile,
    Position,
    Profession,
    Unit
};
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('profile')
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $professions = Profession::orderBy('id')->pluck('title', 'id');

        $branches = Branch::orderBy('id')->pluck('name', 'id');

        $bankOfPays = BankOfPay::orderBy('id')->pluck('name', 'id');

        $departments = Department::orderBy('id')->pluck('name', 'id');

        $units = Unit::orderBy('id')->pluck('name', 'id');
        
        $positions = Position::orderBy('id')->pluck('name', 'id');

        return view('employees.create', compact(
            'professions', 'branches', 'bankOfPays',
            'departments', 'units', 'positions'
        ));
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function store()
    {
        $employee = Employee::create(request()->only(
            'code', 'document', 'last_name', 'first_name',
            'rif', 'born_at', 'marital_status', 'sex',
            'nationality', 'city_of_born', 'hired_at'
        ));

        $employee->profile()->create(request()->only(
            'profession_id', 'contract', 'status', 'bank_pay_id',
            'account_number', 'branch_id', 'department_id', 'unit_id',
            'position_id'
        ));
        
        return redirect()->route('employees.index')
            ->with('success', 'Empleado fue creado exitosamente');
    }
}
