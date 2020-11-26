<?php

namespace App\Http\Controllers\Nomina;

use App\Models\Nomina;
use App\Http\Controllers\Controller;
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
        $nomina = new Nomina($request->validated());

        auth()->user()->nominas()->save($nomina);

        return redirect()->route('nomina.index')
            ->with('info', 'Nómina creada correctamente');
    }

    public function edit(Nomina $nomina)
    {
        return view('nomina.edit', compact('nomina'));
    }

    public function update(Nomina $nomina, UpdateNominaRequest $request)
    {
        $nomina->fill($request->validated());

        auth()->user()->nominas()->save($nomina);

        return redirect()->route('nomina.index')
            ->with('info', 'Nómina actualizada correctamente');;
    }
}
