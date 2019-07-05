<?php

namespace App\Http\Controllers;

use App\Nomina;
use Illuminate\Http\Request;

class ShowNominaController extends Controller
{
    public function __invoke(Nomina $nomina)
    {
        return view('nomina.show', compact('nomina'));
    }
}
