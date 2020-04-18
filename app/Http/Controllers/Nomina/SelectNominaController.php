<?php

namespace App\Http\Controllers\Nomina;

use App\{Nomina, Unit};

class SelectNominaController
{
    public function index()
    {
        return view('nomina.select', ['nominas' => Nomina::paginate()]);
    }

    public function show(Nomina $nomina)
    {
        return view('nomina.selected', [
            'nomina' => $nomina,
        ]);
    }
}
