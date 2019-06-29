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
    		'name' => 'required',
    		'type' => 'required',
    	], [
    		'name.required' => 'El Nombre de la nómina es obligatorio',
    		'type.required' => 'El Tipo de la nómina es obligatorio',
    	]);

    	Nomina::create($data);

    	return redirect()->route('nomina.index');
    }
}
