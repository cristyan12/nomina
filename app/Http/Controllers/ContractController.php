<?php

namespace App\Http\Controllers;

use App\Contract;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ContractController extends Controller
{
    public function index()
    {
        $contracts = Contract::orderBy('id')->paginate(10);

        return view('contracts.index', compact('contracts'));
    }

    public function create()
    {
        return view('contracts.create');
    }

    public function store()
    {
        $data = request()->validate([
            'type' => 'required|unique:contracts,type',
            'duration' => 'required',
        ], [
            'type.required' => 'El campo Tipo del contrato es requerido',
            'type.unique' => 'El campo Tipo del contrato ya está en uso.',
            'duration.required' => 'El campo Duración del contrato es requerido',
        ]);

        Contract::create([
            'type' => $data['type'],
            'duration' => $data['duration'],
        ]);

        return redirect()->route('contracts.index');
    }

    public function show(Contract $contract)
    {
        return view('contracts.show', compact('contract'));
    }

    public function edit(Contract $contract)
    {
        return view('contracts.edit', compact('contract'));
    }

    public function update(Contract $contract)
    {
        $data = request()->validate([
            'type' => 'required|unique:contracts,type,'.$contract->id,
            'duration' => 'required',
        ], [
            'type.required' => 'El campo Tipo del contrato es requerido',
            'type.unique' => 'El campo Tipo del contrato ya está en uso.',
            'duration.required' => 'El campo Duración del contrato es requerido',
        ]);

        $contract->update([
            'type' => $data['type'],
            'duration' => $data['duration'],
        ]);

        return redirect()->route('contracts.show', $contract)
            ->with('success', 'Contrato actualizado con éxito');
    }
}
