<?php

namespace App\Http\Controllers;

use App\{
    Bank,
    Branch,
    Department,
    EmployeeProfile,
    Employee,
    Nomina,
    Position,
    Profession,
    Unit,
};
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
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
        return view('employees.create', [
            'profile'       => new EmployeeProfile(),
            'professions'   => Profession::orderBy('id')->pluck('title', 'id'),
            'branches'      => Branch::orderBy('id')->pluck('name', 'id'),
            'banks'         => Bank::orderBy('id')->pluck('name', 'id'),
            'departments'   => Department::orderBy('id')->pluck('name', 'id'),
            'units'         => Unit::orderBy('id')->pluck('name', 'id'),
            'positions'     => Position::orderBy('id')->pluck('name', 'id'),
            'nominas'        => Nomina::orderBy('id')->pluck('name', 'id'),
        ]);
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function store(CreateEmployeeRequest $request)
    {
        $employee = new Employee($request->only(
            'code', 'document', 'last_name', 'first_name',
            'rif', 'born_at', 'civil_status', 'sex',
            'nationality', 'city_of_born', 'hired_at'
        ));

        auth()->user()->employees()->save($employee);

        $employee->profile()->create(request()->only(
            'profession_id', 'contract', 'status', 'bank_id',
            'account_number', 'branch_id', 'department_id', 'unit_id',
            'position_id', 'nomina_id'
        ));

        return redirect()->route('employees.index')
            ->with('success', 'Empleado fue creado exitosamente');
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', [
            'employee'      => $employee,
            'professions'   => Profession::orderBy('id')->pluck('title', 'id'),
            'branches'      => Branch::orderBy('id')->pluck('name', 'id'),
            'banks'         => Bank::orderBy('id')->pluck('name', 'id'),
            'departments'   => Department::orderBy('id')->pluck('name', 'id'),
            'units'         => Unit::orderBy('id')->pluck('name', 'id'),
            'positions'     => Position::orderBy('id')->pluck('name', 'id'),
        ]);
    }

    public function update(Employee $employee, UpdateEmployeeRequest $request)
    {
        $employee->fill($request->only(
            'code', 'document', 'last_name', 'first_name',
            'rif', 'born_at', 'marital_status', 'sex',
            'nationality', 'city_of_born', 'hired_at'
        ));

        auth()->user()->employees()->save($employee);

        $employee->profile()->update($request->only(
            'profession_id', 'contract', 'status', 'bank_id',
            'account_number', 'branch_id', 'department_id', 'unit_id',
            'position_id'
        ));

        return redirect()->route('employees.index')
            ->with('success', 'Empleado editado exitosamente.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return back()->with('info', 'Registro eliminado correctamente');
    }
}
