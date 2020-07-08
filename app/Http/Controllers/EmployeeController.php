<?php

namespace App\Http\Controllers;

use App\{
    Bank, Branch, Department, EmployeeProfile,
    Employee, Nomina, Position, Profession, Unit
};
use App\Http\Requests\{
    CreateEmployeeRequest, UpdateEmployeeRequest
};
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::query()
            ->select('employees.*')
            ->join('employee_profiles', 'employee_profiles.employee_id', '=', 'employees.id')
            ->where('employee_profiles.status', 'Activo')
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
        return $this->fillView('employees.edit', $employee);
    }

    public function update(Employee $employee, UpdateEmployeeRequest $request)
    {
        $data = $request->validated();

        DB::transaction(function () use ($employee, $data) {
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
        });

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
