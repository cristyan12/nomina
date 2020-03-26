<?php

namespace App\Http\Controllers\Nomina;

use App\Http\Controllers\Controller;
use App\Nomina;
use App\Unit;

class SelectNominaController extends Controller
{
    public function index()
    {
        return view('nomina.select', ['nominas' => Nomina::paginate()]);
    }

    public function show(Nomina $nomina)
    {
        return view('nomina.selected', [
            'nomina' => $nomina,
            'units' => Unit::get(),
        ]);
    }
}
