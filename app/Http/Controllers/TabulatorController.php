<?php

namespace App\Http\Controllers;

use App\Tabulator;
use Illuminate\Http\Request;

class TabulatorController extends Controller
{
    public function index()
    {
        $tabulators = Tabulator::orderBy('id')->get();

        return view('tabulator.index', compact('tabulators'));
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
