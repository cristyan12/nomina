<?php

namespace App\Http\Controllers\Nomina;

use App\Nomina;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShowNominaController extends Controller
{
    public function __invoke(Nomina $nomina)
    {
        return view('nomina.show', compact('nomina'));
    }
}
