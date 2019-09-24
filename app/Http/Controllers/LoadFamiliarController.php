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
        $loadFamiliar = new LoadFamiliar;

        return view('familiars.create', compact('employee', 'loadFamiliar'));
    }

    public function store(CreateLoadFamiliarRequest $request)
    {
        $familiar = new LoadFamiliar($request->validated());

        auth()->user()->familiars()->save($familiar);

        return redirect()->route('familiars.index', $request->employee_id)
            ->with('info', 'Registro guardado exitosamente');
    }
}
