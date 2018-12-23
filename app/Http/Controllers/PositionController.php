<?php

namespace App\Http\Controllers;

use App\Position;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\CreatePositionRequest;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::orderBy('id')->paginate(10);

        return view('positions.index', compact('positions'));
    }

    public function create()
    {
        return view('positions.create');
    }

    public function store(CreatePositionRequest $request)
    {
        Position::create([
            'code' => $request['code'],
            'name' => $request['name'],
            'basic_salary' => $request['basic_salary'],
        ]);

        return redirect()->route('positions.index')
            ->with('success', 'Cargo creado con éxito!');
    }

    public function show(Position $position)
    {
        return view('positions.show', compact('position'));
    }

    public function edit(Position $position)
    {
        return view('positions.edit', compact('position'));
    }

    public function update(Position $position, Request $request)
    {
        $attributes = $request->validate([
            'code' => [
                'required', Rule::unique('positions')->ignore($position->id)
            ],
            'name' => 'required',
            'basic_salary' => 'required|numeric'
        ], [
            'basic_salary.required' => 'El campo Salario Básico es requerido.',
            'basic_salary.numeric' => 'El campo Salario Básico debe ser un número.',
        ]);

        $position->update($attributes);

        return redirect()->route('positions.edit', $position);
    }
}
