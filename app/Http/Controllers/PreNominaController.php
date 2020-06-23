<?php

namespace App\Http\Controllers;

use App\{Employee, Nomina};
use Illuminate\Http\Request;

class PreNominaController extends Controller
{
    public function create(Nomina $nomina, Employee $employee)
    {
        return view('pre-nominas.create', compact('nomina', 'employee'));
    }
}
