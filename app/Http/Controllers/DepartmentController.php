<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Http\Requests\{
    CreateDepartmentRequest, UpdateDepartmentRequest
};

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::orderBy('id', 'DESC')->paginate(10);

        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        return view('departments.create', ['department' => new Department]);
    }

    public function store(CreateDepartmentRequest $request)
    {
        Department::create($request->validated());

        return redirect()->route('departments.index')
            ->with('success', 'Departamento creado con éxito.');
    }

    public function show(Department $department)
    {
        return view('departments.show', compact('department'));
    }

    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $department->update($request->validated());

        return redirect()->route('departments.show', $department)
            ->with('success', 'Sucursal actualizada con éxito');
    }
}
