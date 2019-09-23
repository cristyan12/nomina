<?php

namespace App\Http\Controllers;

use App\{Employee, LoadFamiliar};
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateLoadFamiliarRequest;

class LoadFamiliarController extends Controller
{
    public function index()
    {
        # code...
    }

    public function create(Employee $employee)
    {
        $loadFamiliar = new LoadFamiliar;

        return view('familiars.create', compact('employee', 'loadFamiliar'));
    }

    public function store(CreateLoadFamiliarRequest $request)
    {
        dd($request->all());

        $loadFamiliar = new LoadFamiliar($request->all());

        auth()->user()->familiars()->save($loadFamiliar);

        return redirect()->route('familiars.index', $request->employee_id)
            ->with('info', 'Registro guardado exitosamente');
    }
}
