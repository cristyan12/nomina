<?php

namespace App\Http\Controllers;

use App\Nomina;
use App\Http\Requests\CreateNominaRequest;

class CreateNominaController extends Controller
{
    public function create()
    {
        return view('nomina.create');
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

    public function update(Nomina $nomina)
    {
        $nomina->update(request()->all());
        
        return redirect()->route('nomina.index');
    }
}
