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
        $employees = $nomina->employees()
            ->orderBy('id')
            ->paginate(5);

        return view('nomina.selected', [
            'nomina' => $nomina,
            'employees' => $employees
        ]);
    }
}
