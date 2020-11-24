<?php

namespace App\Http\Controllers;

use App\Models\Concept;
use App\Http\Requests\CreateConceptRequest;

class ConceptController extends Controller
{
    public function index()
    {
        $concepts = Concept::orderBy('id')->paginate(10);

        return view('concepts.index', compact('concepts'));
    }

    public function create()
    {
        return view('concepts.create', ['concept' => new Concept()]);
    }

    public function store(CreateConceptRequest $request)
    {
        $concept = new Concept();
        $concept->fill($request->validated());

        auth()->user()->concepts()->save($concept);

        return redirect()->route('concepts.index')
            ->with('success', 'Concepto creado con éxito.');
    }

    public function show(Concept $concept)
    {
        //
    }

    public function edit(Concept $concept)
    {
        //
    }

    public function update(Request $request, Concept $concept)
    {
        //
    }

    public function destroy(Concept $concept)
    {
        //
    }
}
