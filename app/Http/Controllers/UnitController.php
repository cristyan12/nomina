<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::orderBy('id', 'desc')->paginate(10);

        return view('units.index', compact('units'));
    }

    public function create()
    {
        return view('units.create');
    }

    public function store()
    {
        Unit::create(request()->all());

        return redirect()->route('units.index');
    }

    public function show(Unit $unit)
    {
        return view('units.show', compact('unit'));
    }

    public function edit(Unit $unit)
    {
        # code...
    }
}
