<?php

namespace App\Http\Controllers;

use App\Tabulator;
use Illuminate\Http\Request;

class TabulatorController extends Controller
{
    public function index()
    {
        return view('tabulator.index');
    }

    public function create()
    {
        return view('tabulator.create');
    }

    public function store(Request $request)
    {
        Tabulator::create($request->all());

        return redirect()->route('tabulator.index')
            ->with('info', 'Cargo creado con éxito!');
    }
}
