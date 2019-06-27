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

    public function store()
    {
    	Nomina::create(request()->all());

    	return redirect()->route('nomina.index');
    }
}
