<?php

namespace App\Http\Controllers\Nomina;

use App\Models\Nomina;
use App\Http\Controllers\Controller;

class ShowNominaController extends Controller
{
    public function __invoke(Nomina $nomina)
    {
        return view('nomina.show', compact('nomina'));
    }
}
