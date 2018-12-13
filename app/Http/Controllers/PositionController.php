<?php

namespace App\Http\Controllers;

use App\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::orderBy('id')->get();

        return view('positions.index', compact('positions'));
    }

    public function create()
    {
        return view('positions.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required',
            'name' => 'required',
            'basic_salary' => 'required',
        ], [
            'code.required' => 'El campo código de SISDEM es requerido.',
            'name.required' => 'El campo Nombre del Cargo es requerido.',
            'basic_salary.required' => 'El campo Salario Básico es requerido.',
        ]);

        Position::create([
            'code' => $data['code'],
            'name' => $data['name'],
            'basic_salary' => $data['basic_salary'],
        ]);

        return redirect()->route('positions.index')
            ->with('info', 'Cargo creado con éxito!');
    }

    public function show(Position $position)
    {
        return view('positions.show', compact('position'));
    }
}
