<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Employee, LoadFamiliar};
use Illuminate\Support\Facades\Auth;

class LoadFamiliarController extends Controller
{
    public function create(Employee $employee)
    {   
        return view('familiars.create', compact('employee'));
    }

    public function store(Request $request)
    {
        $loadFamiliar = new LoadFamiliar($request->all());

        auth()->user()->familiars()->save($loadFamiliar);

        return redirect()->route('familiars.index', $request->employee_id)
            ->with('info', 'Registro guardado exitosamente');
    }
}
