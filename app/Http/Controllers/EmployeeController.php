<?php

namespace App\Http\Controllers;

use App\{
    Bank, Branch, Department, EmployeeProfile,
    Employee, Nomina, Position, Profession, Unit
};
use Illuminate\Support\Facades\DB;
use App\Http\Requests\{
    CreateEmployeeRequest, UpdateEmployeeRequest
};

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
            'employee' => new Employee(),
            'professions' => Profession::orderBy('title', 'ASC')->get(),
            'branches' => Branch::orderBy('name', 'ASC')->get(),
            'banks' => Bank::orderBy('name', 'ASC')->get(),
            'departments' => Department::orderBy('name', 'ASC')->get(),
            'units' => Unit::orderBy('name', 'ASC')->get(),
            'positions' => Position::orderBy('name', 'ASC')->get(),
            'nominas' => Nomina::orderBy('name', 'ASC')->get(),
        ]);
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function store(CreateEmployeeRequest $request)
    {
        $data = $request->validated();

        DB::transaction(function () use ($data) {
            $employee = new Employee([
                'code' => $data['code'],
                'document' => $data['document'],
                'nationality' => $data['nationality'],
                'last_name' => $data['last_name'],
                'first_name' => $data['first_name'],
                'rif' => $data['rif'],
                'born_at' => $data['born_at'],
                'civil_status' => $data['civil_status'],
                'sex' => $data['sex'],
                'city_of_born' => $data['city_of_born'],
                'hired_at' => $data['hired_at'],
                'nomina_id' => $data['nomina_id']
            ]);

            auth()->user()->employees()->save($employee);

            $employee->profile()->create([
                'profession_id' => $data['profession_id'],
                'contract' => $data['contract'],
                'status' => $data['status'],
                'bank_id' => $data['bank_id'],
                'account_number' => $data['account_number'],
                'branch_id' => $data['branch_id'],
                'department_id' => $data['department_id'],
                'unit_id' => $data['unit_id'],
                'position_id' => $data['position_id'],
            ]);
        });

        return redirect()->route('employees.index')
            ->with('success', 'Empleado fue creado exitosamente');
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', [
            'employee' => $employee,
            'professions' => Profession::orderBy('title', 'ASC')->get(),
            'branches' => Branch::orderBy('name', 'ASC')->get(),
            'banks' => Bank::orderBy('code', 'ASC')->get(),
            'departments' => Department::orderBy('name', 'ASC')->get(),
            'units' => Unit::orderBy('name', 'ASC')->get(),
            'positions' => Position::orderBy('name', 'ASC')->get(),
            'nominas' => Nomina::orderBy('name', 'ASC')->get(),
        ]);
    }

    public function update(Employee $employee, UpdateEmployeeRequest $request)
    {
        $data = $request->validated();

        $employee->fill([
            'code' => $data['code'],
            'document' => $data['document'],
            'last_name' => $data['last_name'],
            'first_name' => $data['first_name'],
            'rif' => $data['rif'],
            'born_at' => $data['born_at'],
            'civil_status' => $data['civil_status'],
            'sex' => $data['sex'],
            'nationality' => $data['nationality'],
            'city_of_born' => $data['city_of_born'],
            'hired_at' => $data['hired_at'],
            'nomina_id' => $data['nomina_id'],
        ]);

        auth()->user()->employees()->save($employee);

        $employee->profile()->update([
            'profession_id' => $data['profession_id'],
            'contract' => $data['contract'],
            'status' => $data['status'],
            'bank_id' => $data['bank_id'],
            'account_number' => $data['account_number'],
            'branch_id' => $data['branch_id'],
            'department_id' => $data['department_id'],
            'unit_id' => $data['unit_id'],
            'position_id' => $data['position_id'],
        ]);

        return redirect()->route('employees.index')
            ->with('success', 'Empleado editado exitosamente.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return back()->with('info', 'Registro eliminado correctamente');
    }
}
