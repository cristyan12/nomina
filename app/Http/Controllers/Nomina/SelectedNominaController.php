<?php

namespace App\Http\Controllers\Nomina;

use App\Nomina;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SelectedNominaController extends Controller
{
    public function index()
    {
        $nominas = Nomina::orderBy('id')->paginate();

        return view('nomina.select', compact('nominas'));
    }

    public function show(Nomina $nomina)
    {
        return view('nomina.selected', compact('nomina'));
    }
}
