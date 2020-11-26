<?php

namespace App\Http\Controllers;

use App\Models\{Employee, Nomina};
use Illuminate\Http\Request;

class PreNominaController extends Controller
{
    public function index()
    {
        $nominas = Nomina::orderBy('id')->paginate();

        return view('pre-nominas.index', compact('nominas'));
    }

    public function create(Nomina $nomina, Employee $employee)
    {
        return view('pre-nominas.create', compact('nomina', 'employee'));
    }

    public function show(Nomina $nomina)
    {
        $employees = $nomina->employees()->paginate(5);

        return view('pre-nominas.show', [
            'nomina' => $nomina,
            'employees' => $employees
        ]);
    }
}
