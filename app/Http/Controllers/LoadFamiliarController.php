<?php

namespace App\Http\Controllers;

use App\{Employee, LoadFamiliar};
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateLoadFamiliarRequest;

class LoadFamiliarController extends Controller
{
    public function create(Employee $employee)
    {   
        return view('familiars.create', compact('employee'));
    }

    public function store(CreateLoadFamiliarRequest $request)
    {
        $loadFamiliar = new LoadFamiliar($request->validated());

        auth()->user()->familiars()->save($loadFamiliar);

        return redirect()->route('familiars.index', $request->employee_id)
            ->with('info', 'Registro guardado exitosamente');
    }
}
