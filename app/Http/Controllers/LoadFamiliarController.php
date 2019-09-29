<?php

namespace App\Http\Controllers;

use App\{Employee, LoadFamiliar};
use App\Http\Requests\CreateLoadFamiliarRequest;

class LoadFamiliarController extends Controller
{
    public function index(Employee $employee)
    {
        return view('familiars.index', compact('employee'));
    }

    public function create(Employee $employee)
    {
        $familiar = new LoadFamiliar;

        return view('familiars.create', compact('employee', 'familiar'));
    }

    public function store(CreateLoadFamiliarRequest $request)
    {
        $familiar = new LoadFamiliar($request->validated());

        auth()->user()->familiars()->save($familiar);

        return redirect()->route('familiars.index', $request->employee_id)
            ->with('info', 'Registro guardado exitosamente');
    }

    public function show(LoadFamiliar $familiar)
    {
        return view('familiars.show', compact('familiar'));
    }

    public function edit(LoadFamiliar $familiar)
    {
        $employee = $familiar->load('employee');

        return view('familiars.edit', compact('employee', 'familiar'));
    }
}
