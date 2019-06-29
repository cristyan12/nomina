<?php

namespace App\Http\Controllers;

use App\Nomina;
use Illuminate\Http\Request;

class CreateNominaController extends Controller
{
    public function create()
    {
        return view('nomina.create');
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|unique:nominas',
            'type' => 'required',
            'periods' => '',
            'first_period' => '',
        ], [
            'name.required' => 'El Nombre de la nómina es obligatorio',
            'name.unique' => 'El Nombre ya está en uso, por favor use otro',
            'type.required' => 'El Tipo de la nómina es obligatorio',
        ]);

        Nomina::create($data);

        return redirect()->route('nomina.index');
    }
}
