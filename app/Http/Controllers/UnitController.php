<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::orderBy('id', 'desc')->paginate(10);

        return view('units.index', compact('units'));
    }

    public function create()
    {
        return view('units.create', ['unit' => new Unit]);
    }

    public function store()
    {
        Unit::create(request()->validate([
            'name' => 'required|unique:units,name'
        ], [
            'name.required' => 'El nombre de la Unidad es obligatorio.',
            'name.unique' => 'El nombre de la Unidad debe ser único.',
        ]));

        return redirect()->route('units.index');
    }

    public function show(Unit $unit)
    {
        return view('units.show', compact('unit'));
    }

    public function edit(Unit $unit)
    {
        return view('units.edit', compact('unit'));
    }

    public function update(Unit $unit)
    {
        $unit->update(request()->only('name'));

        return redirect()->route('units.show', $unit)
            ->with('success', 'Unidad actualizada con éxito');
    }
}
