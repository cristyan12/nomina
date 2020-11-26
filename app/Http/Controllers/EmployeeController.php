<?php

namespace App\Http\Controllers;

use App\Http\Requests\{
    CreateEmployeeRequest, UpdateEmployeeRequest
};
use App\Models\{
    Bank, Branch, Department, Employee,
    Nomina, Position, Profession, Unit
};
use Illuminate\Contracts\View\View;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::query()
            ->select('employees.*')
            ->join('employee_profiles', 'employee_profiles.employee_id', '=', 'employees.id')
            // ->where('employee_profiles.status', 'Activo')
            ->orderBy('hired_at')
            ->with('profile')
            ->paginate(10);

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return $this->fillView('employees.create', new Employee);
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function store(CreateEmployeeRequest $request)
    {
        $request->save();

        return redirect()->route('employees.index')
            ->with('success', 'Empleado fue creado exitosamente');
    }

    public function edit(Employee $employee)
    {
        return $this->fillView('employees.edit', $employee);
    }

    public function update(Employee $employee, UpdateEmployeeRequest $request)
    {
        $request->update($employee);

        return redirect()->route('employees.index')
            ->with('success', 'Empleado editado exitosamente.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return back()->with('info', 'Registro eliminado correctamente');
    }

    protected function fillView(string $view, Employee $employee): View
    {
        return view($view, [
            'employee' => $employee,
            'professions' => Profession::orderBy('id')->get(),
            'branches' => Branch::orderBy('id')->get(),
            'banks' => Bank::orderBy('code')->get(),
            'departments' => Department::orderBy('id')->get(),
            'units' => Unit::orderBy('id')->get(),
            'positions' => Position::orderBy('id')->get(),
            'nominas' => Nomina::orderBy('id')->get(),
        ]);
    }
}
