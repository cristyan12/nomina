<?php

namespace App\Http\Controllers\Nomina;

use App\Nomina;
use App\Http\Controllers\Controller;

class ShowNominaController extends Controller
{
    public function __invoke(Nomina $nomina)
    {
        $nomina = Nomina::with('employees.profile')->get();

        return view('nomina.show', compact('nomina'));
    }
}
