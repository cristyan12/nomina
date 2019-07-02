<?php

namespace App\Http\Controllers;

use App\Nomina;
use App\Http\Requests\{
    CreateNominaRequest, UpdateNominaRequest
};

class CreateNominaController extends Controller
{
    public function create()
    {
        return view('nomina.create', [
            'nomina' => new Nomina,
        ]);
    }

    public function store(CreateNominaRequest $request)
    {
        Nomina::create($request->validated());

        return redirect()->route('nomina.index')
            ->with('info', 'Nómina creada correctamente');
    }

    public function edit(Nomina $nomina)
    {
        return view('nomina.edit', compact('nomina'));
    }

    public function update(Nomina $nomina, UpdateNominaRequest $request)
    {
        $nomina->update($request->validated());
        
        return redirect()->route('nomina.index')
            ->with('info', 'Nómina actualizada correctamente');;
    }
}
