<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::orderBy('id', 'DESC')->paginate(10);

        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:departments,name'
        ], [
            'name.required' => 'El campo Departamento es requerido.',
            'name.unique' => 'El campo Departamento ya está siendo utilizado.',
        ]);

        Department::create([
            'name' => $request['name']
        ]);

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

    public function update(Request $request, Department $department)
    {
        $attributes = $request->validate([
            'name' => [
                'required', Rule::unique('departments')->ignore($department->id)
            ]
        ], [
            'name.required' => 'El campo Departamento es requerido.',
            'name.unique' => 'El campo Departamento ya está siendo utilizado.',
        ]);

        $department->update($attributes);

        return redirect()->route('departments.show', $department)
            ->with('success', 'Sucursal actualizada con éxito');
    }
}
